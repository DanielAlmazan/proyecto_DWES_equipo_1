<?php
	session_start();
    require_once("../controller/UserController.php");
    if(isset($_SESSION['userId'])) {
        header("Location: home.php");
    }

    if(isset($_POST["submit"])) {
        if(!empty($_POST["pass1"]) && !empty($_POST["pass2"]) &&
            $_POST["pass1"] == $_POST["pass2"]) {
            if(!register())
                echo "<p class='alert alert-danger'>Se deben rellenar todos los campos</p>";
            else {
                header("Location: home.php");
                die();
            }
        } else
            echo "<p class='alert alert-danger'>Las contraseñas no coinciden</p>";
    }

    $pageTitle = "Register";
    require_once("header.php");
?>

<div class="container">
    <div class="row">
        <h1>Register</h1>
    </div>
    <div class="row">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Write your name...">
            </div>
            <div class="form-group mb-3">
                <label for="surnames" class="form-label">Surname</label>
                <input type="text" name="surnames" class="form-control" placeholder="Write your surnames...">
            </div>
            <div class="form-group mb-3">
                <label for="nickname" class="form-label">Nickname</label>
                <input type="text" name="nickname" class="form-control" placeholder="Write your nickname...">
            </div>
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Write your email...">
            </div>
            <div class="form-group mb-3">
                <label for="pass1" class="form-label">Password</label>
                <input type="password" class="form-control" name="pass1" placeholder="Write your password...">
            </div>
            <div class="form-group mb-3">
                <label for="pass2" class="form-label">Confirm password</label>
                <input type="password" name="pass2" class="form-control" placeholder="Confirm your password...">
            </div>
            <div class="form-group mb-3">
                <label for="avatar" class="form-label">Avatar</label>
                <input type="file" name="avatar" accept="image/*">
            </div>
            <input type="submit" name="submit" class="btn btn-primary mb-3" value="Register">
        </form>
    </div>
</div>
<?php
    require_once("footer.php");
?>
