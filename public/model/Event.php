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

        /**
         * Method that deletes an Event and its corresponding attendees and species
         */
        public function delete(): bool {
            // Declaring the connection and the delete statements
            $connection = null;
            $deleteEvent = null;
            $deleteAttendees = null;
            $deleteSpecies = null;

            // Variable to detect if the Event has been successfully deleted
            $deleted = false;

            try {
                // Connecting to the Database and beginning a transaction
                $connection = ReforestaDB::connectDB();
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connection->beginTransaction();

                // Preparing the delete statement of the Event
                $deleteEvent = $connection->prepare('DELETE FROM events WHERE id=:id');
                $deleteEvent->bindParam(':id', $this->id);

                // Preparing the delete statement of the Event's attendees
                $deleteAttendees = $connection->prepare('DELETE FROM usersInEvent WHERE eventId=:eventId');
                $deleteAttendees->bindParam(':eventId', $this->id);

                // Preparing the delete statement of the Event's species
                $deleteSpecies = $connection->prepare('DELETE FROM speciesInEvent WHERE eventId=:eventId');
                $deleteSpecies->bindParam(':eventId', $this->id); 

                // Executing the statements
                $connection->exec($deleteEvent);
                $connection->exec($deleteAttendees);
                $connection->exec($deleteSpecies);

                // Commit of the transaction
                $connection->commit();
                // If we reach this part of the code without throwing an exception, the Event has been deleted
                $deleted = true;
            } catch(Exception $e) {
                // Showing the error to the user in the most beautiful and convenient way!
                echo "<p>Error en la BBDD al insertar Evento: " . $e->getMessage() . "</p>";

                // Rollback of the transaction
                $connection->rollback();
            } finally {
                // Closing the connection and statements
                $deleteEvent = null;
                $deleteAttendees = null;
                $deleteSpecies = null;
                $connection = null;
            }

            return $deleted;
        }

        private function deleteAttendeeDB(int $idAttendee): void {
            $connection = null;
            $deletion = null;

            try {
                $connection = ReforestaDB::connectDB();

                $deletion = $connection->prepare('DELETE FROM usersInEvent WHERE userId=:userId AND eventId=:eventId');
                $deletion->bindParam(':userId', $idAttendee);
                $deletion->bindParam(':eventId', $this->id);

                $connection->exec($deletion);
            } catch(PDOException $pdoe) {
                
            } catch(Exception $e) {
                // Temporal hasta que veamos como mostrar errores
                echo "<p>Error genérico al insertar Evento</p>";
                echo "<p>" . $e->getMessage() . "</p>";
            }

            $insertion = null;
            $connection = null;
        }

        private function deleteSpecieDB(int $idSpecie): void {

        }

        /**
         * Method that inserts an Event and its corresponding attendees and species to the
         * database. It does so by performing a transaction where all the data is inserted,
         * and in case something fails, it makes a rollback.
         */
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

            try {
                $connection->beginTransaction();

                $connection->exec($insertion);
                foreach($this->attendees as $attendee) {
                    $this->insertAttendees($attendee->id);
                }
                foreach($this->species as $specie) {
                    $this->insertSpecies($specie->id);
                }

                $connection->commit();
            } catch(Exception $e) {
                // Temporal hasta que veamos como mostrar errores
                echo "<p>Error genérico al insertar Evento</p>";
                echo "<p>" . $e->getMessage() . "</p>";
                $connection->rollback();
            } finally {
                $insertion = null;
                $connection = null;
            }
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

        private function insertSpecies(int $idSpecie): void {
            $connection = ReforestaDB::connectDB();

            $insertion = $connection->prepare('INSERT INTO speciesInEvents (specieId, eventId) VALUES (:specieId, :eventId)');
            $insertion->bindParam(':specieId', $idSpecie);
            $insertion->bindParam(':eventId', $this->id);

            $connection->exec($insertion);
            $insertion = null;
            $connnection = null;
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