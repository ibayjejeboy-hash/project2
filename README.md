# 🏫 Portal Website & Sistem E-Rapor RA Al-Musyafallahi

[![Laravel](https://img.shields.io/badge/Laravel-11.x%20%2F%2012.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)

Aplikasi web terpadu resmi untuk **RA (Raudhatul Athfal) Al-Musyafallahi - Gabuswetan, Indramayu**. Sistem ini mencakup portal profil sekolah, sistem pendaftaran siswa baru (PPDB online), galeri dokumentasi kegiatan, integrasi asisten cerdas AI, serta modul pencatatan dan pencetakan **E-Rapor Kurikulum Merdeka (P5 & PPRA)** berbasis digital.

---

## 🌟 Fitur Utama

### 1. 🌐 Portal Publik & Profil Sekolah
- Beranda interaktif menampilkan profil RA, visi-misi, galeri foto, jadwal kegiatan, dan informasi terkini.
- Pengaturan identitas dan kontak sekolah fleksibel dari database (WhatsApp direct link, alamat, jam operasional).
- Peta lokasi terintegrasi dan modul kontak interaktif.

### 2. 📝 PPDB Online (Penerimaan Peserta Didik Baru)
- Formulir pendaftaran calon siswa lengkap dengan validasi data orang tua dan anak.
- Integrasi API data wilayah Indonesia (Provinsi, Kabupaten/Kota, Kecamatan).
- Panel review formulir untuk admin, cetak bukti daftar, dan tombol konversi pendaftar langsung menjadi data siswa aktif.

### 3. 📊 Sistem Penilaian E-Rapor Digital
- Berbasis **Kurikulum Merdeka Berbasis Cinta**, mengintegrasikan dimensi **P5 (Projek Penguatan Profil Pelajar Pancasila)** dan **PPRA (Profil Pelajar Rahmatan Lil Alamin)**.
- Input capaian nilai, ceklis indikator tumbuh kembang harian, dan deskripsi narasi capaian.
- Fitur cetak lembar rapor format resmi (A4 PDF) siap cetak dan bagikan ke wali murid.
- Hak akses berbasis peran: **Admin**, **Guru (Wali Kelas)**, dan **Siswa (Wali Murid)**.

### 4. 🤖 Asisten Chatbot AI
- Chatbot cerdas terintegrasi API **Google Gemini 3.6 Flash** untuk menjawab pertanyaan wali murid seputar pendaftaran, biaya SPP, fasilitas sekolah, dan jadwal kegiatan secara instan.
- System prompt chatbot dapat diatur langsung melalui panel admin.

### 5. 📸 Galeri Dokumentasi Kegiatan
- Manajemen foto kegiatan sekolah dengan kategori (Pembelajaran, Ekstrakurikuler, Outing Class, dsb).
- Mode tampilan digital dan fitur **Cetak Galeri Single / Multiple** untuk arsip akreditasi.

---

## 🛠️ Tech Stack & Kebutuhan Sistem

- **Backend:** PHP 8.2+ dengan Framework Laravel (Architecture MVC)
- **Frontend:** Laravel Blade, Vite, Tailwind CSS, Alpine.js
- **Database:** MySQL 8.0+
- **PDF Engine:** DomPDF (`barryvdh/laravel-dompdf`)
- **AI Integration:** Google Gemini API
- **Deployment & Server:** Docker, Docker Compose, Nginx Alpine, Nginx Proxy Manager (NPM), Cloudflare DNS & SSL

---

## 💻 Panduan Instalasi Lokal (Local Development)

### Prasyarat
Pastikan laptop/komputer Anda telah terinstall:
- PHP >= 8.2
- Composer >= 2.x
- Node.js >= 20.x & NPM
- MySQL Server (misalnya melalui Laragon, XAMPP, atau Docker)
- Git

### Langkah Instalasi
1. **Clone repository:**
   ```bash
   git clone https://github.com/ibayjejeboy-hash/project2.git web-sekolah
   cd web-sekolah
   ```

2. **Salin file environment:**
   ```bash
   cp .env.example .env
   ```

3. **Install dependensi PHP & Node.js:**
   ```bash
   composer install
   npm install
   ```

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Konfigurasi Database di `.env`:**
   Sesuaikan konfigurasi database lokal Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=erapor_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Migrasi Database & Jalankan Seeder:**
   ```bash
   php artisan migrate --seed
   ```

7. **Buat Symlink Storage Publik:**
   ```bash
   php artisan storage:link
   ```

8. **Build Aset Frontend & Jalankan Server:**
   ```bash
   # Terminal 1 - Aset Frontend
   npm run dev

   # Terminal 2 - Laravel Development Server
   php artisan serve
   ```
   Akses aplikasi di browser melalui `http://127.0.0.1:8000`.

---

## 🚀 Panduan Deployment ke Production (VPS Docker & CI/CD)

Aplikasi telah dilengkapi konfigurasi **Docker Multi-Stage Build** dan otomatisasi **GitHub Actions** untuk zero-downtime deployment.

### 1. Struktur Docker
- **`Dockerfile`**: Menggunakan Multi-Stage build. Tahap 1 mengompilasi aset Vite dengan `node:20-alpine`, tahap 2 menjalankan PHP-FPM 8.2 bersama Nginx pada `php:8.2-fpm-alpine`.
- **`docker-compose.yml`**: Memetakan container ke port `8092:80`, terhubung ke bridge network database (`bimbelrbs_network`) dan reverse proxy (`npm_default`).
- **`deploy.sh`**: Skrip otomatisasi build container, permission storage, migrasi database, database seeder, dan optimasi cache Laravel.

### 2. Manual Deploy di VPS
1. Masuk ke server VPS via SSH:
   ```bash
   ssh user@ip-vps
   ```
2. Clone repository ke direktori server:
   ```bash
   git clone https://github.com/ibayjejeboy-hash/project2.git /home/miomideveloper/e-raport-almusyafallahi
   cd /home/miomideveloper/e-raport-almusyafallahi
   ```
3. Siapkan file `.env` production dengan kredensial database container:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://e-raport.almusyafallahi.id

   DB_CONNECTION=mysql
   DB_HOST=miomidev-mysql
   DB_PORT=3306
   DB_DATABASE=erapor_db
   DB_USERNAME=root
   DB_PASSWORD=PasswordDatabaseAnda
   ```
4. Jalankan script deploy:
   ```bash
   chmod +x deploy.sh
   ./deploy.sh
   ```

### 3. Otomasi CI/CD via GitHub Actions
Setiap kali ada commit baru yang di-push ke branch `main`, workflow `.github/workflows/deploy.yml` akan secara otomatis mengeksekusi pipeline deployment ke VPS melalui SSH.

**Pastikan Repository Secrets telah dikonfigurasi di GitHub:**
- Buka repository: **Settings > Secrets and variables > Actions**
- Tambahkan secret berikut:
  - `SSH_HOST`: IP publik VPS Anda (misal: `20.235.122.107`)
  - `SSH_USERNAME`: Username SSH server (misal: `miomideveloper`)
  - `SSH_PASSWORD`: Password user SSH server
  - *(Opsional)* `SSH_KEY`: Private SSH Key jika menggunakan autentikasi key.

---

## 🔑 Akun Default (Hasil Seeder)

Setelah menjalankan `php artisan db:seed`, akun berikut siap digunakan:

| Role | Email | Password Default | Keterangan |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin@almusyafallahi.id` | `password123` | Akses penuh dashboard, PPDB, pengaturan, user |
| **Guru (Wali Kelas A)** | `guru.fatimah@almusyafallahi.id` | `password123` | Manajemen e-rapor & penilaian Kelompok A |
| **Guru (Wali Kelas B)** | `guru.aisyah@almusyafallahi.id` | `password123` | Manajemen e-rapor & penilaian Kelompok B |
| **Siswa Contoh** | `rayyan@almusyafallahi.id` | `password123` | Portal wali murid untuk cek rapor anak |

> [!WARNING]
> Sangat disarankan untuk segera mengganti password default melalui menu profil admin setelah instalasi pertama di production.

---

## 📁 Struktur Direktori Penting

```text
├── app/
│   ├── Http/Controllers/       # Logika controller (Admin, Erapor, Galeri, Chatbot, PPDB)
│   ├── Models/                 # Model Eloquent (User, Siswa, Kelas, Nilai, Pengaturan)
│   └── Providers/              # AppServiceProvider & global view composers
├── config/                     # Konfigurasi sistem (database, services, session)
├── database/
│   ├── migrations/             # 22 file skema tabel database
│   └── seeders/                # DatabaseSeeder & PengaturanSeeder
├── docker/
│   └── nginx.conf              # Konfigurasi internal Nginx web server
├── resources/
│   ├── views/                  # Blade template (layouts, admin, erapor, pendaftaran, galeri)
│   ├── css/ & js/              # Sumber frontend Tailwind CSS & JavaScript
├── routes/
│   └── web.php                 # Rute utama portal publik & dashboard admin
├── .github/workflows/
│   └── deploy.yml              # Pipeline otomatis GitHub Actions CI/CD
├── Dockerfile                  # Multi-stage image build
├── docker-compose.yml          # Definisi service & network docker
└── deploy.sh                   # Shell script deployment production
```

---

## 📜 Lisensi & Hak Cipta

Dikembangkan untuk **RA Al-Musyafallahi - Indramayu**. Hak cipta dilindungi undang-undang.
