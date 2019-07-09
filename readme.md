# Laravel Blog API

## Table of Contents

- [Features](#features)
- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Run](#run)
- [Test](#test)


## Features
- Laravel 5.8
- RESTful API
- MySQL


## System Requirements
This application was created using Laravel 5.8.
It is essential to acomplish the follow requirements:
- PHP >= 7.1.3
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- MySQL

## Installation
1. Install Composer using detailed installation instructions [here](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
2. Install Node.js using detailed installation instructions [here](https://nodejs.org/en/download/package-manager/)
3. Clone repository
```
$ git clone https://github.com/eduardosantosjr/laravel-blog-api.git
```
4. Change into the working directory
```
$ cd laravel-blog-api
```
5. Copy `.env.example` to `.env` and modify according to your environment
```
$ cp .env.example .env
```
6. Install composer dependencies
```
$ composer install --prefer-dist
```
7. An application key can be generated with the command
```
$ php artisan key:generate
```
8. Execute following commands to install other dependencies
```
$ php artisan migrate
$ php artisan passport:install
$ php artisan config:clear
```

If you get an error like a `PDOException` try editing your `.env` file and change `DB_HOST=127.0.0.1` to `DB_HOST=localhost` or `DB_HOST=mysql`.

## Run

To start the PHP built-in server
```
$ php artisan serve --port=8080
or
$ php -S localhost:8080 -t public/
```

Now you can browse the site at [http://localhost:8080](http://localhost:8080)  🙌

## Test

If you want to test the applcation, before, you need to

1. Copy `.env.example` to `.env.testing` and modify according to your environment
```
$ cp .env.example .env.testing
```

2. Edit the `.env.testing` file, changing
```
APP_ENV=local > APP_ENV=testing
```

3. Run migrations
```
$ php artisan migrate --env=testing
```