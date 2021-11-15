<?php require_once __DIR__.'/../vendor/autoload.php';

use app\core\Authenticator;
use app\core\InputValidator;

    include_once __DIR__.'/../layout/header.php';

$errors = [];
$name = "";
$email = "";
$password = "";
$passwordConfirm = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = InputValidator::post_data("name");
        $email = InputValidator::post_data("email");
        $password = InputValidator::post_data("password");
        $passwordConfirm = InputValidator::post_data("passwordConfirm");

        if (!$name) 
        {
            $errors['name'] = "This field is required";
        }
        if (!$email) 
        {
            $errors['email'] = "This field is required";
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $errors['email'] = "This field must be a valid email";
        }
        elseif (Authenticator::emailAlreadyExists($email))
        {
            $errors['email'] = "This email is already in use";
        }
        if (!$password) 
        {
            $errors['password'] = "This field is required";
        }
        if (!$passwordConfirm) 
        {
            $errors['passwordConfirm'] = "This field is required";
        }
        else if (strcmp($password, $passwordConfirm) != 0)
        {
            $errors['passwordConfirm'] = "Passwords must match";
        }

        if (empty($errors))
        {
            $user = [
                'name' => $name,
                'email' => $email,
                'password' => $password
            ];

            $result = Authenticator::registerUser($user);
            header('Location: dashboard.php');
        }
        
    }
?>

<form action="" method="post" class="login-form">
        <h3 class="form-info">Register</h3>        
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control <?php echo isset($errors['name']) ? "is-invalid" : "" ?>"
            value="<?php echo $name ?>" placeholder="Enter your full name">
            <div class="invalid-feedback">
                <?php echo $errors['name'] ?>
            </div>
        </div>
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
        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="passwordConfirm" class="form-control <?php echo isset($errors['passwordConfirm']) ? "is-invalid" : "" ?>"
            placeholder="Re-enter your password">
            <div class="invalid-feedback">
                <?php echo $errors['passwordConfirm'] ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>




<?php include_once __DIR__.'/../layout/footer.php';  ?>