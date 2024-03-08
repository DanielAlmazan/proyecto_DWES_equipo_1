<?php
require_once dirname(__DIR__) . '/model/Specie.php';
session_start();
include('header.php');
$species = Specie::getSpecies();
?>

<?php if(isset($_SESSION['admin'])) { ?>
    <a href="newSpecie.php" class="btn btn-primary mb-3">Nueva especie</a>
<?php } ?>


<section class="container">
    <h1 class="my-4 text-center">Listado de especies</h1>
    <div class="row">
        <?php foreach ($species as $specie) : ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img class="card-img-top" src="../res/images/species/<?= $specie->getPicture(); ?>" alt="Imagen de <?= $specie->getCommonName(); ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $specie->getCommonName(); ?></h5>
                        <p class="card-text">Scientific Name: <?= $specie->getScientificName(); ?></p>
                        <a href="specieDetail.php?id=<?= $specie->getId(); ?>" class="btn btn-primary">Ver</a>
                        <?php if(isset($_SESSION['admin'])) { ?>
                        <a href="../controller/SpeciesController.php?action=4&id=<?= $specie->getId(); ?>" class="btn btn-danger">Borrar</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
include('footer.php');
?>
