# 🖼️ Galeri Foto 2026

Platform Manajemen Galeri Foto Digital yang dirancang dengan antarmuka elegan bertema *Deep Purple* untuk pengalaman visual yang mewah dan modern.

## 🚀 Fitur Unggulan

Aplikasi ini tidak hanya memenuhi standar dasar, tetapi dilengkapi dengan fitur lanjutan:
- **🛡️ Role-Based Access Control (RBAC):** Pemisahan hak akses mutlak antara **Admin** (Pengelola Galeri) dan **User** (Pengunjung/Anggota).
- **💬 Smart Threaded Comments:** Sistem komentar interaktif di mana Admin dapat memberikan balasan langsung (*Reply*) pada foto yang dilengkapi dengan *Badge* resmi (👑 Admin).
- **❤️ Engagement System:** Dilengkapi fitur *Like* (Suka) *real-time* untuk mengukur popularitas setiap karya foto.
- **🖼️ Advanced Media Handling:** Mendukung format gambar modern (WebP, JPG, PNG) dengan sistem penyimpanan *Direct Public Path* yang dijamin 100% bebas dari *error storage:link* pada OS Windows.

---

## 🏛️ Arsitektur & Database

Sistem ini dibangun dengan mematuhi struktur *Entity Relationship Diagram* (ERD) standar industri yang telah dinormalisasi untuk menjaga integritas relasi data.

**📊 Data Dictionary**

| Nama Tabel | Primary Key | Foreign Key | Fungsi Utama |
| :--- | :--- | :--- | :--- |
| `gallery_user` | `UserID` | - | Mengelola Autentikasi & Hak Akses (`Role`) |
| `gallery_album` | `AlbumID` | `UserID` | Mengelola Data Album / Kategori Foto |
| `gallery_foto` | `FotoID` | `AlbumID`, `UserID` | Mengelola Data Karya Foto & File Gambar |
| `gallery_komentarfoto`| `KomentarID`| `FotoID`, `UserID` | Merekam Interaksi Komentar Pengguna pada Foto |
| `gallery_likefoto` | `LikeID` | `FotoID`, `UserID` | Merekam Data Favorit / Suka pada Foto |

---

## 📸 Dokumentasi Visual (Output)

*(Catatan: Letakkan screenshot aplikasimu di dalam folder `screens` lalu sesuaikan nama filenya)*

### 🔐 Autentikasi (Register & Login)
Antarmuka pendaftaran dan masuk yang bersih, aman, dan simpel.

Login

<img width="397" height="367" alt="image" src="https://github.com/user-attachments/assets/2c10c36e-3540-42fd-acf6-33a3bb021766" />

Register

<img width="270" height="359" alt="image" src="https://github.com/user-attachments/assets/3bb8574c-274e-4ed7-a538-d1fa0ca63247" />


### 🖼️ Beranda Galeri (User & Admin)
Grid galeri yang responsif menampilkan foto-foto terbaru, jumlah *Like*, dan *Komentar*.

<img width="947" height="403" alt="image" src="https://github.com/user-attachments/assets/db9b9ae2-a87c-4a6a-86c5-97cbe5d87765" />


### 💬 Detail Foto & Interaksi (Komentar Admin)
Tampilan foto ukuran besar beserta fitur diskusi interaktif (*Threaded Reply*) antara User dan Admin.

![Uploading image.png…]()


### 🛠️ Panel Manajemen C.R.U.D (Admin Only)
Kontrol penuh bagi administrator untuk menambah, mengedit, dan menghapus foto dari galeri.

<img width="945" height="409" alt="image" src="https://github.com/user-attachments/assets/afba095a-9430-4e61-b86f-b84509a1d831" />


---

## ⚙️ Instalasi Cepat (Quick Start)

Hanya butuh 4 langkah mudah untuk menjalankan aplikasi ini di lingkungan lokal Anda (XAMPP/Laragon):

**1. Clone Repositori**

git clone https://github.com/wahyuprogram/gallery.git
cd gallery

2. Persiapan Environment & Database

Buat database kosong di MySQL (phpMyAdmin) dengan nama: db_gallery

Jalankan perintah instalasi dependensi:

Bash
composer install
cp .env.example .env
php artisan key:generate
3. Migrasi Struktur Tabel

Bash
php artisan migrate
(Catatan: Aplikasi ini menggunakan metode direct public upload, sehingga tidak memerlukan perintah storage:link dan dijamin bebas error di sistem Windows).

4. Jalankan Aplikasi

Bash
php artisan serve
Akses aplikasi melalui browser di: http://127.0.0.1:8000
