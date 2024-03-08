<?php
require_once dirname(__DIR__) . '/model/Specie.php';
$pageTitle = isset($_GET['id']) ? "Editar especie" : "Nueva especie";
include('header.php');

if (isset($_GET['id'])) {
    $specie = Specie::getSpecie($_GET['id']);
}

$action = isset($specie) ? "../controller/SpeciesController.php?action=3&id=" . $specie->getId() : "../controller/SpeciesController.php?action=2";
?>
<div class="container">
    <h1 class="my-4 text-center"><?= $pageTitle ?></h1>
    <form action="<?= $action ?>" method="POST" enctype="multipart/form-data">
        <?php if (isset($specie)): ?>
            <input type="hidden" name="id" value="<?= $specie->getId() ?>">
        <?php endif; ?>
        <div class="mb-3">
            <label for="scientificName" class="form-label">Nombre científico</label>
            <input type="text" class="form-control" id="scientificName" name="scientificName" required value="<?= isset($specie) ? $specie->getScientificName() : '' ?>" placeholder="Introduce el nombre científico">
        </div>

        <div class="mb-3">
            <label for="commonName" class="form-label">Nombre común:</label>
            <input type="text" class="form-control" id="commonName" name="commonName" required value="<?= isset($specie) ? $specie->getCommonName() : '' ?>" placeholder="Introduce el nombre común">
        </div>

        <div class="mb-3">
            <label for="climate" class="form-label">Clima:</label>
            <input type="text" class="form-control" id="climate" name="climate" required value="<?= isset($specie) ? $specie->getClimate() : '' ?>" placeholder="Introduce el clima">
        </div>

        <div class="mb-3">
            <label for="region" class="form-label">Región:</label>
            <input type="text" class="form-control" id="region" name="region" required value="<?= isset($specie) ? $specie->getRegion() : '' ?>" placeholder="Introduce la región">
        </div>

        <div class="mb-3">
            <label for="daysToGrow" class="form-label">Días para creecer:</label>
            <input type="number" class="form-control" id="daysToGrow" name="daysToGrow" required value="<?= isset($specie) ? $specie->getDaysToGrow() : '' ?>" placeholder="Introduce los días para crecer">
        </div>

        <div class="mb-3">
            <label for="benefits" class="form-label">Beneficios:</label>
            <textarea class="form-control" id="benefits" name="benefits" required placeholder="Introduce los beneficios"><?= isset($specie) ? implode(',', $specie->getBenefits()) : '' ?></textarea>
        </div>

        <div class="mb-3">
            <label for="picture" class="form-label">Imagen:</label>
            <input type="file" class="form-control" id="picture" name="picture" <?= isset($specie) ? '' : 'required' ?> accept="image/*">
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">URL:</label>
            <input type="text" class="form-control" id="url" name="url" required value="<?= isset($specie) ? $specie->getUrl() : '' ?>" placeholder="Introduce la URL">
        </div>
        <br>
        <button type="submit" class="btn btn-primary"><?= isset($specie) ? 'Actualizar especie' : 'Añadir especie' ?></button>
    </form>
</div>
<?php
include('footer.php');
?>
