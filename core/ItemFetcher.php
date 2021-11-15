<?php

namespace app\core;

use app\core\model\User;
use PDO;

class ItemFetcher
{
    public function fetchUserTodoLists()
    {
        $result = [];

        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'SELECT * FROM todo_list WHERE user_id = :userId ORDER BY id DESC;'
        );

        $statement->bindValue('userId', Application::$app->auth->user->id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetchListById($id) 
    {
        $result = [];

        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'SELECT * FROM todo_list WHERE id = :id;'
        );

        $statement->bindValue('id', $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetchTasksByListId($listId)
    {
        $result = [];

        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'SELECT * FROM task WHERE list_id = :listId ORDER BY id ASC;'
        );

        $statement->bindValue('listId', $listId);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetchPublicLists()
    {
        $result = [];

        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'SELECT todo_list.id, todo_list.user_id, todo_list.title, todo_list.description FROM todo_list 
            INNER JOIN public_shares ON todo_list.id = public_shares.list_id ORDER BY id DESC;'
        );

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetchPublicTasks()
    {
        $result = [];

        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'SELECT * FROM task ORDER BY id ASC;'
        );

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetchUserNameByListId($id)
    {
        $result = [];

        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'SELECT name FROM users INNER JOIN todo_list ON users.id = todo_list.user_id WHERE todo_list.id = :list_id;'
        );

        $statement->bindValue('list_id', $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['name'];
    }

    public function fetchAllUsers()
    {
        $result = [];

        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'SELECT * FROM users ORDER BY name ASC;'
        );

        $statement->execute();
        $arr = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $userArray)
        {
            $user = new User($userArray['id'], $userArray['name'], $userArray['email']);
            array_push($result, $user);
        }
        return $result;
    }

    public function listsSharedWithMe()
    {
        $result = [];

        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'SELECT * FROM todo_list INNER JOIN private_shares ON todo_list.id = private_shares.list_id
            WHERE private_shares.user_id = :userId ORDER BY todo_list.id DESC;'
        );

        $statement->bindValue('userId', Application::$app->auth->user->id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}