<?php
	session_start();
    require_once("header.php");
    require_once dirname(__DIR__) . '/model/Event.php';
    require_once dirname(__DIR__) . '/model/User.php';
    require_once dirname(__DIR__) . '/model/Specie.php';
    // TODO: Implement sessions functionality
    $loggedIn = true;

    // TODO: Fetch user from database
    // $user = new User(2, "Anaclet", "McJohnson", "anaclet@mc.johnson", "Anacletus", "123", "Anaclet's Avatar");
    // $user->setKarma(3);
    //TODO: Load events

    // Loading the events
    $events = empty($_GET['search']) ? Event::getAll() : Event::getByName($_GET['search']);
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
        <h3>SUSCRIBE TO OUR NEWSLETTER </h3>
        <h5>Suscribe to receive our News and Gifts</h5>
        <form class="form-horizontal">
            <div class="form-group">
                <div class="col-xs-12 col-sm-6 col-sm-push-3 col-md-4 col-md-push-4">
                    <input class="form-control" type="text" placeholder="Type here your email address">
                    <a href="" class="btn btn-lg sr-button">SUBSCRIBE</a>
                    <p id="alreadySub" class="d-none">This email is already subscribed</p>
                </div>
            </div>
        </form>
    </div>
    <!-- End of Newsletter form -->
</div><!-- End of index box -->
<?php
    require_once('footer.php');
?>
