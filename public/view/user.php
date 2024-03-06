<?php
    session_start();
    require_once("../model/User.php");
    require_once("../controller/UserController.php");

    $loggedIn = false;
    if(isset($_SESSION['user'])) {
        $loggedIn = true;
        $user = User::getById($_SESSION['user']);
    }

    // If user's not logged in, we'll redirect to login page
    if (!$loggedIn) {
        header("Location: login.php");
        die();
    // If user's logged in, we'll show it's relevant info and offer the option for editing it
    }
    
    require_once("header.php");
?>
<main>
    <section id="userInfo">
        <p>NickName: <?= $user->getNickName() ?></p>
        <p>Karma: <?= $user->getKarma() ?></p>
        <p>Name: <?= $user->getName() ?></p>
        <p>Surnames: <?= $user->getSurnames() ?></p>
        <p>Email: <?= $user->getEmail() ?></p>
        <p>Avatar: <?= $user->getAvatar() ?></p>
        <form action="#">
            <input type="button" value="Edit profile">
        </form>
    </section>
</main>
<?php
    require_once("footer.php");
?>
