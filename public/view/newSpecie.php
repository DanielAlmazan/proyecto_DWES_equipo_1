<?php
$pageTitle = "Add Specie";
include('header.php');
?>
<h1>New Specie</h1>
<form action="add_species.php" method="POST" enctype="multipart/form-data">
    <label for="scientific_name">Scientific Name:</label>
    <input type="text" id="scientific_name" name="scientific_name" required><br><br>

    <label for="common_name">Common Name:</label>
    <input type="text" id="common_name" name="common_name" required><br><br>

    <label for="climate">Climate:</label>
    <input type="text" id="climate" name="climate" required><br><br>

    <label for="region">Region:</label>
    <input type="text" id="region" name="region" required><br><br>

    <label for="days_to_grow">Days to Grow:</label>
    <input type="number" id="days_to_grow" name="days_to_grow" required><br><br>

    <label for="benefits">Benefits:</label><br>
    <textarea id="benefits" name="benefits" required></textarea><br><br>


    <label for="picture">Picture:</label>
    <input type="file" id="picture" name="picture" required accept="image/*"><br><br>

    <label for="url">URL:</label>
    <input type="text" id="url" name="url" required><br><br>

    <input type="submit" value="Add Specie">
</form>
<?php
include('footer.php');
?>
