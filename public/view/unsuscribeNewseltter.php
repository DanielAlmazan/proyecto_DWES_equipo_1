<?php
    session_start();
    
    if(isset($_POST['submit'])) {
        if (!empty($_POST["email"])) {
            require_once("../model/User.php");
            
            $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            if(User::unsuscribeNewsletter($email)) {
                echo "<p class='alert alert-success'>Te has desuscrito correctamente</p>";
            }
        } else
            echo "<p class='alert alert-danger'>Debes introducir un email</p>";
    }
    
    $pageTitle = "Newsletter";
    require_once("header.php");
?>

<div class="container">
    <div class="row">
        <h1>Desuscribirse del newsletter</h1>
    </div>
    <div class="row">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Escribe tu email...">
            </div>
            <input type="submit" class="btn btn-primary mb-3" name="submit" value="Desuscribirse">
        </form>
    </div>
</div>
<?php
    require_once("footer.php");
?>
