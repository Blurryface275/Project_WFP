# VitaGuard — Web-Based Health Service Platform

A Laravel 10 web application for digital health services, developed as a semester project for Web Framework Programming (1604C063) at Universitas Surabaya.

## About

VitaGuard enables users to access online health consultations, book appointments with doctors, and read health-related articles. The system supports three user roles: **Admin**, **Doctor**, and **Member**.

## System Architecture

The application strictly enforces a dual-layout structure based on user roles:

1. **Admin / Doctor Layout (`layouts.admin-app`)**: Features a comprehensive dashboard panel (AdminLTE) with sidebar navigation and statistic widgets. Used internally for managerial and back-office tasks.
2. **Member Layout (`layouts.member-app`)**: A clean, modern, and public-facing design used by ordinary members or unauthenticated users to browse services, see doctors, and read articles safely.

Admin and Doctors share the same backend layout UI, however, their functional accesses are strictly isolated via routing and view boundaries. Admin possesses master CRUD privileges while Doctors are limited to consultation updates.

## Tech Stack

- **Framework:** Laravel 10
- **Language:** PHP 8.2
- **Database:** MySQL
- **Frontend:** Blade Templates (AdminLTE v3 for Dashboard + Bootstrap 5 for Public UI)

---

## Active Routing & URLs

The following is a complete list of routes currently configured in the application.

### 🌐 Public / Member Routes (Layout `member-app`)

These routes are publicly accessible or meant for Member navigation:

- `GET /welcome` - Beranda Utama sistem.
- `GET /artikel` - Halaman daftar artikel publik (UI Placeholder).
- `GET /articles` & `/articles/{id}` - Membaca daftar dan detail artikel via `ArticleController`.
- `GET /categories` - Melihat daftar kategori layanan.
- `GET /services` & `/services/{id}` - Melihat daftar detail layanan.
- `GET /doctor` - Halaman placeholder direktori dokter.
- `GET /doctors` - Melihat list dokter lewat _Resource Controller_.
- `GET /jadwalDoctor` - Menampilkan jadwal praktik yang ada.
- _Placeholder Pages_: `/menu`, `/menu/konsultasi`, `/menu/janji`, `/menu/riwayat`.

### 🛡 Admin Routes (Layout `admin-app`)

Dashboard dan tabel manajerial. Akan dikunci khusus untuk Admin.

- `GET /admin/dashboard` - Pusat monitoring administrator (Statistik & Data Tinjauan).
- `GET /admin/manageuser` - (_admin.users_) Mengelola relasi User dari database.
- `GET /admin/listdoctor` - (_admin.doctor.list_) Menampilkan datatables dokter-dokter terdaftar utuh.
- `GET /admin/detaildoctor/{id}` - Membaca detail data manajemen untuk seorang dokter spesifik.
- `GET /admin/categories`, `/admin/order`, `/admin/members` - _Future implementation / CRUD placeholders_.

### ⚕ Dokter Routes (Layout `admin-app`)

Dashboard pelayanan medis untuk tenaga medik. Akan dikunci khusus untuk Dokter.

- `GET /doctor/dashboard` - Menampilkan statistik jadwal harian dan total pasien harian dokter.
- `GET /doctor/profile` - Mengelola detail akun, portofolio profil tenaga medis dan preferensi.
- `GET /doctor/consultations` - Meninjau tabel histori jadwal, _chat_ yang berjalan maupun antrian terbaru.

---

## Database Schema (Migrated Data)

| Table              | Description                                                          | Includes Seeder |
| ------------------ | -------------------------------------------------------------------- | --------------- |
| `users`            | User accounts with role-based access (`admin` / `doctor` / `member`) | ✅              |
| `categories`       | Health service categories                                            | ✅              |
| `services`         | Available health services linked to categories                       | ✅              |
| `doctors`          | Doctor profiles linked to user accounts                              | ✅              |
| `doctor_schedules` | Doctor available operational practice hours                          | ✅              |
| `articles`         | Health articles authored by doctors                                  | ❌              |
| `transactions`     | Consultation bookings/bills and records                              | ❌              |

_(Next milestone: Need to build standard tables for handling the core messaging feature / Consultation Chats and refined Bookings logic)._

## Local Setup

1. **Clone project:**
    ```bash
    git clone "https://github.com/Blurryface275/Project_WFP.git"
    cd Project_WFP
    ```
2. **Install dependencies:**
    ```bash
    composer install
    ```
3. **Environment Setup:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    _(Configure your local DB credentials in the new `.env` file!)_
4. **Database Migration & Seeding:**
    ```bash
    php artisan migrate:fresh
    php artisan db:seed
    ```
5. **Run Server:**
    ```bash
    php artisan serve
    ```
