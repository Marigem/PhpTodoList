<?php

use app\core\Application;
use app\core\InputValidator;

require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../layout/header.php'; 
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || Application::$app->auth->isGuest())
    {
        header("Location: index.php");
    }
    $users = Application::$app->fetcher->fetchAllUsers();
    $listId = InputValidator::post_data('share-list');
    $userToShareWith = InputValidator::post_data('user_id');
    $makeListPublicOrPrivate = isset($_POST['make-list-public-or-private']);
    
    if ($userToShareWith)
    {
        Application::$app->sharing->shareListWithUser($listId, $userToShareWith);
    }
    if ($makeListPublicOrPrivate)
    {

        Application::$app->sharing->setListPublic($listId);
    }
?>

<div class="row content p-4 text-center">
    <div class="col-lg-4">

    </div>
    <div class="col-lg-4 text-center">
    <h3 style="text-align:left">Share with...</h3>
    <br>
       <form class="d-grid gap-2" action="" method="post" style="display: inline-block;">
            <input type="hidden" name="make-list-public-or-private" value="true">
            <input type="hidden" name="share-list" value="<?php echo $listId ?>">
            <div class="d-grid gap-2">
            <?php if (!Application::$app->sharing->listIsPublic($listId)): ?>
                <button class="btn btn-success mb-2">Make Public</button>
            <?php else: ?>
                <button class="btn btn-secondary mb-2">Make Private</button>
            <?php endif; ?>
             </div>
    </form>
    <ol class="list-group list-group">

    <?php 

        foreach ($users as $user)
        {
            if ($user-> id !== Application::$app->auth->user->id)
            {
                $alreadyShared = Application::$app->sharing->alreadySharedWith($listId, $user->id);
                echo Application::$app->factory->userItem($user, $listId, $alreadyShared);
            }
        }
    

    ?>
 
    <li class="list-group-item text-start">
        <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="btn btn-success mb-2">Go Back</a>
    </li>



  <!-- <li class="list-group-item d-flex justify-content-between align-items-start">
      
    <div class="ms-2 me-auto mt-auto mb-auto">
      <div class="fw-bold">User Name</div>
    </div>
    <form action="" method="post" style="display: inline-block;">
        <input type="hidden" name="user_id" value="">
        <button class="btn btn-sm btn-primary rounded" style="width:100px;">Share</button>
    </form>
  </li> -->
</ol>
    </div>
</div>




<?php include_once __DIR__.'/../layout/footer.php';  ?>