<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Boilerplate Laravel Swagger Sanctum

# About 

This Boilerplate using
- [Laravel 10](https://laravel.com/docs/10.x) for framework
- [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum) for authentication
- [Infyom](https://infyom.com/open-source/laravelgenerator/docs/10.0/installation) for generate business core and [Infyom Swagger](https://infyom.com/open-source/laravelgenerator/docs/generator-options) for generate swagger
- [Migrations Generator](https://github.com/kitloong/laravel-migrations-generator) for migration from database to file migrate laravel

## Install

install this using composer:

```bash
composer install
```

follow this code in your terminal

```
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan vendor:publish --provider="InfyOm\Generator\InfyOmGeneratorServiceProvider"
php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
```

```
php artisan infyom:publish
```

## Laravel Setup

Setup your database in file .env

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-sanctum
DB_USERNAME=root
DB_PASSWORD=
```


## laravel Migration

Migration database existing in project

```bash
php artisan migrate
```

## Laravel Running 
 
Running with terminal

```bash
php artisan serve
```

## Generate

### Generate Using Infyom

Generate api from existing database 

```
php artisan infyom:api $MODEL_NAME --fromTable --table=$TABLE_NAME
```

if generate not from existing database, please see doc in infyom website

### Generate Swagger

Generate endpoint in swagger 

```
php artisan l5-swagger:generate
```

### Generate Migration

Generate file migration from table existing in database

```
php artisan migrate:generate --tables="$TABLE_NAME1,$TABLE_NAME2,..."
```

## Additional Information

### Uuid

if using UUID on every id, add code trait "HasUuids" in every model:

```
 use HasUuids;
```

### Security

if using Authentication in swagger add this code on every endpoint "security"

```
*      ...
*      security={{"token":{}}},
*      ...
```
for example see endpoint in CompanyApiController
