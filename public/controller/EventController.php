<?php
    require_once dirname(__DIR__) . '/model/Event.php';
    require_once dirname(__DIR__) . '/model/User.php';

    define('HOME_PATH', 'Location: http://' . $_SERVER['SERVER_NAME'] . '/index.php');

    function eventDetail() {
        // Checking if there is an ID
        if (empty($_GET['id'])) {
            header(HOME_PATH);
            exit();
        }

        // Displaying the detail of the Event
        header('Location: http://' . $_SERVER['SERVER_NAME'] . '/view/eventDetail.php?id=' . $_GET['id']);
        exit();
    }

    function saveEvent() {
        if (
            empty($_POST['name']) ||
            empty($_POST['desciption']) ||
            empty($_POST['province']) ||
            empty($_POST['locality']) ||
            empty($_POST['terrainType']) ||
            empty($_POST['date']) ||
            empty($_POST['type']) ||
            empty($_POST['host'])
        ) {
            header(HOME_PATH);
            exit();
        }

        $hostAux = User::getById($_POST['host']);

        $eventAux = new Event(
            $_POST['name'], 
            $_POST['description'], 
            $_POST['province'], 
            $_POST['locality'], 
            $_POST['terrainType'], 
            $_POST['date'], 
            $_POST['type'], 
            User::getById($_POST['host']), 
            ""
        );

        $eventAux->getAttendees()[] = $hostAux;
        $eventAux->insert();
    }

    $action = 1;

    if (isset($_GET['action']) && !empty($_GET['action'])) {
        $action = $_GET['action'];
    } 

    switch($action) {
        case 2:
            // Detail of an Event
            eventDetail();
            break;
        case 3:
            break;
        default:
            // Displaying Home page
            header(HOME_PATH);
            break;
    }
?>