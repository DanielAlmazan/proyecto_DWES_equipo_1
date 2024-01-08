<?php
    require_once("header.php");
    require_once("../model/Event.php");
    require_once("../model/User.php");
    // TODO: Implement sessions functionality
    $loggedIn = true;

    // TODO: Fetch user from database
    $user = new User(2, "Anaclet", "McJohnson", "anaclet@mc.johnson", "Anacletus", "123", "Anaclet's Avatar");
    $user->setKarma(3);
    //TODO: Load events
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
                // TODO: Fetch events from database
                $events = [
                    new Event(1, "Event 1", "Description", "Province", "Locality", "Terrain type", new DateTime(), "Type", "Banner picture"),
                    new Event(2, "Event 2", "Description", "Province", "Locality", "Terrain type", new DateTime(), "Type", "Banner picture"),
                ];
                foreach ($events as $event) {
                    ?>
                    <div class="event">
                        <h2><?= $event->getName() ?></h2>
                        <h3><?= $event->getDescription() ?></h3>
                        <p><?= $event->getBannerPicture() ?></p>
                        <p><small><?= $event->getLocality() ?></small></p>
                        <?php
                            if ($loggedIn) {
                                // TODO: Call some kind of "joinToEvent" method
                                ?>
                                <form action="#">
                                    <input type="submit" value="Join Event" id="btnJoinEvent">
                                </form>
                                <?php
                            }
                        ?>
                    </div>
                    <?php
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
                </div>
            </div>
        </form>
    </div>
    <!-- End of Newsletter form -->
</div><!-- End of index box -->
<?php
    require_once('footer.php');
?>
