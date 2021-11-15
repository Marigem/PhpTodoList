<?php

use app\core\Application;
use app\core\Authenticator;
use app\core\InputValidator;

require_once __DIR__.'/../vendor/autoload.php';


include_once __DIR__.'/../layout/header.php';

if (!Application::$app->auth->isGuest())
{
    header('Location: index.php');
}

$errors = [];
$email = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = InputValidator::post_data("name");
    $email = InputValidator::post_data("email");
    $password = InputValidator::post_data("password");
    $passwordConfirm = InputValidator::post_data("passwordConfirm");

    if (!$email) 
    {
        $errors['email'] = "This field is required";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errors['email'] = "This field must be a valid email";
    }
    if (!$password) 
    {
        $errors['password'] = "This field is required";
    }

    if (empty($errors))
    {
        if (Application::$app->auth->login($email, $password))
        {
            
            header('Location: profile.php');
        }
        else
        {
            $errors['invalid-credentials'] = true;
        }
    }
    
}
?>


<form action="" method="post" class="login-form">
<h3 class="form-info">Login</h3>
        <?php if (isset($errors['invalid-credentials'])): ?>
            <div class="row">
                <div class="col bg-danger text-center login-error-area">
                    Invalid email or password
                </div>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" class="form-control <?php echo isset($errors['email']) ? "is-invalid" : "" ?>"
            value="<?php echo $email ?>" placeholder="Enter your email">
            <div class="invalid-feedback">
                <?php echo $errors['email'] ?>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control <?php echo isset($errors['password']) ? "is-invalid" : "" ?>"
            placeholder="Enter your password">
            <div class="invalid-feedback">
                <?php echo $errors['password'] ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>




<?php include_once __DIR__.'/../layout/footer.php';  ?>