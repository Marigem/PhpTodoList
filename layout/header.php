<?php

use app\core\Application;
use app\core\Authenticator;
use app\core\ItemCreator;
use app\core\ItemFactory;
use app\core\ItemFetcher;
use app\core\Session;

$creator = new ItemCreator();
$fetcher = new ItemFetcher();
$factory = new ItemFactory();
$auth = new Authenticator();
$session = new Session();
$app = new Application($auth, $session, $creator, $fetcher, $factory);

?>

<!doctype html>
<html lang="en">

<head lang="en" data-theme="light">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/slider.css">
    <title>Todo List</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light mb-4">
        <div class="container">
            <a class="navbar-title" href="/">Todo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link-custom" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>

                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php if (Application::$app->auth->isGuest()): ?>
                        <li class="nav-item">
                            <a class="nav-link-custom" aria-current="page" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-custom" aria-current="page" href="register.php">Register</a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link-custom" aria-current="page" href="profile.php"><?php echo Application::$app->auth->user->name ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-custom" aria-current="page" href="logout.php">Logout</a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <label class="switch">
                                <input id="themeswitch" type="checkbox" name="theme">
                                <span class="slider round"></span>
                            </label>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">