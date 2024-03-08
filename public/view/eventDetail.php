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

    $pageTitle = "Detalle | " . $eventDetail->getName();
    require_once("header.php");
    
    // TODO: Logic to check if the current user is the host of the Event
    $isHost = true;
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
            <a href="" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <a href="<?= 'http://' . $_SERVER['SERVER_NAME'] . '/controller/EventController.php?action=3&id=' . $eventDetail->getId();?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
        <?php } ?>
    </div>

    <div class="detail-header-info">
        <p><i class="fa fa-calendar" aria-hidden="true"></i> <span>Fecha:</span> <?=$eventDetail->getDate()->format("d/m/Y ");?></p>
        <p><i class="fa fa-map-marker" aria-hidden="true"></i> <span>Lugar:</span> <?=$eventDetail->getProvince();?>, <?=$eventDetail->getLocality();?></p>
        <p><i class="fa fa-tag" aria-hidden="true"></i> <span>Tipo:</span> <?=$eventDetail->getType();?></p>
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
        <p><i class="fa fa-tag" aria-hidden="true"></i> <span>Tipo:</span> <?=$eventDetail->getType();?></p>
        <p><i class="fa fa-leaf" aria-hidden="true"></i> <span>Terreno:</span> <?=$eventDetail->getTerrainType();?></p>
        <p><i class="fa fa-user" aria-hidden="true"></i> <span>Anfitrión:</span> <?=$eventDetail->getHost()->getNickName();?></p>
        <p><i class="fa fa-tree" aria-hidden="true"></i> <span>Especies:</span> 
            <?php
                if (count($eventDetail->getSpecies()) == 0) {
                    echo 'No hay especies';
                } else {
                    foreach($eventDetail->getSpecies() as $specie) {
                        echo $specie->getName() . ', ';
                    }
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
                    echo '<li>' . $attendee->getName() . '</li>';
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