# LAKON
## Berkas Desain
Jika Anda membutuhkan berkas desain, Anda dapat mengunduhnya dari Figma Community 👉 https://bit.ly/3sigqHe

## Langkah-Langkah Menjalankan

1. Clone Repositori
```bash
git clone https://github.com/Eirfand1/Lakon
cd Lakon 
```

2. Instal Dependensi Composer
```bash
composer install
```

3. Konfigurasi .env
```bash
cp .env.example .env
php artisan key:generate
```

4. Atur Konfigurasi Basis Data
- Buka `.env`
- Sesuaikan `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

5. Migrasi Basis Data
```bash
php artisan migrate
php artisn db:seed
```
### seed awal
email = admin@gmail.com <br/>
password = 12345678<br/>
*gunakan ini untuk login pada tombol masuk pojok kanan atas*

6. Instal Dependensi NPM
```bash
npm install
npm run dev
```

7. Jalankan Aplikasi
```bash
php artisan serve
```

### Akses Aplikasi
Buka browser di `http://localhost:8000`