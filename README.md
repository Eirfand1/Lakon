# LAKON
## Berkas Desain
Jika Anda membutuhkan berkas desain, Anda dapat mengunduhnya dari Figma Community 👉 https://bit.ly/3sigqHe

## Langkah-Langkah Menjalankan

1. Clone Repositori
```bash
git clone https://github.com/Eirfand1/Lakon
cd Lakon/src
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
php artisan db:seed
```
### seed awal
| Role | Email       | Password |
|-----|------------|------|
| Admin | admin@gmail.com | 123456789  |
| Penyedia | penyedia@gmail.com | 123456789 |
| Verifikator | verifikator@gmail.com | 123456789 |
- *gunakan ini untuk login pada tombol masuk pojok kanan atas*

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

## Menjalankan docker
- Pastikan .env sesuai dengan yang ada di docker-compose, bisa diliat di env.example sudah sesuai
- Pastikan berada di root direktori projek

1. docker-compose up -d --build app
2. docker-compose run --rm composer install 
3. docker-compose run --rm artisan key:generate 
4. docker-compose run --rm artisan migrate --seed
5. docker-compose run --rm npm install 
6. docker-compose run --rm npm run build
7. docker-compose run --rm npm run dev (dev mode, HANYA jalankan jika berada di dev mode gk usah gpp)
8. Buka halaman ```localhost``` di browser, app di mapping ke port 80 atau http

