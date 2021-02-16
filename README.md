# LaraMail-back-end

## Back-end API with PHP and MariaDB. 

#### This is a mailing system's back-end. Made with Laravel. Provides the data and authentication for the LaraMail front-end.
Authentication made with Laravel Sanctum.

## Requirements:

#### PHP (7.4 recommended) with Laravel 8, Composer, and Apache webserver (recommended)
#### See env.example file for details, and create your own .env file!

## Run:

#### Setup an Apache virtualhost (.env file!). .htaccess file already present in project folder.
#### Setup database (.env file!)
#### Create migrations with
```bash
    php artisan migrate
```
#### Use the following command from the project directory:
```bash
    composer install
```
#### You can start the application, according to the chosen setup configuration.
#### Recommendation: configure your IDE to copy the project files to the defined Apache virtualhost's folder, on run.
