<?php
    session_start();
    require_once("../controller/UserController.php");

    $user = User::getById($_SESSION['userId']);
    if($user->delete()) {
        logout();
    }
?>