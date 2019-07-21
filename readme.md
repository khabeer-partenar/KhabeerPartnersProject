# Khabeer Partners Project


To install this project do the following steps:

- cp .env.example .env
- composer install
- php artisan key:gen
- php artisan migrate
- php artisan passport:install
- php artisan db:seed
- php artisan module:seed Core
- php artisan module:seed Users