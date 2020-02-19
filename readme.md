# Khabeer Partners Project


To install this project do the following steps:

## Server Environment:

Setting Commands:

Update apt-get
```bash
apt-get update && apt-get upgrade
```
install PHP
```bash
apt-get install php7.2
```
install apache
```bash
sudo apt install apache2
```
```bash
systemctl start apache2
```
install [composer](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-18-04)

install node js
```bash
sudo apt install nodejs
```
```bash
sudo apt install npm
```
## Application Installition:

Setting Commands:
-
- git clone https://github.com/khabeer-partenar/KhabeerPartnersProject.git
- cp .env.example .env
- composer install
- php artisan key:gen
- set credentials in .env file for
    (app_url , mysql, mail, mobily, help desk email)
- php artisan passport:install
- php artisan migrate
- php artisan db:seed
- php artisan storage:link
- npm install
- npm run prod
 
Cron Jobs:
-
- 59 23 * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
- Queue Command (Always will be running) : php artisan queue:work
 