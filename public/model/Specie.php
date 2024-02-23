<?php

    require_once dirname(__DIR__) . '/DB/ReforestaDB.php';
 

    class Specie {
        private int $id;
        private string $scientificName;
        private string $commonName;
        private string $climate;
        private string $region;
        private int $daysToGrow;
        private array $benefits;
        private string $picture;
        private string $url;

        public function __construct(
            int    $id,
            string $scientificName,
            string $commonName,
            string $climate,
            string $region,
            int    $daysToGrow,
            array  $benefits,
            string $picture,
            string $url) {
            $this->id = $id;
            $this->scientificName = $scientificName;
            $this->commonName = $commonName;
            $this->climate = $climate;
            $this->region = $region;
            $this->daysToGrow = $daysToGrow;
            $this->benefits = $benefits;
            $this->picture = $picture;
            $this->url = $url;
        }

        public function getId(): int {
            return $this->id;
        }

        public function getScientificName(): string {
            return $this->scientificName;
        }

        public function setScientificName(string $scientificName): void {
            $this->scientificName = $scientificName;
        }

        public function getCommonName(): string {
            return $this->commonName;
        }

        public function setCommonName(string $commonName): void {
            $this->commonName = $commonName;
        }

        public function getClimate(): string {
            return $this->climate;
        }

        public function setClimate(string $climate): void {
            $this->climate = $climate;
        }

        public function getRegion(): string {
            return $this->region;
        }

        public function setRegion(string $region): void {
            $this->region = $region;
        }

        public function getDaysToGrow(): int {
            return $this->daysToGrow;
        }

        public function setDaysToGrow(int $daysToGrow): void {
            $this->daysToGrow = $daysToGrow;
        }

        public function getBenefits(): array {
            return $this->benefits;
        }

        public function setBenefits(array $benefits): void {
            $this->benefits = $benefits;
        }

        public function getPicture(): string {
            return $this->picture;
        }

        public function setPicture(string $picture): void {
            $this->picture = $picture;
        }

        public function getUrl(): string {
            return $this->url;
        }

        public function setUrl(string $url): void {
            $this->url = $url;
        }

        public static function getSpecies():array {

            $db = ReforestaDB::connectDB();
          
        
            $sql = "SELECT * FROM species";
            $stmt = $db->query($sql);
            $species = [];
        
            while ($record = $stmt->fetchobject()) {
                $benefits = explode(',', $record->benefits);
                $species[] = new Specie($record->id, $record->scientificName, $record->commonName,
            $record->climate, $record->region, $record->daysToGrow, $record->$benefits,
            $record->picture, $record->url
                );
            }
            return $species;
        }

        public static function getSpecie(int $id): Specie {
            $db = ReforestaDB::connectDB();
            $sql = "SELECT * FROM species WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $record = $stmt->fetchObject();
            $benefits = explode(',', $record->benefits);
        
            return new Specie(
                $record->id, $record->scientificName, $record->commonName,
                $record->climate, $record->region, $record->daysToGrow, $benefits,
                $record->picture, $record->url
            );
        }
        
        public static function addSpecie(Specie $specie): void {
            $db = ReforestaDB::connectDB();
            $sql = "INSERT INTO species (scientificName, commonName, climate, region, daysToGrow, benefits, picture, url) VALUES (:scientificName, :commonName, :climate, :region, :daysToGrow, :benefits, :picture, :url)";
            $stmt = $db->prepare($sql);
            $benefits = implode(',', $specie->getBenefits()); 
            $stmt->bindParam(":scientificName", $specie->getScientificName());
            $stmt->bindParam(":commonName", $specie->getCommonName());
            $stmt->bindParam(":climate", $specie->getClimate());
            $stmt->bindParam(":region", $specie->getRegion());
            $stmt->bindParam(":daysToGrow", $specie->getDaysToGrow());
            $stmt->bindParam(":benefits", $benefits);
            $stmt->bindParam(":picture", $specie->getPicture());
            $stmt->bindParam(":url", $specie->getUrl());
            $stmt->execute();
        }
        
        public static function updateSpecie(Specie $specie): void {
            $db = ReforestaDB::connectDB();
            $sql = "UPDATE species SET scientificName=:scientificName, commonName=:commonName, climate=:climate, region=:region, daysToGrow=:daysToGrow, benefits=:benefits, picture=:picture, url=:url WHERE id=:id";
            $stmt = $db->prepare($sql);
            $benefits = implode(',', $specie->getBenefits()); 
            $stmt->bindParam(":scientificName", $specie->getScientificName());
            $stmt->bindParam(":commonName", $specie->getCommonName());
            $stmt->bindParam(":climate", $specie->getClimate());
            $stmt->bindParam(":region", $specie->getRegion());
            $stmt->bindParam(":daysToGrow", $specie->getDaysToGrow());
            $stmt->bindParam(":benefits", $benefits);
            $stmt->bindParam(":picture", $specie->getPicture());
            $stmt->bindParam(":url", $specie->getUrl());
            $stmt->bindParam(":id", $specie->getId(), PDO::PARAM_INT);
            $stmt->execute();
        }
        
        
        public static function deleteSpecie(int $id): void {
            $db = ReforestaDB::connectDB();
            $sql = "DELETE FROM species WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        
        
        
        
    }