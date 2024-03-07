<?php
    require_once dirname(__DIR__) . 'model/Event.php';
    require_once dirname(__DIR__) . 'model/User.php';

    function eventDetail() {
        // Checking if there is an ID
        if (empty($_GET['id'])) {
            header('Location: http://' . $_SERVER['SERVER_NAME'] . '/index.php');
            exit();
        }

        $eventId = $_GET['id'];
        // Getting the Event
        $data['event'] = Event::getById($eventId);
        // Displaying the detail of the Event
        require_once dirname(__DIR__) . 'view/eventDetail.php';
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
            header('Location: http://' . $_SERVER['SERVER_NAME'] . '/index.php');
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

        $eventAux->addAttendee($hostAux);
        $eventAux->insert();
    }

    $action = 1;

    if (isset($_GET['accion']) && !empty($_GET['accion'])) {
        $action = $_GET['accion'];
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
            require_once dirname(__DIR__) . 'view/home.php';
            break;
    }
?>