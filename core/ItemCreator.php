<?php

namespace app\core;


class ItemCreator {
    public function createTodoList($title, $description)
    {
        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'INSERT INTO todo_list (user_id, title, description) 
            VALUES (:user_id, :title, :description);'
        );

        $statement->bindValue('user_id', Application::$app->auth->user->id);
        $statement->bindValue('title', $title);
        $statement->bindValue('description', $description);
        $statement->execute();
    }

    public function deleteTodoList($id)
    {
        if (Application::$app->auth->userOwnsListItem($id))
        {
            $connection = new Connection();
            $statement = $connection->pdo->prepare(
                'DELETE FROM todo_list WHERE id = :id'
            );
    
            $statement->bindValue('id', $id);
            $statement->execute();
        }
    }

    public function createTask($listId, $description)
    {
        if (Application::$app->auth->userOwnsListItem($listId))
        {

            $connection = new Connection();
            $statement = $connection->pdo->prepare(
                'INSERT INTO task (list_id, description) 
                VALUES(:listId, :description);'
            );
    
            $statement->bindValue('listId', $listId);
            $statement->bindValue('description', $description);
            $statement->execute();
        }
    }

    public function deleteTask($listId, $taskId)
    {
  
        if (Application::$app->auth->userOwnsListItem($listId))
        {
            $connection = new Connection();
            $statement = $connection->pdo->prepare(
                'DELETE FROM task WHERE id = :id'
            );
    
            $statement->bindValue('id', $taskId);
            $statement->execute();
        }
    }
}