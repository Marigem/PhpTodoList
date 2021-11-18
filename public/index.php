<?php

use app\core\Application;

    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../layout/header.php';    



    if (Application::$app->auth->isGuest())
    {
        header('Location: login.php');
    }
    else
    {
        header('Location: dashboard.php');
    }
?>






<?php include_once __DIR__.'/../layout/footer.php';  ?>