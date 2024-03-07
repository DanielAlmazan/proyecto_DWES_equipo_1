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

<h1>LOGIN</h1>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="registerForm" class="form">
    <label>Email
        <input type="text" name="email" placeholder="Write your email...">
    </label>
    <label>Password
        <input type="password" name="pass" placeholder="Write your password...">
    </label>
    <button>LOGIN</button>
</form>

<a id="button" href="register.php">REGISTER</a>
<?php
    require_once("footer.php");
?>
