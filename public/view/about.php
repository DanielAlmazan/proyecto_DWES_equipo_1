<?php
    session_start();
	require_once("header.php");
?>

    <!-- Principal Content Start-->
    <div id="about">

        <!-- Header -->
        <div class="row">
            <div class="col-xs-12 intro">
                <div class="carousel-inner">
                    <div class="item active">
                        <img class="img-responsive" src="../res/images/reforesta.png" alt="header picture">
                    </div>
                    <div class="carousel-caption">
                        <h1>SOBRE NOSOTROS</h1>
                        <p>Toda nuestra info. Aquí y ahora.</p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of header -->

        <!-- Container Box -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="box-about">
                        <i class="fa fa-institution fa-2x"></i>
                        <h4>Nuestra misión</h4>
                        <p class="text-left text-muted">Llevar árboles a cada bosque en La Tierra.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="box-about">
                        <i class="fa fa-group fa-2x"></i>
                        <h4>Nuestro equipo</h4>
                        <p class="text-left text-muted">Los mejores. Los más capaces. Los más baratos.</p>
                    </div>
                </div>
            </div>

            <!-- Clients Feedback -->
            <div class="row feedback text-center">
                <h3>NUESTRO EQUIPO</h3>
                <hr>
                <div class="col-xs-12 col-sm-3">
                    <img class="img-responsive" src="../res/images/clients/client1.jpg" alt="client's picture">
                    <h5>LIAM – Desarrollador</h5>
                    <q>Y también MUY guapo.</q>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <img class="img-responsive" src="../res/images/avatars/analisto.png" alt="Foto de nuestro analisto">
                    <h5>DANI – Analisto</h5>
                    <q>Más listo que el hambre.</q>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <img class="img-responsive" src="../res/images/clients/client3.jpg" alt="client's picture">
                    <h5>CRISTIAN – Desarrollador también</h5>
                    <q>El más guapo de todos.</q>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <img class="img-responsive" src="../res/images/clients/client4.jpg" alt="client's picture">
                    <h5>MIKE – Colaborador</h5>
                    <q>Prácticamente un Dios griego.</q>
                </div>
            </div>
            <!-- End of Clients Feedback -->

        </div>
        <!-- End of container Box -->
    </div>
    <!-- End of principal content -->

<?php
	require_once('footer.php');
?>