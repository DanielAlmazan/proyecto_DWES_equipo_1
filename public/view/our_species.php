<?php
	session_start();
    include('header.php');
    $species=[];
?>
    <section class="speciesContainer">
        <h1>Summary</h1>
        <?php foreach ($species as $specie) : ?>
            <article class="specieInfo">
                <h3><?= $specie->getCommonName(); ?></h3>
                <p>Scientific Name: <?= $specie->getScientificName(); ?></p>
                <p>Climate: <?= $specie->getClimate(); ?></p>
                <p>Region: <?= $specie->getRegion(); ?></p>
                <p>Days to Grow: <?= $specie->getDaysToGrow(); ?></p>
                <img src="<?= $specie->getPicture(); ?>" alt="Species Image">
                <p>Benefits:</p>
                <ul>
                    <?php foreach ($specie->getBenefits() as $benefit) : ?>
                        <li><?= $benefit; ?></li>
                    <?php endforeach; ?>
                </ul>
                <p><a href="<?= $specie->getUrl(); ?>" target="_blank">Learn more about</a></p>
            </article>
        <?php endforeach; ?>
    </section>

    <?php
        include('footer.php');
    ?>

