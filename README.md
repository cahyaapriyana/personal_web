# Personal Web

[![Demo Online](https://img.shields.io/badge/Live%20Demo-codemind.id%2Fartikel-blue?style=for-the-badge)](https://codemind.id/artikel/)

Website pribadi berbasis **PHP** & **MySQL** dengan fitur artikel, galeri, about, kontak, dan dashboard admin. Dibangun menggunakan **TailwindCSS** untuk tampilan modern dan responsif.

---

## ✨ Fitur Utama

- **Artikel**
  - Lihat, cari, dan filter artikel berdasarkan kategori
  - Detail artikel & sistem komentar bertingkat (threaded)
  - Pagination untuk navigasi artikel
- **Galeri**
  - Koleksi gambar dengan judul
  - Modal preview gambar
- **About**
  - Profil singkat pemilik website
- **Kontak**
  - Formulir kirim pesan (nama, email, subjek, pesan)
  - Pesan masuk dikelola di dashboard admin
- **Dashboard Admin**
  - Statistik pengunjung (harian, mingguan, unique IP)
  - Kelola artikel, galeri, about, user, dan pesan kontak
  - Role user: Admin, Editor, Viewer
  - Fitur CRUD lengkap untuk semua konten

---

## 🛠️ Teknologi

- **Backend**: PHP 7/8, MySQL
- **Frontend**: TailwindCSS
- **Lainnya**: Chart.js (statistik), HTML5, CSS3

---

## 📁 Struktur Direktori

```
.
├── admin/              # Halaman & proses admin (artikel, galeri, user, about, kontak)
├── images/             # Gambar untuk galeri
├── src/                # Asset CSS & favicon
├── db_cahya_apriyana_d1a240400.sql # File SQL struktur & data awal database
├── index.php           # Halaman utama (artikel)
├── artikel.php         # Detail artikel & komentar
├── gallery.php         # Galeri foto
├── about.php           # Tentang saya
├── kontak.php          # Formulir kontak
├── koneksi.php         # Koneksi database
├── package.json        # Dependensi Tailwind
└── tailwind.config.js  # Konfigurasi Tailwind
```

---

## 🚀 Instalasi & Setup

1. **Clone repo ini**
2. **Import database**
   - Buat database baru di MySQL, import `db_cahya_apriyana_d1a240400.sql`
3. **Konfigurasi koneksi**
   - Edit `koneksi.php` jika perlu (default: root tanpa password)
4. **Install TailwindCSS (opsional, jika ingin rebuild CSS)**
   ```bash
   npm install
   npx tailwindcss -i src/input.css -o src/output.css --watch
   ```
5. **Jalankan di localhost**
   - Letakkan di folder web server (misal: `htdocs`/`www` di XAMPP/Laragon)
   - Akses via browser: `http://localhost/personal_cahya_apriyana_d1a240400/`

---

## 👤 Akun Default

| Role   | Username | Password |
| ------ | -------- | -------- |
| Admin  | admin    | admin    |
| Editor | cahya    | 123      |
| Viewer | Ohim     | Ohim     |

---

## 🖼️ Contoh Gambar Galeri

- `Artificial-Intelligence.jpg`
- `Batik-Kawung-1.jpeg`
- `Mi_ayam_jamur.JPG`
- `pemain-persib-bandung.jpeg`

---

## 🖥️ User Interface Halaman Publik

Berikut adalah tampilan utama halaman publik website:

| Halaman            | Deskripsi Singkat                                                | Contoh Tampilan                        |
| ------------------ | ---------------------------------------------------------------- | -------------------------------------- |
| **Beranda**        | Daftar artikel terbaru, fitur pencarian & filter kategori.       | ![Beranda](link-gambar-beranda)        |
| **Detail Artikel** | Menampilkan isi artikel, komentar bertingkat, dan form komentar. | ![Detail Artikel](link-gambar-artikel) |
| **Galeri**         | Koleksi gambar dengan modal preview.                             | ![Galeri](link-gambar-galeri)          |
| **About**          | Profil singkat pemilik website.                                  | ![About](link-gambar-about)            |
| **Kontak**         | Formulir kirim pesan ke admin.                                   | ![Kontak](link-gambar-kontak)          |

> **Catatan:** Silakan upload screenshot tampilan ke GitHub (misal di folder `/images/`), lalu ganti `link-gambar-...` dengan URL gambar yang sesuai.

---
