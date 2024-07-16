# Cards

## Local Setup
The src/.env file is included in Git as it does not yet contain any security-relevant information. Of course, the file must be excluded at go-live and will be different locally and in production.
- ```docker compose up -d```
- ```docker compose run composer install```
- ```docker compose run artisan migrate```
- ```docker compose run artisan serve```
- ```docker compose run artisan queue:work```
- ```php artisan storage:link```
- ```docker compose run npm i```
- ```docker compose run npm build```
- ```docker compose run npm dev```

http://localhost:8080

PhpMyAdmin: http://localhost:8891

### todo: 
- docker-compose.yaml version obsolete