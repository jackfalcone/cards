# Cards

## Local Setup
The src/.env file is included in Git as it does not yet contain any security-relevant information. Of course, the file must be excluded at go-live and will be different locally and in production.

#### Setup docker compose and install dependencies
- ```docker compose up -d```
- ```docker compose run composer install```
- ```docker compose run npm i```
- ```docker compose run npm build```

#### Database migration and symbolic link for local file storage
- ```docker compose run artisan migrate```
- ```docker compose run artisan storage:link```

#### Run PHP webserver, Node development server and the queue worker
- ```docker compose run artisan serve```
- ```docker compose run artisan queue:work```
- ```docker compose run npm dev```

http://localhost:8080

PhpMyAdmin: http://localhost:8891

## Useful links
- https://laravel.com/docs/11.x/
- https://vitejs.dev/guide/
- https://inertiajs.com/