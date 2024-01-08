<?php
    require_once("../model/User.php");
    // TODO: Implement sessions functionality
    $loggedIn = false;

    // If user's not logged in, we'll redirect to login page
    if (!$loggedIn) {
        header("Location: login.php");
    // If user's logged in, we'll show it's relevant info and offer the option for editing it
    } else {
        // TODO: Fetch user from database
        $user = new User(2, "Anaclet", "McJohnson", "anaclet@mc.johnson", "Anacletus", "123", "Anaclet's Avatar");
        $user->setKarma(3);

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
    <?php
        }
    ?>
</main>
<?php
    require_once("footer.php");
?>
