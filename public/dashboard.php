<?php

use app\core\Application;
use app\core\InputValidator;

require_once __DIR__.'/../vendor/autoload.php';
    include_once __DIR__.'/../layout/header.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $delete_list_id = InputValidator::post_data("delete-list");

    if ($delete_list_id)
    {
        Application::$app->creator->deleteTodoList($delete_list_id);
    }
    }

    $public_todo_lists = Application::$app->fetcher->fetchPublicLists();
    $public_tasks = Application::$app->fetcher->fetchPublicTasks();
?>

<div class="row">
    <div class="col-lg-5 content">
        <h3 class="p-2">Public todo lists</h3>
        <br>
        <ol class="list-group list-group">
            <?php
            
            foreach ($public_todo_lists as $listItem)
            {
                echo Application::$app->factory->todoListItem($listItem, true);
            }
            
            
            ?>
        </ol>
    </div>
    <div class="col-lg content">
        <h3 class="p-2 mb-0">Public tasks</h3>
        <p class="text-sm-start ms-2 mt-0"><i>All public tasks are anonymous</i></p>
        <br>
        <ol class="list-group list-group-numbered">
            <?php
            
            foreach ($public_tasks as $task)
            {
                echo Application::$app->factory->taskItem($task['list-id'], $task, true);
            }


            ?>
        </ol>
    </div>
</div>






<?php include_once __DIR__.'/../layout/footer.php';  ?>