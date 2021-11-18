<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../layout/header.php';

use app\core\Application;
if (Application::$app->auth->isGuest())
{
    header('Location: login.php');
    return;
}
Application::$app->auth->logout();
header('Location: login.php');
?>
