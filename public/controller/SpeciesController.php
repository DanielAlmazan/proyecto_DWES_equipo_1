<?php

use Specie;
use DB\ReforestaDB;

class SpeciesController {

    private array $species;

    public function __construct() {
        
    }

     function getSpeciesList() {
        $species=Specie::getSpecies();
        require_once dirname(__DIR__).'/view/our_species.php';
        
    }


}
