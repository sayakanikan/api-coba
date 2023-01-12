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

## Catatan
Silahkan gunakan API ini, dan gunakan mobile appsnya pada https://github.com/ilse31/Insiden-Report, serta gunakan admin-side nya pada https://github.com/sayakanikan/admin-insiden-report
