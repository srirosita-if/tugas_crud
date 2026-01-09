<think>
Pertama, pengguna mengatakan "ini untuk tugas kuliah", yang berarti "this is for college assignment". Ini menunjukkan bahwa proyek ini adalah tugas kuliah, jadi saya perlu memastikan respons saya sesuai dengan itu.

</think># CRUD Mata Kuliah dengan Login - Tugas Kuliah
Nama : Sri Rosita
NIM : 2341042

## Pendahuluan
Proyek ini adalah aplikasi web sederhana untuk tugas kuliah, mengimplementasikan sistem CRUD (Create, Read, Update, Delete) pada data mata kuliah dengan fitur login. Dibangun menggunakan PHP untuk backend dan MySQL untuk database, sesuai dengan persyaratan tugas.

## Persyaratan Sistem
- **Software**: XAMPP atau WAMP (untuk server lokal).
- **Bahasa**: PHP 7.0+, MySQL.
- **Hardware**: Komputer dengan browser web.

## Instalasi dan Setup
1. **Install XAMPP**: Download dari apachefriends.org dan jalankan Apache + MySQL.
2. **Buat Folder Proyek**: `crud_app` di `htdocs`.
3. **Setup Database**: Buat database `crud_matakuliah` di phpMyAdmin, lalu jalankan query SQL untuk tabel `users` dan `matakuliah` (lihat kode sebelumnya).
4. **Salin File**: `config.php`, `login.php`, `dashboard.php`, `logout.php`.

## Cara Menjalankan
1. Akses `http://localhost/crud_app/login.php` di browser.
2. Login dengan username `admin` dan password `123`.
3. Kelola mata kuliah di dashboard.

## Fitur Utama
- **Login**: Autentikasi pengguna dengan session.
- **CRUD Mata Kuliah**: Tambah, lihat, edit, hapus data dari tabel MySQL.
- **Logout**: Keluar aplikasi.

## Teknologi Digunakan
- **Frontend**: HTML (form sederhana).
- **Backend**: PHP (session, prepared statements).
- **Database**: MySQL (tabel relasional).

