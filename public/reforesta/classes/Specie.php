<?php

class Specie
{
    private int $id;
    private string $scientificName;
    private string $commonName;
    private string $climate;
    private string $region;
    private int $daysToGrow;
    private array $benefits=array();
    private string $picture;
    private string $url;

    public function __construct(
        int $id, string $scientificName,
        string $commonName, string $climate,
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

    public function getId(): int
    {
        return $this->id;
    }

    public function getScientificName(): string
    {
        return $this->scientificName;
    }

    public function getCommonName(): string
    {
        return $this->commonName;
    }

    public function getClimate(): string
    {
        return $this->climate;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getDaysToGrow(): int
    {
        return $this->daysToGrow;
    }

    public function getBenefits(): array
    {
        return $this->benefits;
    }

    public function getPicture(): string
    {
        return $this->picture;
    }

    public function getUrl(): string
    {
        return $this->url;
    }



}