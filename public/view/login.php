<?php
    if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
        require_once("../model/User.php");
        require_once("../DB/ReforestaDB.php");
        
        $email = $_POST["email"];
        $password = $_POST["pass"];
        $user = User::getByLogin($email, $password);
        
        if ($user) {
            $_SESSION["userId"] = $user->getId();
            header("Location: home.php");
        } else {
            echo "Invalid email or password";
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
    <!-- TODO: Add register button -->
</form>

<a id="fakeRegisterButton" href="register.php">REGISTER</a>
<?php
    require_once("footer.php");
?>
