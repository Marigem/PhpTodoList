<?php

use app\core\Application;
use app\core\InputValidator;
use app\core\Session;

require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../layout/header.php';

if (Application::$app->auth->isGuest())
{
    header('Location: login.php');
}
?>

<?php if (!Application::$app->session->is_set(Session::KEYS_JUST_LOGGED_IN)): ?>
    <div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8">
<div id="topalert" class="alert alert-success" role="alert">
    Logged in.
</div>
</div>
</div>

<?php 
    Application::$app->session->set(Session::KEYS_JUST_LOGGED_IN, 'true');   
    endif; 
?>


<?php 
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $delete_list_id = InputValidator::post_data("delete-list");
    $title = InputValidator::post_data("title");
    $description = InputValidator::post_data("description");

    if (!$delete_list_id)
    {
        if (!$title)
        {
            $errors['title'] = "This field is required";
        }
        if (!$description)
        {
            $errors['description'] = "This field is required";
        }
    
        if (empty($errors))
        {
            Application::$app->creator->createTodoList($title, $description);
        }
    }
    else
    {
        Application::$app->creator->deleteTodoList($delete_list_id);
        header('Location: profile.php');
    }

}



$userTodoLists = Application::$app->fetcher->fetchUserTodoLists();
?>

<div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8 content">

        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6">
                <br>
                <h3>New list</h3>
                <br>
                <form action="" method="post">
                    <div class="mb-3">
                        <input name="title"
                            class="form-control <?php echo (isset($errors["title"]) ? "is-invalid" : ''); ?>" value=""
                            placeholder="Title"  maxlength="35">
                        <div class="invalid-feedback">
                            <?php echo $errors['title'] ?? '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                            <textarea name="description" 
                                class="form-control <?php echo (isset($errors["description"]) ? "is-invalid" : ''); ?>" rows="3" 
                                placeholder="Description" maxlength="135"></textarea>
                        <div class="invalid-feedback">
                            <?php echo $errors['description'] ?? '' ?>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Create list</button>
                    </div>
                </form>
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
        <h3 style="margin-left: 10px;">My lists</h3>
        <br>
        <ol class="list-group list-group">
            <?php 
            
            foreach($userTodoLists as $todoList)
            {
                echo Application::$app->factory->todoListItem($todoList);
            }
            if (empty($userTodoLists)):
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