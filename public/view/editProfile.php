<?php
	session_start();
    $pageTitle = "Edit Profile";
    require_once("header.php");
?>

<h1>EDIT PROFILE</h1>

<form action="#" method="post" id="registerForm" class="form">
    <label>Email
        <input type="text">
    </label>
    <label>Password
        <input type="text">
    </label>
    <label>Confirm Password
        <input type="text">
    </label>
    <button>EDIT PROFILE</button>
</form>

<?php
    require_once("footer.php");
?>
