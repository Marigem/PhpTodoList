<?php 
    $_SESSION['just_logged_in'] = 'true';
    require_once __DIR__.'/../vendor/autoload.php';
    include_once __DIR__.'/../layout/header.php';
?>

<?php if ($_SESSION['just_logged_in']): ?>
    <div id="topalert" class="alert alert-success" role="alert">
            Logged in.
    </div>
    
<?php 
    $_SESSION['just_logged_in'] = 'false';   
    endif; 
?>

<?php include_once __DIR__.'/../layout/footer.php';  ?>