<?php

namespace app\core;

use \PDO;

class Connection
{
    public PDO $pdo;

    function __construct()
    {
        $dsn = "mysql:host=192.168.0.32:3306;dbname=tododb";
        $this->pdo = new PDO($dsn, 'dbuser', 'password');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}