<?php
    require_once dirname(__DIR__) . '/model/Event.php';
    session_start();

    // Getting the current User, if the user isn't logged in we redirect
    $idUser = null;
    if(isset($_SESSION['userId'])) {
        $idUser = $_SESSION['userId'];
    } else {
        header('Location: http://' . $_SERVER['SERVER_NAME'] . '/index.php');
    }

    // The title of the page
    $pageTitle = "Add Event";
    require_once("header.php");
?>
<main>
    <form enctype="multipart/form-data" action="<?= 'http://' . $_SERVER['SERVER_NAME'] . '/controller/EventController.php?action=4'?>" method="post">
        <input type="hidden" name="host" value="<?=$idUser?>">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del evento..." required minlength="3" maxlength="255">
        </div>
        <div class="form-group">
            <label for="date">Fecha</label>
            <input type="date" class="form-control" id="date" name="date" required> 
        </div>
        <div class="form-inline">
            <div class="form-group">
                <label for="province">Provincia</label>
                <input type="text" class="form-control" id="province" name="province" placeholder="Provincia..." required maxlength="255">
            </div>
            <div class="form-group">
                <label for="locality">Ciudad</label>
                <input type="text" class="form-control" id="locality" name="locality" placeholder="Ciudad..." required maxlength="255">
            </div>
            <div class="form-group">
                <label for="terrainType">Tipo de terreno</label>
                <input type="text" class="form-control" id="terrainType" name="terrainType" placeholder="Tipo de terreno..." maxlength="255">
            </div>
            <div class="form-group">
                <label for="type">Tipo</label>
                <select class="form-control" name="type" required>
                    <option selected disabled>Escoge un tipo...</option>
                    <?php foreach(Event::$eventTypes as $key => $value) { ?>
                        <option value="<?=$key;?>"><?=$value;?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" rows="3" name="description" id="description" maxlength="255"></textarea>
        </div>
        <div class="form-group">
            <label for="bannerPicture">Imagen de cabecera</label>
            <input type="file" class="form-control" id="bannerPicture" name="bannerPicture">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</main>

<?php
    require_once('footer.php');
?>