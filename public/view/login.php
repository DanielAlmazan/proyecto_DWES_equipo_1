<?php
    session_start();
    
    if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
        require_once("../model/User.php");
        require_once("../controller/UserController.php");
        
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var(trim($_POST["pass"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $user = User::getByLogin($email, $password);
        
        if ($user) {
            login($user);
            header("Location: home.php");
        } else {
            echo "<p class='error'>Invalid email or password</p>";
        }
    }
    $pageTitle = "Login";
    require_once("header.php");
?>

<div class="container">
    <div class="row">
        <h1>Login</h1>
    </div>
    <div class="row">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Write your email...">
            </div>
            <div class="form-group mb-3">
                <label for="email" class="form-label">Password</label>
                <input type="password" class="form-control" name="pass" placeholder="Write your password...">
            </div>
            <input type="submit" class="btn btn-primary mb-3" value="Login">
        </form>
    </div>
    <div class="row">
        <a class="btn btn-success" role="button" id="registerBtn" href="register.php">Register</a>
    </div>
</div>
<?php
    require_once("footer.php");
?>
