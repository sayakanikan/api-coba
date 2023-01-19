<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Tentang API
Insident Report merupakan aplikasi cross-platform yang digunakan untuk menlaporkan kerusakan di suatu tempat. User dapat melapor, dan admin dapat menanggapi laporan tersebut.
API sederhana yang dibuat dengan Laravel ini merupakan API untuk aplikasi insiden report. Fitur dari API ini antara lain:

- Login, Register, Autentikasi dengan JWT.
- Lapor insiden, lihat history insiden.
- Upload gambar insiden pada cloudinary.
- Verifikasi status insiden terselesaikan oleh admin.

## Endpoint API

Endpoint jika dijalankan pada localserver akan menjadi http://127.0.0.1:8000/api/.. Endpoint yang digunakan dalam API ini, serta methodnya:
- /register         | POST        
- /login            | POST        
- /refresh          | POST  
- /user             | POST
- /updateuser/{id}  | PUT
- /deleteuser/{id}  | DELETE
- /getuser          | GET
- /detailuser/{id}  | GET
- /getadmin         | GET
- /detailadmin/{id} | GET
- /laporan          | GET
- /laporan/{id}     | GET
- /laporan          | POST        
- /laporan          | PUT     
- /history          | GET         
- /upload           | POST        

## Cara Penggunaan
1. Clone repositori ini di komputer local anda, cara untuk clone repositori ada pada tutorial berikut: https://medium.com/@sarascahya/cara-clone-sebuah-repository-di-github-aa633c3260aa
2. Masuk ke folder tempat aplikasi berada dengan menggunakan `cd` pada terminal
3. Rename file `.env.example` menjadi `.env`, dan set database di `.env` sesuai database yang anda miliki.
4. Tambahkan beberapa key dan value di file`.env`, sebagai berikut:
```
CLOUDINARY_API_KEY=(api_key_cloudinary_anda)
CLOUDINARY_API_SECRET=(api_secret_cloudinary_anda)
CLOUDINARY_URL=(url_cloudinary_anda)
CLOUDINARY_UPLOAD_PRESET=(cloudinary_upload_preset_anda)
JWT_SECRET=(jwt_secret_anda)
```
5. Jalankan `php artisan key:generate` di terminal
6. Jalankan `php artisan migrate` di terminal
7. Jalankan API dengan `php artisan serve`

## Catatan
Silahkan gunakan API ini, dan gunakan mobile appsnya pada https://github.com/ilse31/Insiden-Report, serta gunakan admin-side nya pada https://github.com/sayakanikan/admin-insiden-report
