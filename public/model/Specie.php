<?php

require_once dirname(__DIR__) . '/DB/ReforestaDB.php';


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
        int    $id,
        string $scientificName,
        string $commonName,
        string $climate,
        string $region,
        int    $daysToGrow,
        array  $benefits,
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

    public function setScientificName(string $scientificName): void
    {
        $this->scientificName = $scientificName;
    }

    public function getCommonName(): string
    {
        return $this->commonName;
    }

    public function setCommonName(string $commonName): void
    {
        $this->commonName = $commonName;
    }

    public function getClimate(): string
    {
        return $this->climate;
    }

    public function setClimate(string $climate): void
    {
        $this->climate = $climate;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    public function getDaysToGrow(): int
    {
        return $this->daysToGrow;
    }

    public function setDaysToGrow(int $daysToGrow): void
    {
        $this->daysToGrow = $daysToGrow;
    }

    public function getBenefits(): array
    {
        return $this->benefits;
    }

    public function setBenefits(array $benefits): void
    {
        $this->benefits = $benefits;
    }

    public function getPicture(): string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    static function getSpecies(): array
    {
        $species = [];
        try {
            $pdo = ReforestaDB::connectDB();
            $sql = "SELECT * FROM species";
            $select = $pdo->prepare($sql);
            $select->execute();
            while ($specie = $select->fetch()) {
                $benefitsArray = explode(',', $specie->benefits);
                $species[] = new Specie(
                    $specie->id,
                    $specie->scientificName,
                    $specie->commonName,
                    $specie->climate,
                    $specie->region,
                    $specie->daysToGrow,
                    $benefitsArray,
                    $specie->picture,
                    $specie->url
                );
            }
        } catch (Exception $e) {
            echo "<p class='error'>" . $e->getMessage() . "</p>";
        } finally {
            $select = null;
            $pdo = null;
        }

        return $species;
    }


    public static function getSpecie(int $id): Specie
    {
        $specie = null;

        try {
            $pdo = ReforestaDB::connectDB();
            $sql = "SELECT * FROM species WHERE id=:id";
            $select = $pdo->prepare($sql);
            $select->bindParam(':id', $id, PDO::PARAM_INT);
            $select->execute();
            if ($specie = $select->fetch()) {
                $benefitsArray = explode(',', $specie['benefits']);

                $specie = new Specie(
                    $specie['id'],
                    $specie['scientificName'],
                    $specie['commonName'],
                    $specie['climate'],
                    $specie['region'],
                    $specie['daysToGrow'],
                    $benefitsArray,
                    $specie['picture'],
                    $specie['url']
                );
            }
        } catch (Exception $e) {
            echo "<p class='error'>" . $e->getMessage() . "</p>";
        } finally {
            $select = null;
            $pdo = null;
        }

        return $specie;
    }

    function addSpecie()
    {
        try {
            $pdo = ReforestaDB::connectDB();
            $sql = "INSERT INTO species (scientificName, commonName, climate, region, daysToGrow, benefits, picture, url) VALUES (:scientificName, :commonName, :climate, :region, :daysToGrow, :benefits, :picture, :url)";
            $insert = $pdo->prepare($sql);
            $insert->bindParam(':scientificName', $this->scientificName);
            $insert->bindParam(':commonName', $this->commonName);
            $insert->bindParam(':climate', $this->climate);
            $insert->bindParam(':region', $this->region);
            $insert->bindParam(':daysToGrow', $this->daysToGrow, PDO::PARAM_INT);
            $insert->bindParam(':benefits', $this->benefits);
            $insert->bindParam(':picture', $this->picture);
            $insert->bindParam(':url', $this->url);
            $insert->execute();
        } catch (Exception $e) {
            echo "<p class='error'>" . $e->getMessage() . "</p>";
        } finally {
            $insert = null;
            $pdo = null;
        }
    }


    function updateSpecie()
    {
        try {
            $pdo = ReforestaDB::connectDB();
            $sql = "UPDATE species SET scientificName = :scientificName, commonName = :commonName, climate = :climate, region = :region, daysToGrow = :daysToGrow, benefits = :benefits, picture = :picture, url = :url WHERE id = :id";
            $update = $pdo->prepare($sql);
            $update->bindParam(':id', $this->id, PDO::PARAM_INT);
            $update->bindParam(':scientificName', $this->scientificName);
            $update->bindParam(':commonName', $this->commonName);
            $update->bindParam(':climate', $this->climate);
            $update->bindParam(':region', $this->region);
            $update->bindParam(':daysToGrow', $this->daysToGrow, PDO::PARAM_INT);
            $update->bindParam(':benefits', $this->benefits);
            $update->bindParam(':picture', $this->picture);
            $update->bindParam(':url', $this->url);
            $update->execute();
        } catch (Exception $e) {
            echo "<p class='error'>" . $e->getMessage() . "</p>";
        } finally {
            $update = null;
            $pdo = null;
        }
    }

    function deleteSpecie()
    {
        try {
            $pdo = ReforestaDB::connectDB();
            $sql = "DELETE FROM species WHERE id = :id";
            $delete = $pdo->prepare($sql);
            $delete->bindParam(':id', $this->id, PDO::PARAM_INT);
            $delete->execute();
        } catch (Exception $e) {
            echo "<p class='error'>" . $e->getMessage() . "</p>";
        } finally {
            $delete = null;
            $pdo = null;
        }
    }


}