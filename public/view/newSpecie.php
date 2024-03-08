<?php
$pageTitle = "Add Specie";
include('header.php');
?>
<div class="container">
    <h1 class="my-4 text-center">Nueva especie</h1>
    <form action="../controller/SpeciesController.php?action=2" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="scientificName" class="form-label">Nombre científico</label>
            <input type="text" class="form-control" id="scientificName" name="scientificName" required>
        </div>

        <div class="mb-3">
            <label for="commonName" class="form-label">Nombre común:</label>
            <input type="text" class="form-control" id="commonName" name="commonName" required>
        </div>

        <div class="mb-3">
            <label for="climate" class="form-label">Clima:</label>
            <input type="text" class="form-control" id="climate" name="climate" required>
        </div>

        <div class="mb-3">
            <label for="region" class="form-label">Región:</label>
            <input type="text" class="form-control" id="region" name="region" required>
        </div>

        <div class="mb-3">
            <label for="daysToGrow" class="form-label">Días para creecer:</label>
            <input type="number" class="form-control" id="daysToGrow" name="daysToGrow" required>
        </div>

        <div class="mb-3">
            <label for="benefits" class="form-label">Beneficios:</label>
            <textarea class="form-control" id="benefits" name="benefits" required></textarea>
        </div>

        <div class="mb-3">
            <label for="picture" class="form-label">Imagen:</label>
            <input type="file" class="form-control" id="picture" name="picture" required accept="image/*">
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">URL:</label>
            <input type="text" class="form-control" id="url" name="url" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Añadir especie</button>
    </form>

</div>
<?php
include('footer.php');
?>
