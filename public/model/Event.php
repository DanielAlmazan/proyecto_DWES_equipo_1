<?php
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
            $connection = ReforestaDB::connectDB();

            $delete = $connection->prepare('DELETE FROM events WHERE id=:id');
            $delete->bindParam(':id', $this->id);

            $connection->exec($delete);
            $delete = null;
            $connection = null;
        }

        public function insert(): void {
            $connection = ReforestaDB::connectDB();
            
            $insertion = $connection->prepare('INSERT INTO events (name, host, description, province, locality, ' . 
            'terrainType, date, bannerPicture, type) VALUES (:name, :host, :description, :province, :locality, ' .
            ':terrainType, :date, :bannerPicture, :type)');

            $insertion->bindParam(':name', $this->name);
            $hostId = $this->host->getId();
            $insertion->bindParam(':host', $hostId);
            $insertion->bindParam(':description', $this->description);
            $insertion->bindParam(':province', $this->province);
            $insertion->bindParam(':locality', $this->locality);
            $insertion->bindParam(':terrainType', $this->terrainType);
            $insertion->bindParam(':date', $this->date);
            $insertion->bindParam(':bannerPicture', $this->bannerPicture);
            $insertion->bindParam(':type', $this->type);

            $connection->exec($insertion);
            $insertion = null;
            $connection = null;
        }

        private function insertAttendees(int $idAttendee): void {
            $connection = ReforestaDB::connectDB();

            $insertion = $connection->prepare('INSERT INTO usersInEvents (userId, eventId) VALUES (:userId, :eventId)');
            $insertion->bindParam(':userId', $idAttendee);
            $insertion->bindParam(':eventId', $this->id);

            $connection->exec($insertion);
            $insertion = null;
            $connection = null;
        }

        public static function getAll(): array {
            $connection = ReforestaDB::connectDB();

            $query = 'SELECT * FROM events';
            $selection = $connection->query($query);
            $events = [];

            while ($entry = $selection->fetchObject()) {
                $events[] = Event::getById($entry->id);
            }

            $selection = null;
            $connection = null;
            return $events; 
        }

        public static function getById(int $id): Event {
            $connection = ReforestaDB::connectDB();

            // Getting the basic info
            $query = $connection->prepare('SELECT * FROM events WHERE id=:id');
            $selection = $connection->query($query);
            $entry = $selection->fetchObject();

            //$host = User::getById($entry->host);

            $event = new Event($entry->name, $entry->description, $entry->province,
            $entry->locality, $entry->terrainType, $entry->date, $entry->type,
            $entry->host, $entry->bannerPicture, $entry->id);
            $selection = null;

            // Getting the attendees
            $queryUsersInEvent = $connection->prepare('SELECT * FROM usersInEvent WHERE eventId=:eventId');
            $queryUsersInEvent->bindParam(':eventId', $id);
            $selectionAttendees = $connection->query($queryUsersInEvent);

            while($entry = $selectionAttendees->fetchObject()) {
                //$event->attendees[] = User::getById($entry->userId);
            }
            $selectionAttendees = null;

            // Getting the species
            $querySpeciesInEvent = $connection->prepare('SELECT * FROM speciesInEvent WHERE eventId=:eventId');
            $querySpeciesInEvent->bindParam(':eventId', $id);
            $selectionSpecies = $connection->query($querySpeciesInEvent);

            while($entry = $selectionSpecies->fetchObject()) {
                //$event->species[] = Specie::getById($entry->specieId);
            }
            $selectionSpecies = null;
            
            $connection = null;

            return $event;
        }
    }

?>