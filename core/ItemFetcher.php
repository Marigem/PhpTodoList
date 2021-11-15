<?php

namespace app\core;

use PDO;

class ItemFetcher
{
    public function fetchUserTodoLists()
    {
        $result = [];

        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'SELECT * FROM todo_list WHERE user_id = :userId;'
        );

        $statement->bindValue('userId', Application::$app->auth->user->id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}