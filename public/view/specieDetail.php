<?php
require_once dirname(__DIR__) . '/model/Specie.php';
$pageTitle = "Specie Detail";

$specieDetail = Specie::getSpecie($_GET['id']);
include('header.php');
?>

<div class="container mt-5">
    <h1 class="my-4 text-center">Specie Profile: <?php echo $specieDetail->getCommonName(); ?></h1>
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="row no-gutters">
                <div class="col-md-4 d-flex align-items-center justify-content-center pr-3">
                    <img class="card-img-left" src="../res/images/species/<?= $specieDetail->getPicture(); ?>" alt="Species Image " style="height: 200px; object-fit: cover;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Scientific Name: <?php echo $specieDetail->getScientificName(); ?></h5>
                        <p class="card-text">Common Name: <?php echo $specieDetail->getCommonName(); ?></p>
                        <p class="card-text">Climate: <?php echo $specieDetail->getClimate(); ?></p>
                        <p class="card-text">Region: <?php echo $specieDetail->getRegion(); ?></p>
                        <p class="card-text">Days to Grow: <?php echo $specieDetail->getDaysToGrow(); ?></p>
                        <p class="card-text">Benefits: <?php echo implode(', ', $specieDetail->getBenefits()); ?></p>
                        <a href="<?php echo $specieDetail->getUrl(); ?>" class="btn btn-primary">Learn more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>
