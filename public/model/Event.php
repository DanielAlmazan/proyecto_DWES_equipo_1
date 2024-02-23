<?php

    require_once dirname(__DIR__) . '/DB/ReforestaDB.php';

    class Event {
        private int $id;
        private string $name;
        private string $description;
        private string $province;
        private string $locality;
        private string $terrainType;
        private DateTime $date;
        private string $type;
        private User $host;
        private string $bannerPicture;
        private bool $pending;
        private bool $approved;
        private array $attendees;
        private array $species;

        public function __construct(string $name, string $description, string $province,
            string $locality, string $terrainType, DateTime $date, string $type, 
            User $host, string $bannerPicture, int $id = null) {
            $this->name = $name;
            $this->description = $description;
            $this->province = $province;
            $this->locality = $locality;
            $this->terrainType = $terrainType;
            $this->date = $date;
            $this->type = $type;
            $this->host = $host;
            $this->bannerPicture = $bannerPicture;
            $this->pending = true;
            $this->approved = false;

            if ($id != null) {
                $this->id = $id;
            }
        }

        public function getId(): int {
            return $this->id;
        }

        public function getName(): string {
            return $this->name;
        }

        public function setName(string $name): void {
            $this->name = $name;
        }

        public function getDescription(): string {
            return $this->description;
        }

        public function setDescription(string $description): void {
            $this->description = $description;
        }

        public function getProvince(): string {
            return $this->province;
        }

        public function setProvince(string $province): void {
            $this->province = $province;
        }

        public function getLocality(): string {
            return $this->locality;
        }

        public function setLocality(string $locality): void {
            $this->locality = $locality;
        }

        public function getTerrainType(): string {
            return $this->terrainType;
        }

        public function setTerrainType(string $terrainType): void {
            $this->terrainType = $terrainType;
        }

        public function getDate(): DateTime {
            return $this->date;
        }

        public function setDate(DateTime $date): void {
            $this->date = $date;
        }

        public function getType(): string {
            return $this->type;
        }

        public function setType(string $type): void {
            $this->type = $type;
        }

        public function getHost(): User {
            return $this->host;
        }

        public function setHost(User $host): void {
            $this->host = $host;
        }

        public function getBannerPicture(): string {
            return $this->bannerPicture;
        }

        public function setBannerPicture(string $bannerPicture): void {
            $this->bannerPicture = $bannerPicture;
        }

        public function isPending(): bool {
            return $this->pending;
        }

        public function setPending(bool $pending): void {
            $this->pending = $pending;
        }

        public function isApproved(): bool {
            return $this->approved;
        }

        public function setApproved(bool $approved): void {
            $this->approved = $approved;
        }

        public function getAttendees(): array {
            return $this->attendees;
        }

        public function setAttendees(array $attendees): void {
            $this->attendees = $attendees;
        }

        public function getSpecies(): array {
            return $this->species;
        }

        public function setSpecies(array $species): void {
            $this->species = $species;
        }

        public function delete(): void {
            $conexion = ReforestaDB::connectDB();
            $borrado = 'DELETE FROM events WHERE id=\"' . $this->id . "\"";
            $conexion->exec($borrado);
        }

        public function insert(): void {
            $conexion = ReforestaDB::connectDB();
            $insercion = "INSERT INTO events (host, description, province, locality, terrainType, date, type) " . 
            "VALUES (\"" . $this->host . "\", \"" . $this->description . "\", \"" . $this->province .
            "\", \"" . $this->locality . "\", \"" . $this->terrainType . "\", \"" . $this->date . "\", \"" . $this->type . ")";
            $conexion->exec($insercion);
        }

        public static function getEvents(): array {
            $conexion = ReforestaDB::connectDB();
            $seleccion = "SELECT * FROM events";
            $consulta = $conexion->query($seleccion);
            $ofertas = [];

            while ($registro = $consulta->fetchObject()) {
                $ofertas[] = new Event($registro->name, $registro->description, $registro->province,
                $registro->locality, $registro->terrainType, $registro->date, $registro->type,
                $registro->host, $registro->bannerPicture, $registro->id);
            }

            return $ofertas; 
        }

        public static function getEvent($id): Event {
            $conexion = ReforestaDB::connectDB();
            $seleccion = "SELECT * FROM pizza WHERE id=\"" . $id . "\"";
            $consulta = $conexion->query($seleccion);
            $registro = $consulta->fetchObject(); 

            return new Event($registro->name, $registro->description, $registro->province,
            $registro->locality, $registro->terrainType, $registro->date, $registro->type,
            $registro->host, $registro->bannerPicture, $registro->id);
        }
    }

?>