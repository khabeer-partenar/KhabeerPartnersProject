# Khabeer Partners Project


To install this project do the following steps:

Setting Commands:
-
- git clone https://github.com/khabeer-partenar/KhabeerPartnersProject.git
- cp .env.example .env
- composer install
- php artisan key:gen
- set values in .env file
    (app_url, mysql, mail, mobily, help desk email)
- php artisan passport:install
- php artisan migrate
- php artisan db:seed
- php artisan storage:link
- npm install
- npm run prod
 
Cron Jobs:
- Queue Command (Always will be running) : php artisan queue:work
 