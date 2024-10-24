Untuk mejalankannya 
docker exec -t <nama container> composer install
docker exec -t <nama container> php artisan migrate:fresh --seed 

dan untuk setting .env nya seperti ini 

DB_CONNECTION=mysql
DB_HOST=<nama container>
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=root
DB_PASSWORD=secret
DB_ROOT_PASSWORD=kukubima234
