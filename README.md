# Curiositiz 
This git is used to  **Curiositiz** plateform.

## Stack
- MariaDB 10.2.x
- PHP 7.2.x
- Laravel Framework 5.5.x ([MIT license](https://opensource.org/licenses/MIT)).
---
<br/>

## Required
- [PHP 7.2.x](https://www.php.net/) or more
- PHP extensions: Curl, Ctype, iconv, JSON, PCRE, Session, SimpleXML, Tokenizer
- Web Server (Nginx or Apache)
- [Composer](https://getcomposer.org/)
- [NPM (Node.js)](https://nodejs.org/en/)
---
<br/>

## Install
- `composer install`
- `npm install`
- `npm run production` 
- `npm cache clear --force`
- Copy and customize the **.env.example** file to **.env**
- `php artisan key:generate`
- `php artisan config:cache`
- `php artisan migrate`
- `php artisan serve`
---
<br/>

## Info
---

#### SSH
- `ssh curiositiz-dev@51.255.163.211` (staging) or `ssh curiositiz-prod@51.255.163.211` (prod)

#### FTP
- Host: `vps498403.ovh.net`
- User: `curiositiz-dev` (staging) or `curiositiz-prod` (prod)


#### phpMyAdmin
- https://pma.curiositiz.com/

#### Compiling Assets
- Doc: [Laravel Mix](https://laravel.com/docs/7.x/mix)
- `npm run production` (Compile Assets for production)
- `npm run watch` (Watching Assets for changes)

---
<br/>

## Members
#### Management
* Guillaume Douceron (Development & Design)
* Laetitia Sarrazin (Marketing & Content)

#### Development
* Ali Bouaida (Back-end)
* Charles Damasse (Back-end)
* Olivier Chemla (Front-end)

#### Design
* Valentin Ferragati
* Kévin Da Costa

#### Marketing & Content
* Thomas De Oliveria
* Etienne Du Portal

---
<br/>
