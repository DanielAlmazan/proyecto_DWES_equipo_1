<?php

    require_once("header.php");
    require_once dirname(__DIR__) . '/model/Event.php';
    require_once dirname(__DIR__) . '/model/User.php';
    // TODO: Implement sessions functionality
    $loggedIn = true;

    // TODO: Fetch user from database
    // $user = new User(2, "Anaclet", "McJohnson", "anaclet@mc.johnson", "Anacletus", "123", "Anaclet's Avatar");
    // $user->setKarma(3);
    //TODO: Load events

    $events = Event::getAll();
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
    
    <main>
        <h2>Events</h2>
        <div id="eventsContainer">
            <?php
                // $events = [
                //    new Event("Event 1", "Description", "Province", "Locality", "Terrain type", new DateTime(), "Type", $user, "oak.png"),
                //     new Event("Event 2", "Description", "Province", "Locality", "Terrain type", new DateTime(), "Type", $user, "juniper.png"),
                // ];
                foreach ($events as $event) {
                    $event->showCard($loggedIn);
                }

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
