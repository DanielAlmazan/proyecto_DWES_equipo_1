<?php
require_once dirname(__DIR__) . '/DB/ReforestaDB.php';
require_once dirname(__DIR__) . '/model/Specie.php';

function uploadImage($picture): string
{
    $target_dir = dirname(__DIR__) . '/res/images/species/';
    $target_file = $target_dir . basename($picture["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an image
    $check = getimagesize($picture["tmp_name"]);
    if ($check === false) {
        return "File is not an image.";
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        return "File already exists.";
    }

    // Check file size
    if ($picture["size"] > 500000) {
        return "File is too large.";
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        return "Only JPG, JPEG, PNG  files are allowed.";
    }

    // Try to upload file
    if (move_uploaded_file($picture["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        return "There was an error uploading your file.";
    }
}

function sanitizeInput($input): string
{
    $input = trim($input);
    return htmlspecialchars($input);
}


function addSpecie()
{
    $scientificName = sanitizeInput($_POST['scientificName']);
    $commonName = sanitizeInput($_POST['commonName']);
    $climate = sanitizeInput($_POST['climate']);
    $region = sanitizeInput($_POST['region']);
    $daysToGrow = sanitizeInput($_POST['daysToGrow']);
    $benefits = explode(',', sanitizeInput($_POST['benefits']));
    $picture = uploadImage($_FILES['picture']);
    $url = sanitizeInput($_POST['url']);

    $newSpecie = new Specie(0, $scientificName, $commonName, $climate, $region, $daysToGrow, $benefits, $picture, $url);
    $newSpecie->addSpecie();

}



function updateSpecie()
{
    // Recoge los datos del formulario
    $id = $_POST['id'];
    $scientificName = $_POST['scientificName'];
    $commonName = $_POST['commonName'];
    $climate = $_POST['climate'];
    $region = $_POST['region'];
    $daysToGrow = $_POST['daysToGrow'];
    $benefits = $_POST['benefits'];
    $picture = uploadImage($_FILES['picture']);
    $url = $_POST['url'];


    $specieToUpdate = Specie::getSpecie($id);

    $specieToUpdate->setScientificName($scientificName);
    $specieToUpdate->setCommonName($commonName);
    $specieToUpdate->setClimate($climate);
    $specieToUpdate->setRegion($region);
    $specieToUpdate->setDaysToGrow($daysToGrow);
    $specieToUpdate->setBenefits($benefits);
    $specieToUpdate->setPicture($picture);
    $specieToUpdate->setUrl($url);

    $specieToUpdate->updateSpecie();
}

function deleteSpecie()
{
    $specieAux = Specie::getSpecie($_GET['id']);
    $specieAux->deleteSpecie();
}


$action = !empty($_GET['action']) ? $_GET['action'] : 1;

switch ($action) {
    //add specie
    case "2":
        addSpecie();
        header('Location:http://' . $_SERVER['SERVER_NAME'] . '/index.php');
        break;
    //update specie
    case "3":
        updateSpecie();
        header('Location:http://' . $_SERVER['SERVER_NAME'] . '/index.php');
        break;
    //delete specie
    case "4":
        deleteSpecie();
        header('Location:http://' . $_SERVER['SERVER_NAME'] . '/index.php');
        break;
    //show all species
    default:
        $species = Specie::getSpecies();
        require_once dirname(__DIR__) . '/view/our_species.php';
}
