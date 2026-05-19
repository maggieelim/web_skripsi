# Web Skripsi Documentation

## Overview

Web Skripsi adalah aplikasi berbasis web untuk manajemen skripsi / tugas akhir mahasiswa yang dibangun menggunakan framework Laravel.

Sistem ini dirancang untuk membantu proses:

* Pengajuan skripsi
* Penentuan dosen pembimbing
* Penjadwalan sidang
* Penilaian sidang
* Upload dokumen akademik
* Monitoring revisi
* Dashboard akademik

Project menggunakan arsitektur MVC Laravel dan memanfaatkan Blade Template untuk frontend.

Repository:

[web_skripsi Repository](https://github.com/maggieelim/web_skripsi?utm_source=chatgpt.com)

---

# Tech Stack

## Backend

* PHP
* Laravel
* MySQL
* Eloquent ORM

## Frontend

* Blade Template
* Bootstrap / Admin Template
* JavaScript
* AJAX

## Tools

* Composer
* Node.js & NPM
* Git

---

# Project Structure

```bash
web_skripsi/
│
├── app/
│   ├── Console/
│   ├── Exceptions/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   ├── Notifications/
│   └── Providers/
│
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
│
├── public/
├── resources/
│   ├── views/
│   ├── js/
│   └── css/
│
├── routes/
│   ├── web.php
│   └── api.php
│
├── storage/
├── tests/
├── vendor/
├── .env
├── artisan
├── composer.json
└── package.json
```

---

# Installation Guide

## 1. Clone Repository

```bash
git clone https://github.com/maggieelim/web_skripsi.git
cd web_skripsi
```

---

## 2. Install Dependency PHP

```bash
composer install
```

---

## 3. Install Dependency Frontend

```bash
npm install
```

---

## 4. Copy Environment File

Linux / Mac:

```bash
cp .env.example .env
```

Windows:

```bash
copy .env.example .env
```

---

## 5. Generate Laravel Key

```bash
php artisan key:generate
```

---

# Database Configuration

Edit file `.env`

## MySQL Example

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=web_skripsi
DB_USERNAME=root
DB_PASSWORD=
```

---

# Run Migration

```bash
php artisan migrate
```

Jika terdapat seeder:

```bash
php artisan db:seed
```

Atau:

```bash
php artisan migrate --seed
```

---

# Storage Configuration

Jalankan command berikut:

```bash
php artisan storage:link
```

Agar file upload dapat diakses melalui browser.

Contoh akses:

```bash
/storage/filename.pdf
```

---

# Run Application

## Backend Laravel

```bash
php artisan serve
```

Default:

```bash
http://127.0.0.1:8000
```

---

# Authentication

Sistem memiliki beberapa role user, misalnya:

* Admin
* Koordinator
* Dosen
* Mahasiswa

Role dapat dicek pada:

* migration users
* model User
* middleware role
* controller auth

---

# Main Modules

## 1. Authentication

Fitur:

* Login
* Logout
* Session management
* Middleware authentication

Lokasi:

```bash
app/Http/Controllers/Auth/
```

---

## 2. Dashboard

Menampilkan:

* Statistik skripsi
* Jadwal sidang
* Status mahasiswa
* Informasi revisi

Lokasi:

```bash
resources/views/dashboard/
```

---

## 3. Thesis Management

Fitur:

* Pengajuan judul
* Upload proposal
* Upload skripsi
* Monitoring progress
* Validasi pembimbing

Controller:

```bash
app/Http/Controllers/
```

---

## 4. Examiner & Supervisor Management

Fitur:

* Assign dosen pembimbing
* Assign dosen penguji
* Monitoring bimbingan
* Monitoring sidang

Relasi:

* Thesis belongsToMany Lecturers

---

## 5. Thesis Defense Management

Fitur:

* Penjadwalan sidang
* Generate berita acara
* Input hasil sidang
* Upload revisi

---

## 6. Scoring & Evaluation

Fitur:

* Input nilai penguji
* Kalkulasi nilai akhir
* Status kelulusan
* Rekap hasil sidang

---

## 7. Document Management

Fitur:

* Upload proposal
* Upload skripsi final
* Upload revisi
* Download dokumen

---

# Routing

Semua routing web terdapat di:

```bash
routes/web.php
```

Contoh:

```php
Route::middleware(['auth'])->group(function () {
    Route::resource('thesis', ThesisController::class);
});
```

---

# Database Design

## Main Tables

| Table       | Function            |
| ----------- | ------------------- |
| users       | Menyimpan data user |
| roles       | Hak akses user      |
| theses      | Data skripsi        |
| supervisors | Data pembimbing     |
| examiners   | Data penguji        |
| schedules   | Jadwal sidang       |
| revisions   | Data revisi         |
| scores      | Nilai sidang        |

---

# Important Laravel Commands

## Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## Optimize

```bash
php artisan optimize
```

---

## Queue

Jika menggunakan queue:

```bash
php artisan queue:work
```

---

## Schedule

Cek scheduler:

```bash
php artisan schedule:list
```

Run scheduler:

```bash
php artisan schedule:work
```

Cron Linux:

```bash
* * * * * php /path-to-project/artisan schedule:run >> /dev/null 2>&1
```

---

# PDF Generation

Project dapat menggunakan package:

```bash
barryvdh/laravel-dompdf
```

Digunakan untuk:

* Berita acara sidang
* Laporan
* Dokumen akademik
* Rekap nilai

---

# Common Errors

## 1. Vendor Missing

```bash
composer install
```

---

## 2. APP_KEY Missing

```bash
php artisan key:generate
```

---

## 3. Storage 404

```bash
php artisan storage:link
```

---

## 4. Migration Error

Pastikan:

* database sudah dibuat
* konfigurasi `.env` benar

---

## 5. Permission Error Linux

```bash
chmod -R 775 storage bootstrap/cache
```

---

# Deployment Guide

## Queue & Scheduler

Gunakan:

* Supervisor
* Cronjob

---

## Web Server

Disarankan:

* Nginx
* Apache

Root folder:

```bash
/public
```

---

# Coding Standard

## Naming

### Controller

```bash
ThesisController
```

### Model

```bash
Thesis
```

### Migration

```bash
create_theses_table
```

---

# Best Practice

## Saat Menambahkan Fitur Baru

1. Buat migration
2. Buat model
3. Buat controller
4. Tambahkan route
5. Tambahkan view
6. Tambahkan validation
7. Testing

---

# Recommended Improvements

## Backend

* Gunakan Form Request Validation
* Gunakan Service Layer
* Tambahkan Repository Pattern

## Security

* CSRF Protection
* Activity Logging
* Rate Limiting

## Performance

* Redis cache
* Queue optimization
* Eager loading relation

---

# Contribution Guide

## Branch Naming

```bash
feature/thesis-module
fix/login-bug
```

---

## Commit Convention

```bash
feat: add thesis revision feature
fix: repair thesis upload validation
refactor: optimize dashboard query
```

---

# Future Development Suggestions

## Potential Features

* Email notification
* Real-time status tracking
* Digital signature
* Automatic plagiarism integration

---

# Developer Notes

## Important Files

| File                 | Function           |
| -------------------- | ------------------ |
| routes/web.php       | Main route         |
| app/Models           | Database models    |
| app/Http/Controllers | Business logic     |
| resources/views      | Frontend           |
| config/app.php       | Application config |
| .env                 | Environment config |

---

# Maintenance Checklist

## Sebelum Deploy

* [ ] Run test
* [ ] Clear cache
* [ ] Optimize app
* [ ] Backup database
* [ ] Check .env production
* [ ] Run migration
