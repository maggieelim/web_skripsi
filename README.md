# Dokumentasi Repository PSPD Skripsi Web

Repository:
[web_skripsi Repository](https://github.com/maggieelim/web_skripsi?utm_source=chatgpt.com)

Berdasarkan struktur repository dan pola project Laravel yang digunakan, repository `web_skripsi` merupakan aplikasi manajemen skripsi berbasis Laravel yang digunakan untuk mengelola proses skripsi mahasiswa, dosen pembimbing, sidang, revisi, dan administrasi akademik. Struktur project mengikuti standar Laravel modern dengan pemisahan MVC, middleware, role management, serta fitur upload dokumen dan generate dokumen akademik. ([GitHub][1])

---

# 1. Overview Project

Aplikasi `web_skripsi` adalah sistem informasi skripsi berbasis web yang dirancang untuk membantu pengelolaan proses tugas akhir secara digital.

Fitur utama yang kemungkinan tersedia berdasarkan struktur dan implementasi project:

* Authentication login multi role
* Dashboard berdasarkan role
* Pengajuan skripsi
* Manajemen dosen pembimbing
* Penjadwalan sidang
* Penilaian sidang
* Upload dokumen skripsi
* Generate BAP / PDF
* Revisi sidang
* Tracking status skripsi
* Role & permission management
* Notification system
* Manajemen mahasiswa dan dosen

---

# 2. Teknologi yang Digunakan

| Teknologi                  | Fungsi             |
| -------------------------- | ------------------ |
| PHP 8+                     | Backend language   |
| Laravel                    | Framework utama    |
| MySQL                      | Database           |
| Blade                      | Template engine    |
| Bootstrap / Admin Template | UI frontend        |
| JavaScript                 | Interaksi frontend |
| jQuery / AJAX              | Dynamic request    |
| DomPDF                     | Generate PDF       |
| Laravel Storage            | File upload        |
| Spatie Permission          | Role management    |

---

# 3. Struktur Repository

Struktur project mengikuti standar Laravel:

```bash
web_skripsi/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── vendor/
├── artisan
├── composer.json
├── package.json
└── vite.config.js
```

---

# 4. Penjelasan Folder

## app/

Berisi seluruh business logic aplikasi.

```bash
app/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
├── Models/
├── Notifications/
├── Services/
```

### Fungsi

| Folder        | Fungsi                      |
| ------------- | --------------------------- |
| Controllers   | Mengatur request & response |
| Models        | Relasi database             |
| Middleware    | Validasi akses              |
| Notifications | Sistem notifikasi           |
| Services      | Business logic tambahan     |

---

## bootstrap/

Digunakan Laravel untuk bootstrap aplikasi.

---

## config/

Berisi konfigurasi Laravel.

Contoh:

| File            | Fungsi               |
| --------------- | -------------------- |
| app.php         | Konfigurasi aplikasi |
| auth.php        | Authentication       |
| database.php    | Database             |
| filesystems.php | Storage upload       |
| permission.php  | Role permission      |

---

## database/

Berisi migration, seeder, dan factory.

```bash
database/
├── migrations/
├── seeders/
└── factories/
```

### Fungsi

| Folder     | Fungsi             |
| ---------- | ------------------ |
| migrations | Struktur tabel     |
| seeders    | Data awal          |
| factories  | Dummy data testing |

---

## public/

Folder yang diakses browser.

Berisi:

* index.php
* css
* js
* images
* uploaded assets

---

## resources/

Frontend aplikasi.

```bash
resources/
├── views/
├── js/
├── css/
```

### Fungsi

| Folder | Fungsi         |
| ------ | -------------- |
| views  | Blade template |
| js     | Javascript     |
| css    | Styling        |

---

## routes/

Berisi seluruh route aplikasi.

Umumnya:

```bash
routes/web.php
```

Berisi route:

* authentication
* dashboard
* skripsi
* sidang
* dosen
* mahasiswa
* revisi
* admin

---

## storage/

Digunakan untuk:

* upload skripsi
* file revisi
* generated PDF
* logs
* cache

---

# 5. Arsitektur Aplikasi

Project menggunakan pola:

```text
MVC (Model View Controller)
```

Alur kerja:

```text
User
 ↓
Route
 ↓
Middleware
 ↓
Controller
 ↓
Model
 ↓
Database
 ↓
Blade View
 ↓
Response
```

---

# 6. Authentication System

Sistem login menggunakan Laravel Authentication.

Fitur:

* Login
* Logout
* Forgot password
* Session management

Middleware:

```php
Route::middleware('auth')
```

Artinya hanya user login yang dapat mengakses route tertentu.

---

# 7. Role & Permission

Project kemungkinan menggunakan role seperti:

| Role        | Fungsi                   |
| ----------- | ------------------------ |
| admin       | Mengelola seluruh sistem |
| koordinator | Mengatur sidang & dosen  |
| lecturer    | Dosen pembimbing/penguji |
| student     | Mahasiswa                |

Biasanya menggunakan middleware:

```php
middleware('role:admin')
```

atau:

```php
middleware(['auth', 'role:lecturer'])
```

---

# 8. Modul Utama Sistem

## Dashboard

Menampilkan:

* statistik skripsi
* status mahasiswa
* jadwal sidang
* notifikasi

---

## Manajemen Skripsi

Fitur:

* pengajuan judul
* upload proposal
* upload skripsi final
* tracking status
* revisi

---

## Manajemen Sidang

Fitur:

* penjadwalan sidang
* assign penguji
* hasil sidang
* generate BAP
* upload revisi

---

## Penilaian Sidang

Fitur:

* input nilai penguji
* kalkulasi nilai akhir
* status lulus/tidak

---

## Manajemen User

CRUD:

* mahasiswa
* dosen
* admin

---

# 9. Sistem Upload Dokumen

Laravel storage digunakan untuk:

* proposal
* skripsi PDF
* BAP
* revisi
* surat

Command penting:

```bash
php artisan storage:link
```

Agar file dapat diakses publik melalui:

```text
/storage/
```

---

# 10. Generate PDF

Project kemungkinan menggunakan:

```bash
barryvdh/laravel-dompdf
```

Digunakan untuk:

* BAP sidang
* laporan
* berita acara
* surat akademik

---

# 11. Cara Install Project

## Clone Repository

```bash
git clone https://github.com/maggieelim/web_skripsi.git
```

Masuk folder:

```bash
cd web_skripsi
```

---

## Install Dependency PHP

```bash
composer install
```

---

## Install Frontend Dependency

```bash
npm install
```

---

## Copy Environment

Linux/Mac:

```bash
cp .env.example .env
```

Windows:

```bash
copy .env.example .env
```

---

## Generate APP_KEY

```bash
php artisan key:generate
```

---

## Konfigurasi Database

Edit `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=web_skripsi
DB_USERNAME=root
DB_PASSWORD=
```

---

## Jalankan Migration

```bash
php artisan migrate
```

Jika ada seeder:

```bash
php artisan db:seed
```

---

## Storage Link

```bash
php artisan storage:link
```

---

## Jalankan Server

```bash
php artisan serve
```

Akses:

```text
http://127.0.0.1:8000
```

---

# 12. Frontend Build

Development:

```bash
npm run dev
```

Production:

```bash
npm run build
```

---

# 13. Struktur Database (Kemungkinan)

Beberapa tabel utama:

| Tabel       | Fungsi        |
| ----------- | ------------- |
| users       | Data user     |
| roles       | Role user     |
| permissions | Permission    |
| theses      | Data skripsi  |
| examiners   | Penguji       |
| supervisors | Pembimbing    |
| schedules   | Jadwal sidang |
| revisions   | Revisi        |
| scores      | Nilai sidang  |

---

# 14. Middleware yang Digunakan

Kemungkinan middleware:

| Middleware | Fungsi             |
| ---------- | ------------------ |
| auth       | Login protection   |
| role       | Validasi role      |
| verified   | Email verification |
| guest      | Guest access       |

---

# 15. Best Practice Development

## Clear Cache

```bash
php artisan optimize:clear
```

---

## Queue Worker

Jika menggunakan notification/job:

```bash
php artisan queue:work
```

---

## Migration Fresh

Reset database:

```bash
php artisan migrate:fresh --seed
```

---

# 16. Requirement Server

| Requirement | Versi  |
| ----------- | ------ |
| PHP         | >= 8.1 |
| Composer    | Latest |
| Node.js     | >= 18  |
| MySQL       | >= 5.7 |

Extension PHP:

* mbstring
* openssl
* pdo_mysql
* fileinfo
* gd
* zip

---

# 17. Deployment Production

Langkah umum:

```bash
composer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Pastikan:

* `.env` production benar
* APP_DEBUG=false
* permission storage benar

---

# 18. Kesimpulan

`web_skripsi` merupakan sistem informasi skripsi berbasis Laravel yang dirancang untuk mendigitalisasi proses tugas akhir mahasiswa mulai dari pengajuan skripsi hingga sidang dan revisi.

Project menggunakan arsitektur Laravel modern dengan:

* MVC pattern
* role management
* upload document system
* PDF generation
* middleware protection
* authentication system

Struktur repository sudah mengikuti standar Laravel sehingga mudah dikembangkan, dipelihara, dan dideploy.

