<?php
	session_start();
    require_once dirname(__DIR__) . '/model/User.php';
    require_once dirname(__DIR__) . '/model/Event.php';

    if (empty($_GET['id']) || filter_var($_GET['id'], FILTER_VALIDATE_INT) === false) {
        header('Location: http://' . $_SERVER['SERVER_NAME'] . '/index.php');
        exit();
    }

    $eventDetail = Event::getById($_GET['id']);

    if ($eventDetail == null) {
        header('Location: http://' . $_SERVER['SERVER_NAME'] . '/index.php');
        exit();
    }

    require_once("header.php");
?>

<h1><?=$eventDetail->getName();?></h1>

<p><?=$eventDetail->getDescription();?></p>

<?php
    require_once('footer.php');
?>