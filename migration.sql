DROP DATABASE IF EXISTS tododb;
CREATE DATABASE tododb;
USE tododb;
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(1024) NOT NULL,
    password VARCHAR(1024) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE todo_list (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id)
        REFERENCES users(id)
);

CREATE TABLE task (
    id INT NOT NULL AUTO_INCREMENT,
    list_id INT NOT NULL,
    description VARCHAR(1024),
    PRIMARY KEY (id),
    FOREIGN KEY (list_id)
        REFERENCES todo_list(id)
        ON DELETE CASCADE
);

CREATE TABLE public_shares (
    list_id INT NOT NULL,
    FOREIGN KEY (list_id)
        REFERENCES todo_list(id)
        ON DELETE CASCADE
);

CREATE TABLE private_shares (
    list_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (list_id)
        REFERENCES todo_list(id)
        ON DELETE CASCADE,
    FOREIGN KEY (user_id)
        REFERENCES users(id)
);

CREATE TABLE public_task_shares (
    task_id INT NOT NULL,
    FOREIGN KEY (task_id)
        REFERENCES task(id)
);

CREATE VIEW user_todo_view 
as SELECT users.id as user_id, 
todo_list.id as list_id, 
users.name as name, 
todo_list.title as title FROM todo_list INNER JOIN users ON todo_list.user_id = users.id;

-- CREATE USER IF NOT EXISTS 'dbuser'@'192.168.0.13' IDENTIFIED BY 'password';
-- GRANT ALL PRIVILEGES ON tododb.* TO 'dbuser'@'192.168.0.13';

CREATE USER IF NOT EXISTS 'dbuser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON tododb.* TO 'dbuser'@'localhost';