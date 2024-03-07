<?php
    session_start();
    require_once "../controller/UserController.php";
    logout();
    header("Location: home.php");
?>