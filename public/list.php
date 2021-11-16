<?php

use app\core\Application;
use app\core\InputValidator;

require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../layout/header.php';

    $errors = [];
    $itemId = htmlentities(htmlspecialchars($_GET['item']));
    $share_task = InputValidator::post_data('share-task');
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $listId = InputValidator::post_data("list-id");
        $delete_task_id = InputValidator::post_data("delete-task");
        $description = InputValidator::post_data("description");

    if (!$delete_task_id && !$share_task)
    {
        if (!$description)
        {
            $errors['description'] = "This field is required";
        }
    
        if (empty($errors))
        {
            Application::$app->creator->createTask($listId, $description);
        }
    }
    if ($share_task)
    {
        Application::$app->sharing->shareUnshareTask($share_task);
    }
    else
    {
        Application::$app->creator->deleteTask($listId, $delete_task_id);
        header("Location: list.php?item=$listId");
    }
    }

    $todo_list = Application::$app->fetcher->fetchListById($itemId);


    $tasks = Application::$app->fetcher->fetchTasksByListId($todo_list['id']);
?>


<div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8 content">

        <div class="row">
        <h3 class="text-center mt-4"><?php echo $todo_list['title'] ?>
        <?php if (Application::$app->auth->userOwnsListItem($todo_list['id'])): ?>
            <form action="share.php" method="post" style="display:inline-block">
                <input type="hidden" name="share-list" value="<?php echo $todo_list['id'] ?>">
                <button class="btn btn-primary">Share</button>
            </form>
            <form action="profile.php" method="post" style="display:inline-block">
                <input type="hidden" name="delete-list" value="<?php echo $todo_list['id'] ?>">
                <button class="btn btn-danger">Delete</button>
            </form>
        <?php endif; ?>
        </h3>
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6">                
                <?php if (Application::$app->auth->userOwnsListItem($todo_list['id'])): ?>
                <br>
                <form action="" method="post">
                    <div class="mb-3">
                        <input type="hidden" name="list-id" value="<?php echo $itemId ?>">
                        <textarea name="description"
                            class="form-control <?php echo (isset($errors["description"]) ? "is-invalid" : ''); ?>"
                            rows="3" placeholder="Description"></textarea>
                        <div class="invalid-feedback">
                            <?php echo $errors['description'] ?>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">New Task</button>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </div>
        <br>
    </div>
</div>

<div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8 content">
        <br>
        <h3 style="margin-left: 10px;">Tasks</h3>
        <br>
        <ol class="list-group list-group-numbered">


            <?php 
                
                foreach($tasks as $task)
                {
                    echo Application::$app->factory->taskItem($itemId, $task);
                }
            
                if (empty($tasks)):
            ?>
            <li class="list-group-item d-flex justify-content-between">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><a class="todo-list-item-link" href="#">Nothing to show</a></div>
                </div>
            </li>
            <?php endif; ?>
        </ol>
    </div>
</div>



<?php include_once __DIR__.'/../layout/footer.php';  ?>