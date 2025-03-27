## Description
This project is meant to be a page to retreive data for doctor performance.

## Usage
After cloning the project run
```bash
composer install
```
to manage the dependeciens and then
```bash
php migrate.php
```
This will create a simple sqlite database.

Then run
```bash
php -S 0.0.0.0:8000
```
to start the project. This will make this available at localhost:8000 page.