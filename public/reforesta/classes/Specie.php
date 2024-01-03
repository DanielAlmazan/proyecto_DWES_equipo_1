<?php

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
    }