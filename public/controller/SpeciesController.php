<?php

require_once dirname(__DIR__) . '/model/Specie.php';

function uploadImage($picture): string
{
    $target_dir = dirname(__DIR__) . '/res/images/species/';
    // Asignamos un id unico para no sobreescribir fotos con el mismo nombre
    $timestamp = time();
    $nameFile = $timestamp . "-" . basename($picture["name"]);
    $target_file = $target_dir . $nameFile;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen
    $check = getimagesize($picture["tmp_name"]);
    if ($check === false) {
        return "El archivo no es una imagen.";
    }

    // Verificar si el archivo ya existe
    if (file_exists($target_file)) {
        return "El archivo ya existe.";
    }

    // Verificar el tamaño del archivo
    if ($picture["size"] > 500000) {
        return "El archivo es demasiado grande.";
    }

    // Permitir ciertos formatos de archivo
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        return "Solo se permiten archivos JPG, JPEG, PNG.";
    }

    // Intentar subir el archivo
    if (move_uploaded_file($picture["tmp_name"], $target_file)) {
        return $nameFile;
    } else {
        return "Hubo un error al subir tu archivo.";
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
    $benefits = explode(',', $_POST['benefits']);
    $url = $_POST['url'];

    $specieToUpdate = Specie::getSpecie($id);

    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $picture = uploadImage($_FILES['picture']);
    } else {
        $picture = $specieToUpdate->getPicture(); // Use the existing picture if no new picture is uploaded
    }

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
        header('Location:http://' . $_SERVER['SERVER_NAME'] . '/view/our_species.php');
        break;
    //update specie
    case "3":
        updateSpecie();
        header('Location:http://' . $_SERVER['SERVER_NAME'] . '/view/our_species.php');
        break;
    //delete specie
    case "4":
        deleteSpecie();
        header('Location:http://' . $_SERVER['SERVER_NAME'] . '/view/our_species.php');
        break;
    //show all species
    default:
        $species = Specie::getSpecies();
        require_once dirname(__DIR__) . '/view/our_species.php';
}
?>
