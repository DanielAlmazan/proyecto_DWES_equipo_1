<?php
    session_start();
    require_once dirname(__DIR__) . '/model/Event.php';
    require_once dirname(__DIR__) . '/model/User.php';

    define('HOME_PATH', 'Location: http://' . $_SERVER['SERVER_NAME'] . '/index.php');

    /**
     * Method to render the detail of an Event
     */
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

    // Method to check if the extension of the file is valid
    function checkExtension(string $extension): bool
    {
        $validTypes = ['jpg', 'jpeg', 'png'];
        $valid = false;

        foreach ($validTypes as $validType) {
            if ($validType == $extension) {
                $valid = true;
            }
        }

        return $valid;
    }

    // Method to get the extension of a file
    function getExtension(string $fileName): string
    {
        $parts = explode('.', $fileName);

        return $parts[count($parts) - 1];
    }

    /**
     * Method to save the Banner from an Event
     */
    function saveBanner(): string {
        $fileName = '';

        if (is_uploaded_file($_FILES['bannerPicture']['tmp_name'])) {
            $uploadDir = dirname(__DIR__) . '/res/images/events/';
            $uniqueId = time();
            $fileName = $uniqueId . '-' . $_FILES['bannerPicture']['name'];

            if (!checkExtension(getExtension($fileName))) {
                $fileName = '';
            } else {
                move_uploaded_file($_FILES['bannerPicture']['tmp_name'], $uploadDir . $fileName);
            }
        }

        return $fileName;
    }

    /**
     * Method to save the Event
     */
    function saveEvent() {
        if (
            empty($_POST['name']) ||
            empty($_POST['province']) ||
            empty($_POST['locality']) ||
            empty($_POST['date']) ||
            empty($_POST['host']) ||
            empty($_POST['type'])
        ) {
            header(HOME_PATH);
            exit();
        }

        // Basic filter of inputs
        $name = htmlspecialchars(stripcslashes(trim($_POST['name'])));
        $description = empty($_POST['description']) ? 'Sin descripción' : htmlspecialchars(stripcslashes(trim($_POST['description'])));
        $province = htmlspecialchars(stripcslashes(trim($_POST['province'])));
        $locality = htmlspecialchars(stripcslashes(trim($_POST['locality'])));
        $terrainType = empty($_POST['terrainType']) ? 'N/A' : htmlspecialchars(stripcslashes(trim($_POST['terrainType'])));
        $date = htmlspecialchars(stripcslashes(trim($_POST['date'])));
        $type = htmlspecialchars(stripcslashes(trim($_POST['type'])));
        $hostId = htmlspecialchars(stripcslashes(trim($_POST['host'])));

        $bannerPicture = '';

        // In case a picture was uploaded by the user
        if (!empty($_FILES['bannerPicture'])) {
            $bannerPicture = saveBanner();
        }

        // Getting the host
        $hostAux = User::getById($hostId);

        $eventAux = new Event($name, $description, $province, $locality, $terrainType, new DateTime($date), 
            $type, $hostAux, $bannerPicture
        );

        // Adding the host to the attendees
        $eventAux->setAttendees([$hostAux]);
        // Inserting the Event
        $eventAux->insert();

        // Updating the host's karma
        $hostAux->setKarma($hostAux->getKarma() + 4);

        header(HOME_PATH);
        exit();
    }

    /**
     * Method to delete an Event
     */
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

    /**
     * Method to subscribe the current user to an event
     */
    function subscribeEvent() {
        // Checking if there is an ID
        if (empty($_GET['id']) || !isset($_SESSION['userId'])) {
            header(HOME_PATH);
            exit();
        }

        $eventAux = Event::getById($_GET['id']);
        $userAux = User::getById($_SESSION['userId']);

        $eventAux->addAttendee($userAux);
        $userAux->setKarma($userAux->getKarma() + 3);

        header(HOME_PATH);
        exit();
    }

    /**
     * Method to unsubscribe the current user to an event
     */
    function unsubscribeEvent() {
        // Checking if there is an ID
        if (empty($_GET['id']) || !isset($_SESSION['userId'])) {
            header(HOME_PATH);
            exit();
        }

        $eventAux = Event::getById($_GET['id']);
        $userAux = User::getById($_SESSION['userId']);

        $eventAux->removeAttendee($userAux);
        $userAux->setKarma($userAux->getKarma() - 3);

        header(HOME_PATH);
        exit();
    }

    // Default action
    $action = 1;

    // Getting the action if it's in the URL
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        $action = $_GET['action'];
    } 

    // Switch to see which action is requestes
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
        case 5:
            subscribeEvent();
            break;
        case 6:
            unsubscribeEvent();
            break;
        default:
            // Displaying Home page
            header(HOME_PATH);
            break;
    }
?>