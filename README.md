<h1 >Rest API Laravel</h1>
<br /> Description project:
This program built for orenda employer test.<br />
How running this program:<br />

1.  clone from github by following this syntax
    git clone https://github.com/khoidir97/orenda-test or download ZIP
2.  import database "orendaTest/public.sql" into your pgsql 
3.  running program: php artisan serve

# Database and Redis 
 
## 1. Setting Up 
 
Init Container 
 
docker-compose up -d 
 
 
Destroy Container 
 
docker-compose down 
 
 
Stop Container 
 
docker-compose stop 
 
 
Start Container 
 
docker-compose start -d 
 
 
<br/>

# Migarate Database
php artisan migrate

Endpoints:
- Description API:
* create users
  <br />endpoint: POST http://127.0.0.1:8000/api/users/register
  <br />payload:<br />
  id: integer;
  email: string;

* put items to koli
  <br />endpoint: POST http://127.0.0.1:8000/api/koli/putin
  <br />payload:<br />
  kli_id: number;<br />
  kli_email: string;<br />
  kli_nama_koli: string;<br />
  itm_id: number;<br />
  itm_koli_id: number;<br />
  itm_nama: number;<br />
  itm_qty: number;<br />

* remove items from user and koli
  <br />endpoint: POST http://127.0.0.1:8000/api/koli/takeout
  <br />payload:<br />
  kli_id: number;<br />
  kli_email: string;<br />
  kli_nama_koli: string;<br />
  itm_id: number;<br />
  itm_koli_id: number;<br />
  itm_nama: number;<br />
  itm_qty: number;<br />

* list common by date
  <br />endpoint: GET http://127.0.0.1:8000/api/koli/common
  <br />payload:<br />
  kli_nama_koli: string;<br />
  itm_koli_id: number;<br />
  itm_nama: number;<br />
  itm_qty: number;<br />


---

Thank you!<br />
<h1>Khoidir Khonofi</h1>