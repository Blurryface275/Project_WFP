# VitaGuard — Web-Based Health Service Platform

A Laravel 10 web application for digital health services, developed as a semester project for Web Framework Programming (1604C063) at Universitas Surabaya.

## About

VitaGuard enables users to access online health consultations, book appointments with doctors, and read health-related articles. The system supports three user roles: **Admin**, **Doctor**, and **Member**.

## Tech Stack

- **Framework:** Laravel 10
- **Language:** PHP 8.2
- **Database:** MySQL
- **Frontend:** Blade Templates + Bootstrap 5

## Features (Milestone Project Week 4)

- [x] Routing & static views
- [x] Database migration — 6 tables with foreign key constraints 
- [ ] Database seeding with Factory & Seeder - only Users and Categories table
- [ ] Controller to handle master data
- [ ] Simple UI to display master data 

## Database Schema

| Table | Description |
|-------|-------------|
| `users` | User accounts with role-based access (admin/doctor/member) |
| `categories` | Health service categories |
| `services` | Available health services linked to categories |
| `doctors` | Doctor profiles linked to user accounts |
| `articles` | Health articles authored by doctors |
| `transactions` | Consultation bookings and appointment records |

Note: The `users` table includes a `role` column with three possible values: `admin`, `doctor`, and `member`.

## Setup
```bash
git clone "https://github.com/Blurryface275/Project_WFP.git"
composer install
cp .env.example .env
php artisan key:generate
# Configure DB credentials in .env
php artisan migrate
php artisan db:seed
php artisan serve
```
