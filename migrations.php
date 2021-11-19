<?php 

use app\core\Connection;

function prepare_and_execute($query)
{
    $connection = new Connection();
    $statement = $connection->pdo->prepare(
        $query
    );

    $statement->execute();
}

prepare_and_execute(
    'CREATE TABLE users (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(1024) NOT NULL,
        password VARCHAR(1024) NOT NULL,
        PRIMARY KEY (id)
    );'
);

prepare_and_execute(
    'CREATE TABLE todo_list (
        id INT NOT NULL AUTO_INCREMENT,
        user_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description VARCHAR(255) NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (user_id)
            REFERENCES users(id)
    );'
);

prepare_and_execute(
    'CREATE TABLE task (
        id INT NOT NULL AUTO_INCREMENT,
        list_id INT NOT NULL,
        description VARCHAR(1024),
        PRIMARY KEY (id),
        FOREIGN KEY (list_id)
            REFERENCES todo_list(id)
            ON DELETE CASCADE
    );'
);

prepare_and_execute(
    'CREATE TABLE public_shares (
        list_id INT NOT NULL,
        FOREIGN KEY (list_id)
            REFERENCES todo_list(id)
            ON DELETE CASCADE
    );'
);

prepare_and_execute(
    'CREATE TABLE private_shares (
        list_id INT NOT NULL,
        user_id INT NOT NULL,
        FOREIGN KEY (list_id)
            REFERENCES todo_list(id)
            ON DELETE CASCADE,
        FOREIGN KEY (user_id)
            REFERENCES users(id)
    );'
);

prepare_and_execute(
    'CREATE TABLE public_task_shares (
        task_id INT NOT NULL,
        FOREIGN KEY (task_id)
            REFERENCES task(id)
            ON DELETE CASCADE
    );'
);

prepare_and_execute(
    'CREATE TABLE notifications {
        sender_id INT NOT NULL,
        recipient_id INT NOT NULL,
        FOREIGN KEY (sender_id)
            REFERENCES users(id),
        FOREIGN KEY (recipient_id)
            REFERENCES users(id)
    };'
);

prepare_and_execute(
    'CREATE VIEW user_todo_view 
    as SELECT users.id as user_id, 
    todo_list.id as list_id, 
    users.name as name, 
    todo_list.title as title FROM todo_list INNER JOIN users ON todo_list.user_id = users.id;'
);