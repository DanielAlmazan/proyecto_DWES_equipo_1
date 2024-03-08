<?php
require_once dirname(__DIR__) . '/model/Specie.php';
session_start();
include('header.php');
$species = Specie::getSpecies();
?>

<a href="newSpecie.php" class="btn btn-primary mb-3">New Specie</a>
<section class="container">
    <h1 class="my-4 text-center">Species List</h1>
    <div class="row">
        <?php foreach ($species as $specie) : ?>
            <div class="col-md-4 specieCard">
                <div class="card mb-4">
                    <img class="card-img-top" src="../res/images/species/<?= $specie->getPicture(); ?>" alt="Species Image" style="height: 200px; object-fit: cover;"> <!-- Añadimos estilo aquí -->
                    <div class="card-body">
                        <h5 class="card-title"><?= $specie->getCommonName(); ?></h5>
                        <p class="card-text">Scientific Name: <?= $specie->getScientificName(); ?></p>
                        <a href="specieDetail.php?id=<?= $specie->getId(); ?>" class="btn btn-primary">View more</a>
                        <a href="../controller/SpeciesController.php?action=4&id=<?= $specie->getId(); ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
include('footer.php');
?>
