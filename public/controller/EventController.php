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

    function saveBanner(): string {
        $fileName = '';

        if (is_uploaded_file($_FILES['bannerPicture']['tmp_name'])) {
            $uploadDir = dirname(__DIR__) . '/res/images/events/';
            $uniqueId = time();
            $fileName = $uniqueId . '-' . $_FILES['bannerPicture']['name'];

            move_uploaded_file($_FILES['bannerPicture']['tmp_name'], $uploadDir . $fileName);
        } else {
            header(HOME_PATH);
            exit();
        }

        return $fileName;
    }

    function saveEvent() {
        if (
            empty($_POST['name']) ||
            empty($_POST['province']) ||
            empty($_POST['locality']) ||
            empty($_POST['date']) ||
            empty($_POST['host']) ||
            empty($_POST['type'])
        ) {
            // TODO: Redirigir a newEvent con los errores
            header(HOME_PATH);
            exit();
        }

        $name = htmlspecialchars(stripcslashes(trim($_POST['name'])));
        $description = empty($_POST['description']) ? 'Sin descripción' : htmlspecialchars(stripcslashes(trim($_POST['description'])));
        $province = htmlspecialchars(stripcslashes(trim($_POST['province'])));
        $locality = htmlspecialchars(stripcslashes(trim($_POST['locality'])));
        $terrainType = empty($_POST['terrainType']) ? 'N/A' : htmlspecialchars(stripcslashes(trim($_POST['terrainType'])));
        $date = htmlspecialchars(stripcslashes(trim($_POST['date'])));
        $type = htmlspecialchars(stripcslashes(trim($_POST['type'])));
        $hostId = htmlspecialchars(stripcslashes(trim($_POST['host'])));

        // TODO: Validación específica para date, type y host

        $bannerPicture = '';

        if (!empty($_FILES['bannerPicture'])) {
            $bannerPicture = saveBanner();
        }

        $hostAux = User::getById($hostId);

        $eventAux = new Event($name, $description, $province, $locality, $terrainType, new DateTime($date), 
            $type, $hostAux, $bannerPicture
        );

        $eventAux->getAttendees()[] = $hostAux;
        $eventAux->insert();

        header(HOME_PATH);
        exit();
    }

    function deleteEvent() {
        // Checking if there is an ID
        if (empty($_GET['id'])) {
            header(HOME_PATH);
            exit();
        }

        $eventAux = Event::getById($_GET['id']);
        $eventAux->delete();

        header(HOME_PATH);
        exit();
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
            // Delete an Event
            deleteEvent();
            break;
        case 4:
            // Inserting an Event
            saveEvent();
            break;
        default:
            // Displaying Home page
            header(HOME_PATH);
            break;
    }
?>