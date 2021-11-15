<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../layout/header.php';


use app\core\Application;
if (Application::$app->auth->isGuest())
{
    header('Location: index.php');
    return;
}


Application::$app->sharing->clearNotifications();

$sharedLists = Application::$app->fetcher->listsSharedWithMe();
?>

<div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8 content">
        <br>
        <h3 style="margin-left: 10px;">Lists shared with me</h3>
        <br>
        <ol class="list-group list-group">
            <?php 
            
            foreach($sharedLists as $todoList)
            {
                echo Application::$app->factory->todoListItem($todoList, true);
            }
            if (empty($sharedLists)):
            ?>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><a class="todo-list-item-link" href="#">Nothing to show</a></div>
                </div>
            </li>
            <?php endif; ?>
        </ol>
    </div>
</div>

<?php include_once __DIR__.'/../layout/footer.php';  ?>