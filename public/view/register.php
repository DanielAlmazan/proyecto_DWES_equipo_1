<?php
    $pageTitle = "Register";
    require_once("header.php");
?>

<h1>REGISTER</h1>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="registerForm" class="form">
    <label>Name
        <input type="text" name="name" placeholder="Write your name...">
    </label>
    <label>Surnames
        <input type="text" name="surnames" placeholder="Write your surnames...">
    </label>
    <label>Nickname
        <input type="text" name="nickname" placeholder="Write your nickname...">
    </label>
    <label>Email
        <input type="email" name="" placeholder="Write your email...">
    </label>
    <label>Password
        <input type="password" name="" placeholder="Write your password...">
    </label>
    <label>Confirm Password
        <input type="password" name="" placeholder="Confirm your password...">
    </label>
    <label>Avatar
        <input type="file" name="" accept="image/*">
    </label>
    <button type="submit">REGISTER</button>
</form>

<?php
    require_once("footer.php");
?>
