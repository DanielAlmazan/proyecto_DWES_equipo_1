<?php
    session_start();
    require_once("../model/User.php");
    require_once("../model/Event.php");
    require_once("../model/Specie.php");
    require_once("../controller/UserController.php");

    if(isset($_SESSION['userId'])) {
        if(isset($_GET['user']) && intval($_GET['user'])) {
            $user = User::getById($_GET['user']);
            $myProfile = false;
        } else {
            $user = User::getById($_SESSION['userId']);
            $myProfile = true;
        }

        $eventsOfUser = User::getEventsOfUser($user->getId());
    } else {
        // If user's not logged in, we'll redirect to login page
        header("Location: login.php");
        die();
    }

    // If user's logged in, we'll show it's relevant info and offer the option for editing it    
    require_once("header.php");
?>
<main>
    <section id="userInfo">
        <?php if($user) { ?>
            <p><strong>Nickname: </strong><?= $user->getNickName() ?></p>
            <p><strong>Karma: </strong><?= $user->getKarma() ?> puntos</p>
            <p><strong>Nombre: </strong><?= $user->getName() ?></p>
            <p><strong>Apellidos: </strong><?= $user->getSurnames() ?></p>
            <p><strong>Email: </strong><?= $user->getEmail() ?></p>
            <p><strong>Avatar:</strong></p>
            <img src="/res/images/avatars/<?= $user->getAvatar() ?>" alt="Foto perfil">
            <?php if($myProfile) { ?>
                <div>
                    <a class="btn btn-success" role="button" id="registerBtn" href="editProfile.php">Editar perfil</a>
                    <a class="btn btn-info" role="button" id="registerBtn" href="editProfile.php?changeAvatar=yes">Cambiar avatar</a>
                </div>
                <div>
                    <button class="btn btn-danger" onclick="deleteAccount()" id="registerBtn">Borrar cuenta</button>
                </div>
            <?php }
            if(count($eventsOfUser) > 0) {
                ?> <h2>Eventos del usuario</h2>
                <div id="eventsContainer">
                    <?php
                    foreach($eventsOfUser as $event) {
                        $event->showCard();
                    } ?>
                </div>
            <?php }
        } else { ?>
            <p>No existe ese usuario</p>
        <?php } ?>
    </section>
</main>
<script>
    function deleteAccount() {
        if(confirm("¿Está seguro de borrar su cuenta? No se podrá deshacer.")) {
            location.replace("deleteAccount.php");
        }
    }
</script>
<?php
    require_once("footer.php");
?>
