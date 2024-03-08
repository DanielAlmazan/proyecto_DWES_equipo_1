<?php
$pageTitle = "Add Specie";
include('header.php');
?>
<div class="container">
    <h1 class="my-4 text-center">New Specie</h1>
    <form action="../controller/SpeciesController.php?action=2" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="scientificName" class="form-label">Scientific Name:</label>
            <input type="text" class="form-control" id="scientificName" name="scientificName" required>
        </div>

        <div class="mb-3">
            <label for="commonName" class="form-label">Common Name:</label>
            <input type="text" class="form-control" id="commonName" name="commonName" required>
        </div>

        <div class="mb-3">
            <label for="climate" class="form-label">Climate:</label>
            <input type="text" class="form-control" id="climate" name="climate" required>
        </div>

        <div class="mb-3">
            <label for="region" class="form-label">Region:</label>
            <input type="text" class="form-control" id="region" name="region" required>
        </div>

        <div class="mb-3">
            <label for="daysToGrow" class="form-label">Days to Grow:</label>
            <input type="number" class="form-control" id="daysToGrow" name="daysToGrow" required>
        </div>

        <div class="mb-3">
            <label for="benefits" class="form-label">Benefits:</label>
            <textarea class="form-control" id="benefits" name="benefits" required></textarea>
        </div>

        <div class="mb-3">
            <label for="picture" class="form-label">Picture:</label>
            <input type="file" class="form-control" id="picture" name="picture" required accept="image/*">
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">URL:</label>
            <input type="text" class="form-control" id="url" name="url" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Add Specie</button>
    </form>

</div>
<?php
include('footer.php');
?>
