# Kost Kurnia - Sistem Manajemen Kos

Aplikasi web untuk manajemen kos dengan fitur pemesanan kamar, pembayaran online, dan manajemen akun pengguna.

## Persyaratan Sistem
- PHP 7.4 atau lebih baru
- MySQL 5.7 atau lebih baru
- XAMPP/WAMP/LAMP
- Composer (untuk manajemen dependensi)
- Akun Xendit (untuk pembayaran online)

## Panduan Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/ozssa/UAS-PWEB.git
cd kost-kurnia
```

### 2. Konfigurasi Database
1. Buat database baru di PHPMyAdmin:
   ```sql
   CREATE DATABASE kost_kurnia;
   ```
2. Import file database:
   ```bash
   mysql -u root -p kost_kurnia < database.sql
   ```

### 3. Konfigurasi Aplikasi
Buka file `config/database.php` dan sesuaikan kredensial database:
```php
private $host = 'localhost';
private $db_name = 'kost_kurnia';
private $username = 'root';
private $password = ''; // Sesuaikan dengan password MySQL Anda
```

### 4. Konfigurasi Xendit (Pembayaran Online)
1. Daftar akun di [Xendit](https://dashboard.xendit.co/register)
2. Dapatkan API Key (mode development)
3. Tambahkan API Key di `config/database.php`:
   ```php
   public $xendit_api_key = 'API_KEY_ANDA';
   ```

### 5. Konfigurasi Folder Uploads
Pastikan folder `uploads` memiliki izin tulis:
```bash
chmod -R 755 uploads/
```

### 6. Jalankan Aplikasi
1. Jalankan Apache dan MySQL di XAMPP
2. Buka browser dan akses:
   ```
   http://localhost/kost-kurnia/
   ```

## Struktur Direktori
```
├── assets/          # File CSS, JS, dan gambar
├── config/          # Konfigurasi database dan session
├── controllers/     # Logika aplikasi
├── models/          # Struktur data dan database
├── uploads/         # File yang diunggah pengguna
├── utils/           # Utilitas (perlindungan CSRF)
├── views/           # Tampilan halaman
├── .htaccess        # Konfigurasi URL rewriting
├── database.sql     # Struktur database
├── index.php        # Entry point aplikasi
└── README.md        # Dokumentasi
```

## Fitur Aplikasi
### 1. Manajemen Kamar
- Pencarian kamar
- Detail kamar dengan fasilitas
- Gambar kamar

### 2. Sistem Booking
- Pemesanan kamar online
- Kalender ketersediaan
- Manajemen status pemesanan

### 3. Pembayaran Online
- Integrasi Xendit
- Pembayaran via virtual account/QR
- Callback status pembayaran

### 4. Manajemen Pengguna
- Registrasi akun
- Login/Logout
- Edit profil
- Unggah foto profil
- Lupa password

### 5. Dashboard Pengguna
- Riwayat pemesanan
- Status pembayaran
- Manajemen booking

## Akun Demo
**Pemilik Kos:**
- Username: admin
- Password: password123

**Penghuni:**
- Username: user1
- Password: password123

## Teknologi Digunakan
- PHP Native (MVC Pattern)
- MySQL Database
- Xendit Payment Gateway
- Bootstrap 5 (Frontend)
- Font Awesome (Icons)
- Vanilla JavaScript

## Troubleshooting
1. **Mod Rewrite Tidak Berfungsi**
   - Aktifkan mod_rewrite di Apache
   - Pastikan `AllowOverride` diatur ke `All` di `httpd.conf`

2. **Gagal Koneksi Database**
   - Periksa kredensial di `config/database.php`
   - Pastikan MySQL berjalan

3. **Gagal Upload Gambar**
   - Pastikan folder `uploads` memiliki izin tulis
   - Periksa konfigurasi `upload_max_filesize` di `php.ini`

4. **Pembayaran Xendit Gagal**
   - Periksa API Key di `config/database.php`
   - Pastikan menggunakan mode development untuk testing

## Kontribusi
Pull request dipersilakan. Untuk perubahan besar, buka issue terlebih dahulu untuk diskusi.

## Lisensi
Proyek ini dilisensikan di bawah [MIT License](LICENSE).