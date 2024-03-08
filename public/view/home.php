<?php
	session_start();
    require_once("header.php");
    require_once dirname(__DIR__) . '/model/Event.php';
    require_once dirname(__DIR__) . '/model/User.php';
    require_once dirname(__DIR__) . '/model/Specie.php';
    
    $loggedIn = false;
    if(isset($_SESSION['userId'])) {
        $user = User::getById($_SESSION['userId']);
        $loggedIn = true;
    }

    // Loading the events
    $events = empty($_GET['search']) ? Event::getAll() : Event::getByName($_GET['search']);

    if(isset($_POST['submit'])) {
        if(empty($_POST['emailNewsletter'])) {
            echo "<p class='alert alert-danger'>Debes introducir un correo</p>";
        } else {
            if(User::suscribeNewsletter($_POST['emailNewsletter'])) {
                echo "<p class='alert alert-success'>¡Te has suscrito correctamente!</p>";
            }
        }
    }
?>

<!-- Principal Content Start -->
<div id="index">
    
    <!-- Header -->
    <div class="row">
        <div class="col-xs-12 intro">
            <div class="carousel-inner">
                <div class="item active">
                    <img class="img-responsive" src="../res/images/reforesta.png" alt="header picture">
                </div>
            </div>
        </div>
    </div>

    <form action="#" method="get">
        <div class="col-lg-6">
            <div class="input-group">
                <input 
                    type="text" 
                    class="form-control" 
                    name="search" 
                    placeholder="Buscar por nombre..."
                    <?php 
                        if (!empty($_GET['search'])) { 
                            echo 'value="' . $_GET['search'] . '"';
                        }
                    ?>
                >
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </span>
            </div>
        </div>
    </form>
    
    <main>
        <h2>Events 
            <?php if($loggedIn) { ?>
                <a href="<?= 'http://' . $_SERVER['SERVER_NAME'] . '/view/newEvent.php'?>" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Añadir</a></h2>
            <?php } ?>
        <div id="eventsContainer">
            <?php
                // Showing all the events
                foreach ($events as $event) {
                    $event->showCard($loggedIn);
                }

                // Printing a message in case there are no events
                if (count($events) == 0) {
                    echo "<p>No hay eventos! :(</p>";
                }
            ?>
        </div>
    </main>
    
    <!-- Newsletter form -->
    <div class="index-form text-center">
        <h3>SUSCRIBETE A NUESTRO NEWSLETTER </h3>
        <h5>Suscribete para recibir nuestras noticias y regalos</h5>
        <form class="form-horizontal" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
            <div class="form-group">
                <div class="col-xs-12 col-sm-6 col-sm-push-3 col-md-4 col-md-push-4">
                    <input class="form-control" type="text" placeholder="Introduce tu email..." name="emailNewsletter">
                    <button type="submit" name="submit" class="btn btn-lg sr-button">SUSCRIBIRSE</button>
                    <a href="unsuscribeNewseltter.php" class="btn btn-lg sr-button">DESUSCRIBIRSE</a>
                </div>
            </div>
        </form>
    </div>
    <!-- End of Newsletter form -->
</div>
<!-- End of index box -->
<?php
    require_once('footer.php');
?>
