<?php
	session_start();
    require_once("../controller/UserController.php");
    if(!isset($_SESSION['userId'])) {
        header("Location: home.php");
    } else{
        $user = User::getById($_SESSION['userId']);
    }

    if(isset($_POST["submit"])) {
        if(isset($_GET['changeAvatar'])) {
            if(changeAvatar()) {
                header("Location: user.php");
                die();
            }
        } else{
            if(!empty($_POST["pass1"]) && !empty($_POST["pass2"]) &&
                $_POST["pass1"] == $_POST["pass2"]) {
                if(!editProfile())
                    echo "<p class='alert alert-danger'>Se deben rellenar todos los campos</p>";
                else {
                    header("Location: user.php");
                    die();
                }
            } else
                echo "<p class='alert alert-danger'>Las contraseñas no coinciden</p>";
        }
    }

    $pageTitle = "Edit Profile";
    require_once("header.php");
?>

<div class="container userInfo">
    <div class="row">
        <h1>Editar perfil</h1>
    </div>
    <div class="row">
    <?php if(isset($_GET['changeAvatar'])) { ?>
        <p><strong>Avatar actual</strong></p>
        <img src="/res/images/avatars/<?= $user->getAvatar() ?>" alt="Foto perfil">
        <form action="<?= $_SERVER['PHP_SELF'] ?>?changeAvatar=yes" method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="avatar" class="form-label">Avatar nuevo</label>
                <input type="file" name="avatar" accept="image/*">
            </div>
            <input type="submit" name="submit" class="btn btn-primary mb-3" value="Cambiar avatar">
        </form>
    <?php } else { ?>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" placeholder="Escribe tu nombre..."
                        value="<?= $user->getName() ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="surnames" class="form-label">Apellidos</label>
                    <input type="text" name="surnames" class="form-control" placeholder="Escribe tus apellidos..."
                        value="<?= $user->getSurnames() ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="nickname" class="form-label">Nickname</label>
                    <input type="text" name="nickname" class="form-control" placeholder="Escribe tu nickname..."
                        value="<?= $user->getNickName() ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Escribe tu email..."
                        value="<?= $user->getEmail() ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="pass1" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="pass1" placeholder="Escribe tu contraseña...">
                    <p class="small">Debes rellenar tu actual contraseña para comprobarla o una nueva para cambiarla</p>
                </div>
                <div class="form-group mb-3">
                    <label for="pass2" class="form-label">Confirmar contraseña</label>
                    <input type="password" name="pass2" class="form-control" placeholder="Confirma tu contraseña...">
                </div>
                <input type="submit" name="submit" class="btn btn-primary mb-3" value="Guardar cambios">
            </form>
        <?php } ?>
    </div>
</div>

<?php
    require_once("footer.php");
?>
