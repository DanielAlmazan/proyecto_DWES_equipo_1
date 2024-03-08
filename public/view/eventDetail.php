<?php
	session_start();
    require_once dirname(__DIR__) . '/model/User.php';
    require_once dirname(__DIR__) . '/model/Event.php';

    // Checking if there is an id on the URI parameters and if it's a number
    if (empty($_GET['id']) || filter_var($_GET['id'], FILTER_VALIDATE_INT) === false) {
        header('Location: http://' . $_SERVER['SERVER_NAME'] . '/index.php');
        exit();
    }

    // Getting the event
    $eventDetail = Event::getById($_GET['id']);

    // If the event is null (It's not on the DB), we redirect
    if ($eventDetail == null) {
        header('Location: http://' . $_SERVER['SERVER_NAME'] . '/index.php');
        exit();
    }
    
    // Variable to know if the current user is the host of the event
    $isHost = isset($_SESSION['userId']) && $eventDetail->getHost()->getId() == $_SESSION['userId'];

    // Checking if the current user is an atendee
    $attendeeIds = array_map(function($attendee) {
        return $attendee->getId();
    }, $eventDetail->getAttendees());

    $isAttendee = isset($_SESSION['userId']) && ($isHost || in_array($_SESSION['userId'], $attendeeIds));

    // Link to the user profile of the Host
    $hostLink = 'http://' . $_SERVER['SERVER_NAME'] . '/view/user.php' .
     ($isHost ? '' : '?user=' . $eventDetail->getHost()->getId());

    // Title of the page
    $pageTitle = "Detalle | " . $eventDetail->getName();
    require_once("header.php");
?>

<div 
    class="detail-header" 
    <?php if(!empty($eventDetail->getBannerPicture())) { ?>
        style="background-image: url('../res/images/events/<?=$eventDetail->getBannerPicture();?>'); background-repeat: no-repeat; background-size: cover;"
    <?php } else { ?>
        style="background-image: url('../res/images/events/default.png'); background-repeat: no-repeat; background-size: cover;"
    <?php } ?>
>
    <div class="detail-header-title">
        <h1><?=$eventDetail->getName();?></h1>

        <?php if ($isHost) { ?>
            <a href="<?= 'http://' . $_SERVER['SERVER_NAME'] . '/controller/EventController.php?action=3&id=' . $eventDetail->getId();?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
        <?php } else if (!$isAttendee) { ?>
            <a href="<?= 'http://' . $_SERVER['SERVER_NAME'] . '/controller/EventController.php?action=5&id=' . $eventDetail->getId();?>" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Inscribirse</a>
        <?php } else if ($isAttendee && !$isHost) { ?>
            <a href="<?= 'http://' . $_SERVER['SERVER_NAME'] . '/controller/EventController.php?action=6&id=' . $eventDetail->getId();?>" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i> Desuscribirse</a>
        <?php } ?>

    </div>

    <div class="detail-header-info">
        <p><i class="fa fa-calendar" aria-hidden="true"></i> <span>Fecha:</span> <?=$eventDetail->getDate()->format("d/m/Y ");?></p>
        <p><i class="fa fa-map-marker" aria-hidden="true"></i> <span>Lugar:</span> <?=$eventDetail->getProvince();?>, <?=$eventDetail->getLocality();?></p>
        <p><i class="fa fa-tag" aria-hidden="true"></i> <span>Tipo:</span> <?=Event::$eventTypes[$eventDetail->getType()];?></p>
        <?php
            if ($eventDetail->isPending()) {
                echo '<p class="label label-default">Pendiente de aprobar</p>';
            } else {
                if ($eventDetail->isApproved()) {
                    echo '<p class="label label-success">Aprobado</p>';
                } else {
                    echo '<p class="label label-warning">Cancelado</p>';
                }
            }
        ?>
    </div>
</div>

<main class="detail-main">
    <div class="detail-desc">
        <h2>Descripción</h2>
        <p><?=$eventDetail->getDescription();?></p>
    </div>

    <aside class="detail-info">
        <h2><i class="fa fa-info-circle" aria-hidden="true"></i> Información</h2>
        <p><i class="fa fa-calendar" aria-hidden="true"></i> <span>Fecha:</span> <?=$eventDetail->getDate()->format("d/m/Y ");?></p>
        <p><i class="fa fa-map-marker" aria-hidden="true"></i> <span>Lugar:</span> <?=$eventDetail->getProvince();?>, <?=$eventDetail->getLocality();?></p>
        <p><i class="fa fa-tag" aria-hidden="true"></i> <span>Tipo:</span> <?=Event::$eventTypes[$eventDetail->getType()];?></p>
        <p><i class="fa fa-leaf" aria-hidden="true"></i> <span>Terreno:</span> <?=$eventDetail->getTerrainType();?></p>
        <p>
            <i class="fa fa-user" aria-hidden="true"></i> 
            <span>Anfitrión:</span> 
            <a href="<?=$hostLink;?>"><?=$eventDetail->getHost()->getNickName();?></a>
        </p>
        <p><i class="fa fa-tree" aria-hidden="true"></i> <span>Especies:</span> 
            <?php
                if (count($eventDetail->getSpecies()) == 0) {
                    echo 'No hay especies';
                } else {
                    $speciesNames = array_map(function($specie) {
                        return $specie->getCommonName();
                    }, $eventDetail->getSpecies());

                    echo implode(', ', $speciesNames);
                }
            ?>
        </p>
    </aside>

    <div class="detail-attendees">
        <h2><i class="fa fa-users" aria-hidden="true"></i> Asistentes</h2>
        
        <?php
            if (count($eventDetail->getAttendees()) == 0) {
                echo '<p>Aún no hay asistentes</p>';
            } else {
        ?>
            <ul>
            <?php
                foreach($eventDetail->getAttendees() as $attendee) {
                    echo '<li>' . $attendee->getNickName() . ' (' . $attendee->getName() . ')</li>';
                }
            ?>
            </ul>
        <?php
            }
        ?>
    </div>
</main>

<?php
    require_once('footer.php');
?>