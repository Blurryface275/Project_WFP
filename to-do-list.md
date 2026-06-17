# VitaGuard Project To-Do List

Berdasarkan spesifikasi **Lampiran_3309035** dan status pekerjaan saat ini, berikut adalah daftar periksa (To-Do List) fitur yang harus dikerjakan:

## 1. Setup & Konfigurasi Dasar

- [x] Mendefinisikan Struktur Layout Ganda (Layout Admin-Dokter vs Layout Member).
- [x] Implementasi Database Migration Dasar (Tabel User, Dokter, Kategori, Layanan, Artikel, Jadwal).
- [/] Implementasi Database Migration Lanjutan (Perlu migrasi tabel `bookings` dan riwayat pesan `consultation_chats`).
- [x] Implementasi Database Seeder (Membuat akun default Admin, Dokter, Layanan, dan Jadwal).
- [/] Membuat fitur Authentication (Mockup antarmuka dan file Controller sudah selesai. Tersisa logika database Auth::attempt).
- [ ] Konfigurasi Middleware / Hak Akses (Memblokir Member masuk rute Admin dengan respons _403 Forbidden Access_).

## 2. Refaktorisasi Direktori Admin & Dokter (Status: Perlu Diperbaiki Lanjut)

Kita telah merestrukturisasi layout-nya, namun penempatan rute CMS dan CRUD file blade belum dibuat secara komprehensif.

- [ ] **Admin**: Pindahkan dan buat file CRUD Master (Create, Edit, Delete, dan form-nya).
    - [ ] `admin/doctors/*` (Create, Edit, Index, Delete form)
    - [ ] `admin/users/*` (Create, Edit, Index, Delete form)
    - [ ] `admin/articles/*` (Create, Edit, Index, Delete form)
    - [ ] `admin/categories/*` (Create, Edit, Index, Delete form)
- [ ] **Dokter**: Hubungkan file placeholder yang sudah ada dengan _database logika (Controller)_.
    - [ ] `doctor/dashboard.blade.php` (Tampilkan statistik riwayat hari ini)
    - [ ] `doctor/profile.blade.php` (Fungsi agar dokter bisa update email/nama/foto sendiri)
    - [ ] `doctor/consultations.blade.php` (Ambil daftar pasien yang valid)

## 3. Modul Artikel Kesehatan

- [ ] **Admin**: Fitur CRUD Artikel (Teks dan Gambar) via `ArticleController`.
- [ ] **Member**: Menampilkan kartu semua Artikel dan detail (_Read Only_). Fitur pencarian artikel berdasarkan judul.

## 4. Modul Direktori & Jadwal Dokter

- [ ] **Admin**: Mengelola Profil Dokter, menentukan spesialisasi dan jadwal jam kerja.
- [ ] **Member**: Melihat tabel/kartu daftar dokter beserta detail spesialisasi dan pengalamannya.

## 5. Modul Booking Konsultasi (Inti Sistem)

- [ ] Member memilih Dokter, dan sistem menampilkan daftar jam kosong yang tersedia.
- [ ] Konfirmasi _form pemesanan_ janji.
- [ ] Menyimpan status `Booking` (Menunggu, Disetujui, Selesai).

## 6. Modul Konsultasi Online (Chat Module)

- [ ] **Member & Dokter**: Membuka obrolan (_chatting_) jika status booking valid.
- [ ] Menyimpan percakapan ke dalam database menggunakan ConsultationController.
- [ ] Dokter memiliki hak untuk menekan tombol **"Tutup Konsultasi / Selesai"**.
- [ ] Mencegah konsultasi yang sudah selesai untuk ditambahkan pesan baru.

## 7. Modul Riwayat Konsultasi & Dashboard

- [ ] **Member**: Melihat riwayat rekam medis dan histori percakapan yang pernah dilakukan.
- [ ] **Dokter**: Melihat riwayat yang sama untuk pasien yang pernah ditangani.
- [ ] **Admin Dashboard**: Menampilkan bagan & jumlah statistik total (Jumlah Dokter, Member, Konsultasi Berlangsung, dll) sesuai perintah halaman 4.

---

**Catatan Penting:**
Seluruh _Controller_ data master harus menggunakan fungsi standard _Resource Controller_ (`Route::resource`), dan transaksi _Query Builder / Eloquent_ untuk database. Penggunaan kueri mentah SQL tidak disarankan.
