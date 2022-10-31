<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Tentang API

API sederhana yang dibuat dengan Laravel ini merupakan API untuk aplikasi insiden report, API ini terintegrasi dengan mobile apps dengan react native pada link https://github.com/ilse31/Insiden-Report. Fitur dari API ini antara lain:

- Login, Register, Autentikasi dengan JWT.
- Lapor insiden, lihat history insiden.
- Upload gambar insiden pada cloudinary.
- Verifikasi status insiden terselesaikan oleh admin.

## Endpoint API

Endpoint jika dijalankan pada localserver akan menjadi http://127.0.0.1:8000/api/.. Endpoint yang digunakan dalam API ini, serta methodnya:
- /register         | POST        
- /login            | POST        
- /logout           | POST        
- /laporan          | GET     
- /laporan          | POST        
- /laporan          | PUT
- /laporan          | DELETE      
- /user             | GET         
- /alluser          | GET         
- /history          | GET         
- /upload           | POST        
- /updateuser/{id}  | PUT

## Catatan
Silahkan gunakan API ini, dan gunakan mobile appsnya pada https://github.com/ilse31/Insiden-Report
