# Setup
cd project directory
composer update

setup connection variables in core/Connection.php

Setup the database with
php migrations.php

Serve with
php -S localhost:8000 -t ./public
