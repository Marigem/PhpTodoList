<?php

namespace app\core;

class Authenticator 
{
    public static function registerUser($user)
    {
        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            "INSERT INTO users (name, email, password) 
            VALUES(:name, :email, :password);"
        );

        $statement->bindValue('name', $user['name']);
        $statement->bindValue('email', $user['email']);
        $hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);
        $statement->bindValue('password', $hashedPassword);
        $statement->execute();

        return $statement->rowCount() == 1;
    }

    public static function emailAlreadyExists($email)
    {
        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'SELECT * FROM users WHERE email = :email'
        );

        $statement->bindValue('email', $email);
        $statement->execute();

        return $statement->rowCount() != 0;
    }
}