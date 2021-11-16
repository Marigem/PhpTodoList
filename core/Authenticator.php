<?php

namespace app\core;

use app\core\model\User;
use PDO;

class Authenticator 
{
    public ?User $user;

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

    public function isGuest()
    {
        return $this->user === null;
    }

    public function getUserById($id)
    {
        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'SELECT * FROM users WHERE id = :id'
        );

        $statement->bindValue('id', $id);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($statement->rowCount() === 1)
        {
            $user = new User($result['id'], $result['name'], $result['email']);
            return $user;
        }       
        return null;
    }

    public function login($email, $password): bool
    {
        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'SELECT * FROM users WHERE email = :email'
        );

        $statement->bindValue('email', $email);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($statement->rowCount() === 1 && password_verify($password, $result['password']))
        {
            $user = new User($result['id'], $result['name'], $result['email']);
            $this->user = $user;
            Application::$app->session->set(Session::KEYS_USER_ID, $this->user->id);
            return true;
        }       
        return false;
    }

    public function logout()
    {
        if (!$this->isGuest())
        {
            $this->user = null;
            Application::$app->session->unset(Session::KEYS_USER_ID);
            Application::$app->session->unset(Session::KEYS_JUST_LOGGED_IN);
        }
    }

    public function userOwnsListItem($id): bool
    {
        if (!$this->user)
            return false;
        
        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'SELECT * FROM todo_list WHERE id = :id'
        );

        $statement->bindValue('id', $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $result['user_id'] === $this->user->id;
    }
}