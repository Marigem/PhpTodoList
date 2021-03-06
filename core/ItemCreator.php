<?php

namespace app\core;

use PDO;

class ItemCreator {
    public function createTodoList($title, $description, $due_date)
    {
        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'INSERT INTO todo_list (user_id, title, description, due_date) 
            VALUES (:user_id, :title, :description, :dueDate);'
        );

        $statement->bindValue('user_id', Application::$app->auth->user->id);
        $statement->bindValue('title', $title);
        $statement->bindValue('description', $description);
        $statement->bindValue('dueDate', $due_date);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
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

    public function createWelcomeTodoList()
    {
        $this->createTodoList("Welcome list!", "A list to help you get started!", "2021-11-25");
        $list = Application::$app->fetcher->fetchUserTodoLists()[0] ?? -1;
        $this->createTask($list['id'], "Create a new list");
        $this->createTask($list['id'], "Fill the list with tasks");
        $this->createTask($list['id'], "Share the list");
        $this->createTask($list['id'], "Share a task publicly!");
    }
}