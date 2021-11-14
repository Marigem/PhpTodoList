<?php require_once __DIR__.'/../vendor/autoload.php';


    include_once __DIR__.'/../layout/header.php';
?>


<form action="" method="post" class="login-form">
<h3 class="form-info">Login</h3>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" class="form-control <?php echo isset($errors['email']) ? "is-invalid" : "" ?>"
            value="<?php echo $email ?>">
            <div class="invalid-feedback">
                <?php echo $errors['email'] ?>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control <?php echo isset($errors['password']) ? "is-invalid" : "" ?>">
            <div class="invalid-feedback">
                <?php echo $errors['password'] ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>




<?php include_once __DIR__.'/../layout/footer.php';  ?>