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
php artisan db:seed
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

1. docker-compose up -d --build app.
2. docker-compose run --rm composer install 
3. docker-compose run --rm npm run dev
4. docker-compose run --rm artisan migrate
5. docker-compose run --rm artisan db:seed 
