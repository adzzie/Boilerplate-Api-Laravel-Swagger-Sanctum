<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Boilerplate Laravel Swagger Sanctum

# About 

This Boilerplate using
- [Laravel 10](https://laravel.com/docs/10.x) for framework
- [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum) for authentication
- [Infyom](https://infyom.com/open-source/laravelgenerator/docs/10.0/installation) for generate business core and [Infyom Swagger](https://infyom.com/open-source/laravelgenerator/docs/generator-options) for generate swagger
- [Migrations Generator](https://github.com/kitloong/laravel-migrations-generator) for migration from database to file migrate laravel
- [Seed Generator](https://github.com/orangehill/iseed) for seed (migrasion data) from database to file seeder laravel

## Installation

Installation using terminal

Clone this project

```bash
git clone https://github.com/adzzie/Boilerplate-Api-Laravel-Swagger-Sanctum.git $FOLDER_NAME
```

Open your folder or directory

```bash
cd $FOLDER_NAME
```

Install this using composer:

```bash
composer install
```

Copy file env

```bash
cp .env.example .env
```

Generate key laravel

```bash
php artisan key:generate
```

## Laravel Setup

Setup your database in file .env

```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-sanctum
DB_USERNAME=root
DB_PASSWORD=
```
Change to your database

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

```bash
php artisan infyom:api $MODEL_NAME --fromTable --table=$TABLE_NAME
```

if generate not from existing database, please see doc in infyom website

### Generate Swagger

Generate endpoint in swagger 

```bash
php artisan l5-swagger:generate
```

### Generate Migration

Generate file migration from table existing in database

```bash
php artisan migrate:generate --tables="$TABLE_NAME1,$TABLE_NAME2,..."
```

### Generate Migration Data (Seed)
 
Generate data Seeder from table existing in database

```bash
php artisan iseed $TABLE_NAME1,$TABLE_NAME2,...
```



## Additional Information

### Uuid

if using UUID on every id, add code trait "HasUuids" in every model:

```php
 use HasUuids;
```

### CreatedBy and UpdatedBy

if using field created_by and updated_by in every table, add trait in model:

```php
 use CreatedUpdatedBy;
```

### DeletedBy

if using sofDeletes and using field deleted_by in every table, you add trait in model:

```php
 use SoftDeletesWithBy;
```

SoftDeletesWithBy extended from softDeleted.

### Security

if using Authentication in swagger add this code on every endpoint "security"

```php
*      ...
*      security={{"token":{}}},
*      ...
```
for example see endpoint in CompanyApiController
