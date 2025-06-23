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

## 🖥️ User Interface Halaman Publik

**Beranda**  
Halaman Home atau Halaman Artikel adalah halaman yang menampilkan daftar artikel dan artikel terbaru.
![Beranda](link-gambar-beranda)

**Detail Artikel**  
Halaman yang menampilkan isi lengkap artikel, komentar bertingkat, dan form untuk menambah komentar.
![Detail Artikel](link-gambar-artikel)

**Galeri**  
Halaman yang menampilkan koleksi gambar/foto dengan fitur modal preview saat gambar diklik.
![Galeri](link-gambar-galeri)

**About**  
Halaman yang berisi profil singkat atau biodata pemilik website.
![About](link-gambar-about)

**Kontak**  
Halaman yang menyediakan formulir untuk pengunjung mengirim pesan ke admin.
![Kontak](link-gambar-kontak)

> Ganti `link-gambar-...` dengan path gambar yang sudah kamu upload, misal: `./images/beranda.png`

---

## 🖥️ User Interface Halaman Admin

Berikut adalah tampilan utama halaman admin untuk mengelola website:

**Dashboard Admin**  
Halaman utama admin yang menampilkan ringkasan statistik pengunjung, jumlah artikel, galeri, user, dan pesan masuk.  
![Dashboard Admin](link-gambar-dashboard-admin)

**Kelola Artikel**  
Halaman untuk melihat daftar artikel, menambah, mengedit, dan menghapus artikel.  
![Kelola Artikel](link-gambar-kelola-artikel)

- **Edit Artikel**  
  Halaman form untuk mengedit judul, isi, kategori, dan gambar artikel.  
  ![Edit Artikel](link-gambar-edit-artikel)

**Kelola Galeri**  
Halaman untuk mengelola koleksi gambar/foto di galeri.  
![Kelola Galeri](link-gambar-kelola-galeri)

- **Edit Galeri**  
  Halaman form untuk mengedit judul dan gambar galeri.  
  ![Edit Galeri](link-gambar-edit-galeri)

**Kelola About**  
Halaman untuk mengedit profil/about pemilik website.  
![Kelola About](link-gambar-kelola-about)

- **Edit About**  
  Halaman form untuk mengedit informasi profil/about.  
  ![Edit About](link-gambar-edit-about)

**Kelola User & Role**  
Halaman untuk mengelola data user, role (Admin, Editor, Viewer), dan hak akses.  
![Kelola User](link-gambar-kelola-user)

- **Edit User/Role**  
  Halaman form untuk mengedit data user dan peran/role-nya.  
  ![Edit User](link-gambar-edit-user)

**Kelola Pesan Kontak**  
Halaman untuk melihat, membaca, dan menghapus pesan yang masuk dari form kontak.  
![Kelola Pesan](link-gambar-kelola-pesan)
