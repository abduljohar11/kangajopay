<div align="center">

# 🚀 Kangajopay (Laravel 13 + Vue + Tailwind + Docker Sail)

Aplikasi modern berbasis **Laravel 13** yang terintegrasi dengan **Vue.js**, **Tailwind CSS**, dan dikemas menggunakan lingkungan kontainerisasi **Laravel Sail (Docker)** untuk kemudahan _development_.

[![Laravel Version](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Vue.js](https://img.shields.io/badge/Vue.js-3.x-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)](https://vuejs.org)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4-38BDF8?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Docker Sail](https://img.shields.io/badge/Docker-Sail-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://laravel.com/docs/sail)
[![License: AGPL v3](https://img.shields.io/badge/License-AGPL_v3-blue.svg?style=for-the-badge)](https://www.gnu.org/licenses/agpl-3.0)

</div>

---

## 🛠️ Tech Stack

- **Backend:** Laravel 13 (PHP 8.5)
- **Frontend:** Vue.js (Inertia.js / SPA) & Tailwind CSS v4
- **Database:** MariaDB 11
- **Cache & Session:** Redis (Alpine)
- **Environment:** Docker & Laravel Sail

---

## 📋 Prasyarat

Sebelum menjalankan proyek ini di komputer lokal Anda, pastikan sistem Anda telah terinstal:

- [Docker](https://www.docker.com/) & [Docker Compose](https://docs.docker.com/compose/)
- Git

---

## ⚙️ Cara Instalasi & Menjalankan Proyek

Ikuti langkah-langkah berikut untuk mengatur dan menjalankan proyek di lingkungan lokal Anda:

### 1. Klon Repositori

```bash
git clone [https://github.com/USERNAME/kangajopay.git](https://github.com/USERNAME/kangajopay.git)
cd kangajopay

```

### 2. Salin File Konfigurasi Lingkungan (`.env`)

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env

```

_(Sesuaikan konfigurasi database atau port pada file `.env` jika diperlukan)._

### 3. Jalankan Docker Containers (Laravel Sail)

Nyalakan seluruh container di _background_ menggunakan Laravel Sail:

```bash
./vendor/bin/sail up -d

```

### 4. Instal Dependensi PHP & Frontend (Node.js)

Jalankan instalasi paket melalui container Sail agar tidak memerlukan Composer/Node di mesin host Anda:

```bash
# Instal dependensi PHP (jika belum)
./vendor/bin/sail composer install

# Instal dependensi Frontend
./vendor/bin/sail npm install

```

### 5. Generate Application Key & Migrasi Database

Buat _App Key_ dan jalankan migrasi tabel database MariaDB:

```bash
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate

```

### 6. Jalankan Vite Development Server

Untuk mengaktifkan _Hot Module Replacement_ (HMR) pada frontend Vue & Tailwind:

```bash
./vendor/bin/sail npm run dev

```

---

## 🌐 Akses Aplikasi

Setelah semua layanan berjalan, Anda dapat mengakses aplikasi melalui browser:

- **Aplikasi Web:** [http://localhost](http://localhost) (atau sesuai `APP_PORT` di `.env`)
- **Vite Dev Server:** `http://localhost:5173`
- **Database (MariaDB):** Port `3306` (Host: `127.0.0.1`, User: `sail`, Password: `password`)
- **Redis:** Port `6379`

---

## 🛑 Perintah Umum Laravel Sail

| Perintah                        | Deskripsi                                      |
| ------------------------------- | ---------------------------------------------- |
| `./vendor/bin/sail up -d`       | Menyalakan semua container di background       |
| `./vendor/bin/sail stop`        | Mematikan container                            |
| `./vendor/bin/sail artisan ...` | Menjalankan perintah Artisan Laravel           |
| `./vendor/bin/sail npm ...`     | Menjalankan perintah NPM / Node                |
| `./vendor/bin/sail shell`       | Masuk ke dalam shell container aplikasi (bash) |

---

## 🤝 Kontribusi

Kontribusi, _issues_, dan _pull requests_ sangat dipersilakan! Silakan buat _issue_ terlebih dahulu jika ingin mendiskusikan perubahan besar.

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **GNU Affero General Public License v3.0 (AGPL-3.0)** — lihat file [LICENSE](https://www.google.com/search?q=LICENSE) untuk detail selengkapnya.

> Copyright (C) 2007 Free Software Foundation, Inc. <[https://fsf.org/](https://fsf.org/)>
> Everyone is permitted to copy and distribute verbatim copies of this license document, but changing it is not allowed.

```

```
