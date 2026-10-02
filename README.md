# BD Katalog

Katalog digital produk mahasiswa untuk **Business Development**, tempat memperkenalkan produk, karya, dan potensi bisnis mahasiswa dalam satu platform.

Demo: https://katalogbd.usri.cloud

## Overview

BD Katalog adalah **digital storefront**, bukan marketplace. Pengunjung dapat melihat produk, mencari berdasarkan nama atau kategori, mengenal mahasiswa di balik setiap produk, lalu memesan langsung melalui WhatsApp penjual.

Platform terdiri dari tiga bagian:

- **Website publik** untuk pengunjung.
- **Dashboard reseller** untuk mahasiswa yang mengelola profil dan mengajukan produk.
- **Panel Super Admin** (Filament) untuk mengelola data dan menyetujui produk.

## Features

**Website publik**

- Katalog produk dengan pencarian dan filter kategori
- Detail produk: galeri foto, keunggulan, dan produk serupa
- Produk populer dan produk baru
- Profil mahasiswa penjual ("Sosok di Balik Produk")
- Tombol pesan via WhatsApp
- Halaman Tentang BD, Kolaborasi, Kabar Terbaru, dan Kontak
- Chatbot FAQ
- Responsive

**Reseller**

- Registrasi dan login
- Dashboard ringkasan produk
- Kelola profil dan foto profil
- Tambah produk dengan banyak foto dan daftar keunggulan
- Pantau status produk dan alasan penolakan

**Super Admin**

- Kelola kategori, reseller, dan produk
- Setujui atau tolak produk
- Kelola berita, kolaborasi, dan FAQ chatbot

## Alur Persetujuan Produk

```text
Reseller menambah produk → Pending → Super Admin
                                      ├─ Approve → tampil di katalog publik
                                      └─ Reject  → reseller melihat alasan penolakan
```

Status produk: `pending`, `approved`, `rejected`. Hanya produk `approved` yang tampil di katalog.

## Tech Stack

PHP 8.2+, Laravel, MySQL, Blade, Filament, Vite.

## Requirements

- PHP 8.2 atau lebih baru
- Composer
- Node.js 20+ dan npm
- MySQL
- Git
- Ekstensi PHP

Pengguna Windows disarankan memakai **Laragon**.

## Installation

**1. Clone repository**

```bash
git clone https://github.com/Riahulina/Business-Decelopment-Katalog
cd REPOSITORY
```

**2. Install dependency**

```bash
composer install
npm install
```

**3. Buat file `.env`**

```bash
cp .env.example .env
```

Pengguna Windows PowerShell: `Copy-Item .env.example .env`

**4. Atur database di `.env`**

```env
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bd-katalog
DB_USERNAME=root
DB_PASSWORD=
```

**5. Buat database**

```sql
CREATE DATABASE bd-katalog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**6. Generate key, migrasi, dan data awal**

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```

**7. Build frontend dan jalankan**

```bash
npm run build
php artisan serve
```

Buka `http://127.0.0.1:8000`.

Untuk development, jalankan `npm run dev` di terminal kedua.

## Akses

| Bagian             | URL          |
| ------------------ | ------------ |
| Website            | `/`          |
| Katalog produk     | `/produk`    |
| Dashboard reseller | `/dashboard` |
| Panel Super Admin  | `/admin`     |

Akun reseller dibuat melalui halaman **Daftar**. Panel admin hanya dapat diakses akun dengan role Super Admin.

## Database

| Tabel                | Isi                           |
| -------------------- | ----------------------------- |
| `users`              | Akun dan role                 |
| `resellers`          | Profil mahasiswa penjual      |
| `categories`         | Kategori produk               |
| `products`           | Produk dan status persetujuan |
| `product_images`     | Foto produk                   |
| `product_highlights` | Keunggulan produk             |
| `news`               | Berita                        |
| `collaborations`     | Kolaborasi                    |

## Deployment

```bash
composer install --no-dev --optimize-autoloader
npm install && npm run build
cp .env.example .env
php artisan key:generate
```

Atur `.env` production:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-website.com
```

Lalu isi konfigurasi database dan jalankan:

```bash
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan optimize
```

Arahkan document root server ke folder `public`. Folder `storage` dan `bootstrap/cache` harus dapat ditulis oleh web server.

## License

Dibuat untuk kebutuhan Business Development dan kompetisi pengembangan website.
