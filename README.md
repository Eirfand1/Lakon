# LAKON
## Berkas Desain
Jika Anda membutuhkan berkas desain, Anda dapat mengunduhnya dari Figma Community 👉 https://bit.ly/3sigqHe

## Penggunaan
Proyek ini dibangun dengan [Laravel Jetstream](https://jetstream.laravel.com/) dan [Livewire + Blade](https://jetstream.laravel.com/2.x/introduction.html#livewire-blade) sebagai Stack.

### Menyiapkan Berkas Konfigurasi .env
Pastikan untuk menambahkan konfigurasi basis data di berkas .env Anda seperti nama basis data, nama pengguna, kata sandi, dan port.


## Tutorial Lengkap Konfigurasi .env di Laravel

### 1. Temukan Berkas .env
- Berkas `.env` biasanya terletak di direktori root proyek Laravel
- Jika tidak ada, salin `.env.example` menjadi `.env`

### 2. Konfigurasi Basis Data

```env
# Jenis basis data yang digunakan
DB_CONNECTION=mysql

# Nama host basis data (biasanya localhost)
DB_HOST=127.0.0.1

# Port basis data (default MySQL adalah 3306)
DB_PORT=3306

# Nama basis data yang akan digunakan
DB_DATABASE=nama_basis_data_anda

# Nama pengguna basis data
DB_USERNAME=nama_pengguna_anda

# Kata sandi basis data
DB_PASSWORD=kata_sandi_anda
```

### 3. Konfigurasi Tambahan yang Umum
```env
# Kunci aplikasi (digunakan untuk enkripsi)
APP_KEY=

# Mode aplikasi (local/production)
APP_ENV=local

# Aktifkan/nonaktifkan debug
APP_DEBUG=true

# URL aplikasi
APP_URL=http://localhost

# Konfigurasi email (opsional)
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

### Tips Penting
- Jangan commit berkas `.env` ke repositori versi kontrol
- Gunakan `.gitignore` untuk mengabaikan berkas `.env`
- Selalu buat `.env.example` dengan contoh konfigurasi tanpa nilai sensitif
- Gunakan `php artisan key:generate` untuk membuat kunci aplikasi

### Troubleshooting
- Pastikan basis data sudah dibuat sebelum mengonfigurasi
- Periksa kembali kredensial basis data
- Gunakan `php artisan config:clear` jika mengalami masalah konfigurasi


### Instal Dependensi Laravel
Di root aplikasi Laravel, jalankan perintah ``php composer.phar install`` (atau ``composer install``) untuk menginstal semua dependensi kerangka kerja.

### Migrasi Tabel
Untuk melakukan migrasi tabel dan menyiapkan struktur dasar aplikasi, buka terminal, masuk ke direktori proyek, lalu jalankan perintah:
``php artisan migrate``

### Hasilkan Data Uji
Setelah menyiapkan tabel basis data, Anda dapat menghasilkan data uji dari pembuat data (seeders) yang sudah dibuat. Jalankan perintah:
``php artisan db:seed``

Catatan: Jika Anda menjalankan perintah ini dua kali, data uji akan diduplikasi. Untuk menghindari duplikasi, pastikan untuk melakukan ``truncate`` pada tabel ``datafeeds`` di basis data Anda.

### Kompilasi Front-end
Untuk mengompilasi aset CSS dan JS, instal dependensi NPM dengan mengetik ``npm install``.

Kemudian jalankan:
- ``npm run dev`` untuk server pengembangan
- ``npm run build`` untuk kompilasi produksi

### Jalankan Backend Laravel
Jalankan perintah:
``php artisan serve``

Anda akan menerima pesan seperti ``Starting Laravel development server: http://127.0.0.1:8000``. Salin URL ini di browser Anda untuk memulai.