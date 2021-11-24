# Setup
<code>
cd projectDirectory
  
composer update</code>

### Setup connection variables in core/Connection.php
<code>
$dsn = "mysql:host=hostname:port;dbname=databaseName";
  
$this->pdo = new PDO($dsn, 'user', 'password');
</code>

### Setup the database with:

<code>php migrations.php</code> - If connection is setup properly this will not provide any output

### Serve with:

<code>php -S localhost:8000 -t ./public</code>

### Open

http://localhost:8000
