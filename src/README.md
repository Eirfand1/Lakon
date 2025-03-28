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
- email = admin@gmail.com <br/>
- password = JunAedi99Gacor<br/>
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

1. hapus .env
2. rename/copy .env.docker.example menjadi .env

3. ikuti langkah dibawah 
```bash

# jalankakan docker composer
./vendor/bin/sail up

# jalankan migrate 
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed 
 
```

4. Open localhost