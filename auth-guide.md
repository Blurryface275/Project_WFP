# Panduan Cara Kerja Login & Middleware (Role-Based Access Control)

Dokumen ini menjelaskan alur kerja dari fitur Autentikasi (Login/Register) dan bagaimana sistem keamanan _Middleware_ mencegah akses tidak sah pada aplikasi **VitaGuard**.

---

## 1. Tampilan Antarmuka (Views)

File yang bertugas untuk menampilkan halaman formulir Login dan Register letaknya ada di folder **`resources/views/auth/`**.

- **`resources/views/auth/login.blade.php`**
  Halaman tempat pengguna menginput kredensial (Email dan Password). Halaman ini merupakan HTML terpisah (_standalone_) sehingga pengguna tidak bisa melihat navigasi utama sebelum sukses login.
  _(Tambahkan Screenshot Halaman Login Asli Web Anda Di Sini)_

    ```markdown
    ![Screenshot Halaman Login](./path/to/login-screenshot.png)
    ```

- **`resources/views/layouts/member-app.blade.php`**
  Ini adalah letak pengecekan visibilitas tombol navbar dengan logika bawaan Laravel menggunakan direktif `@auth` dan `@else`. Jika pengguna sudah login, nama profil akan muncul; jika belum, tombol login muncul.

---

## 2. Alur Rute (_Routing_)

Semua lalu lintas (_traffic_) diatur melalui **`routes/web.php`**.

File ini bertugas memetakan kemana sistem harus diarahkan jika pengguna mengakses URL `/login` atau jika pengguna mengirimkan formulir (`Route::post('/login', ...)`).

**Potongan Kode Penting di `web.php`:**

```php
// Rute untuk menampilkan halaman login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Rute untuk memproses data formulir (email & password)
Route::post('/login', [AuthController::class, 'login']);
```

---

## 3. Logika Server (_Controller_)

Setelah Rute menerima _request_ dari formulir HTML, tugas dipindahkan ke "Otak Utama" bernama **`app/Http/Controllers/AuthController.php`**.

Di dalam file inilah _Credential_ diverifikasi dengan kecocokan di _Database_, serta divalidasi jenis _role_-nya.

**Potongan Kode Penting di `AuthController.php`:**

```php
public function login(Request $request)
{
    // 1. Verifikasi tipe data yang masuk (Harus diisi dan berupa email)
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // 2. Auth::attempt mencoba mencocokkan input dengan database (users)
    if (auth()->attempt($credentials)) {
        $request->session()->regenerate();
        $user = auth()->user();

        $intendedUrl = redirect()->intended()->getTargetUrl();

        // 3. Logika Pengecekan Role Pengguna (Admin / Doctor / Member)
        if ($intendedUrl === url('/') || $intendedUrl === route('login')){
            if ($user->role === "admin") { return redirect('/admin/dashboard'); }
            elseif ($user->role === "doctor") { return redirect('/doctor/dashboard'); }
            elseif ($user->role === "member") { return redirect('/welcome'); }
        }
    }
    // Jika password acak/tidak cocok, sistem melemparnya kembali dengan pesan error
    return back()->with('error', 'Email atau Password salah.');
}
```

---

## 4. Keamanan Pintu Rute (_Middleware_)

Akan percuma jika URL `/admin` disebar oleh seseorang kepada _member_ biasa yang kemudian mengklik URL tersebut. Untuk menghindari hal ini, diterapkan **`RoleMiddleware`**.

- **`app/Http/Middleware/RoleMiddleware.php`**: Berisi logika inspeksi siapa yang mencoba melintas masuk dan melarang pengunjung masuk jika status (_role_)-nya hanyalah "member".
- **`app/Http/Kernel.php`**: Tempat mendaftarkan alias (nama panggilan) `role` agar bisa dimasukkan dengan bebas pada rute manapun.

**Potongan Kode Penting di `RoleMiddleware.php`:**

```php
public function handle(Request $request, Closure $next, ...$roles): Response
{
    // Jika pengunjung adalah hantu (belum login) -> Lempar ke halaman login
    if(!auth()->check()){
        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
    }

    $userRole = auth()->user()->role;

    // Jika dia member (bukan admin/doctor) -> Dilarang mengakses dashboard admin/doctor!
    if($userRole === 'member'){
        return redirect()->route('welcome')->with('error', 'Anda tidak memiliki akses ke halaman ini!');
    }

    return $next($request);
}
```

_Cara Pemasangan di `routes/web.php` untuk memblokir Member:_

```php
// Penempatan 'role:admin' memanggil RoleMiddleware yang kita buat
Route::prefix('admin')->middleware('role:admin')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('admin.dashboard');
});
```

---

