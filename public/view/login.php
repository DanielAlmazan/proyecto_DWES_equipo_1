<?php
    $pageTitle = "Login";
    require_once("header.php");
?>

<h1>LOGIN</h1>

<form action="#" method="post" id="registerForm" class="form">
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
