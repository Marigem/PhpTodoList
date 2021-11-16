<?php

namespace app\core;

class ShareUnshare
{
    public function shareListWithUser($listId, $userId)
    {
        if (Application::$app->auth->userOwnsListItem($listId))
        {
            $connection = new Connection();

            $statement = $connection->pdo->prepare(
                'INSERT INTO private_shares (list_id, user_id) 
                VALUES(:listId, :userId);'
            );
            if ($this->alreadySharedWith($listId, $userId))
            {
                $statement = $connection->pdo->prepare(
                    'DELETE FROM private_shares WHERE list_id = :listId AND user_id = :userId;'
                );
                $this->deleteNotification($userId);

            }
            else
            {
                $this->notify($userId);
            }
    
            $statement->bindValue('listId', $listId);
            $statement->bindValue('userId', $userId);
            $statement->execute();
        }
    }

    public function alreadySharedWith($listId, $userId): bool
    {
        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'SELECT * FROM private_shares WHERE list_id = :listId AND user_id = :userId'
        );

        $statement->bindValue('listId', $listId);
        $statement->bindValue('userId', $userId);
        $statement->execute();

        return $statement->rowCount() !== 0;
    }

    public function listIsPublic($listId)
    {
        $connection = new Connection();
        $statement = $connection->pdo->prepare(
            'SELECT * FROM public_shares WHERE list_id = :listId;'
        );

        $statement->bindValue('listId', $listId);
        $statement->execute();

        return $statement->rowCount() !== 0;
    }

    public function setListPublic($listId)
    {
        if (Application::$app->auth->userOwnsListItem($listId))
        {
            $connection = new Connection();

            $statement = $connection->pdo->prepare(
                'INSERT INTO public_shares (list_id) 
                VALUES(:listId);'
            );
            if ($this->listIsPublic($listId))
            {
                $statement = $connection->pdo->prepare(
                    'DELETE FROM public_shares WHERE list_id = :listId;'
                );
            }
    
            $statement->bindValue('listId', $listId);
            $statement->execute();
        }
    }

    public function notify($userId)
    {
        $connection = new Connection();

        $statement = $connection->pdo->prepare(
            'INSERT INTO notifications (sender_id, recipient_id) VALUES(:senderId, :recipientId);'
        );

        $senderId = Application::$app->auth->user->id;
        $statement->bindValue('senderId', $senderId);
        $statement->bindValue('recipientId', $userId);
        $statement->execute();
    }

    public function deleteNotification($recipientId)
    {
        $connection = new Connection();

        $statement = $connection->pdo->prepare(
            'DELETE FROM notifications WHERE sender_id = :senderId AND recipient_id = :recipientId '
        );

        $senderId = Application::$app->auth->user->id;
        $statement->bindValue('senderId', $senderId);
        $statement->bindValue('recipientId', $recipientId);
        $statement->execute();
    }

    public function getNotificationCount()
    {
        $connection = new Connection();

        $statement = $connection->pdo->prepare(
            'SELECT * FROM notifications WHERE recipient_id = :userId;'
        );

        $statement->bindValue('userId', Application::$app->auth->user->id);
        $statement->execute();

        return $statement->rowCount();
    }

    public function clearNotifications()
    {
        $connection = new Connection();

        $statement = $connection->pdo->prepare(
            'DELETE FROM notifications WHERE recipient_id = :userId'
        );

        $statement->bindValue('userId', Application::$app->auth->user->id);
        $statement->execute();
    }

    public function shareUnshareTask($taskId)
    {
        $connection = new Connection();

        $statement = $connection->pdo->prepare(
            'INSERT INTO public_task_shares (task_id) VALUES(:taskId);'
        );

        if ($this->taskAlreadyShared($taskId))
        {
            $statement = $connection->pdo->prepare(
                'DELETE FROM public_task_shares WHERE task_id = :taskId;'
            );
        }

        $statement->bindValue('taskId', $taskId);
        $statement->execute();
    }

    public function taskAlreadyShared($taskId): bool
    {
        $connection = new Connection();

        $statement = $connection->pdo->prepare(
            'SELECT * FROM public_task_shares WHERE task_id = :taskId;'
        );


        $statement->bindValue('taskId', $taskId);
        $statement->execute();
        return $statement->rowCount() !== 0;
    }
}