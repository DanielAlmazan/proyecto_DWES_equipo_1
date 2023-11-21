<?php

class Specie
{
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
        int $id,
        string $scientificName,
        string $commonName,
        string $climate,
        string $region,
        int $daysToGrow,
        array $benefits,
        string $picture,
        string $url)
    {
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

    public function __get(string $field){
        switch ($field){
            case "id":
                return $this->id;
            case "scientificName":
                return $this->scientificName;
            case "commonName":
                return $this->commonName;
            case "climate":
                return $this->climate;
            case "region":
                return $this->region;
            case "daysToGrow":
                return $this->daysToGrow;
            case "benefits":
                return $this->benefits;
            case "picture":
                return $this->picture;
            case "url":
                return $this->url;
            default:
                return "Error";
        }
    }


}