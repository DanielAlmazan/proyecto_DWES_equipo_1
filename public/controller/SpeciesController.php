<?php

require "./model/Specie.php";

class SpeciesController {



    public function showSpecies()
    {
        $species=Specie::getSpecies();
        require VIEWS_PATH . '/home.php';

    }


    public function showSpecie($id)
    {
        $specie=Specie::getSpecie($id);
    }


}
