<?php
    require_once dirname(__DIR__) . '/DB/ReforestaDB.php';

    /**
     * Class that represents an Event of Reforesta.
     */
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

        // GETTERS AND SETTERS

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
         * Method that inserts an Event and its corresponding attendees and species to the
         * database. It does so by performing a transaction where all the data is inserted,
         * and in case something fails, it makes a rollback.
         */
        public function insert(): void {
            // Declaring the connection and the insert statement
            $connection = null;
            $insert = null;

            try {
                // Connecting to the Database and beginning a transaction
                $connection = ReforestaDB::connectDB();
                $connection->beginTransaction();
            
                // Preparing the insert statement of the Event
                $insert = $connection->prepare('INSERT INTO events (name, host, description, province, locality, ' . 
                'terrainType, date, bannerPicture, type) VALUES (:name, :host, :description, :province, :locality, ' .
                ':terrainType, :date, :bannerPicture, :type)');

                // Binding all the parameters
                $insert->bindParam(':name', $this->name);
                $hostId = $this->host->getId();
                $insert->bindParam(':host', $hostId);
                $insert->bindParam(':description', $this->description);
                $insert->bindParam(':province', $this->province);
                $insert->bindParam(':locality', $this->locality);
                $insert->bindParam(':terrainType', $this->terrainType);
                $insert->bindParam(':date', $this->date);
                $insert->bindParam(':bannerPicture', $this->bannerPicture);
                $insert->bindParam(':type', $this->type);

                // Executing the statement
                $connection->exec($insert);

                // Inserting all attendees into usersInEvent
                foreach($this->attendees as $attendee) {
                    $this->insertAttendeeDB($attendee->id, $connection);
                }
                // Inserting all species into speciesInEvent
                foreach($this->species as $specie) {
                    $this->insertSpecieDB($specie->id, $connection);
                }

                // Commit of the transaction
                $connection->commit();
            } catch(Exception $e) {
                echo "<p>Error en la BBDD al insertar el Evento: " . $e->getMessage() . "</p>";

                // Rollback of the transaction
                $connection->rollback();
            } finally {
                // Closing the connection and statement
                $insert = null;
                $connection = null;
            }
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
                echo "<p>Error en la BBDD al eliminar el Evento: " . $e->getMessage() . "</p>";

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

        /**
         * Method that updates the info of an Event
         */
        public function update(): void {
            // Declaring the connection and the insert statement
            $connection = null;
            $update = null;

            try {
                // Connecting to the Database
                $connection = ReforestaDB::connectDB();
            
                // Preparing the update statement of the Event
                $update = $connection->prepare('UPDATE events SET name=:name, host=:name, description=:description,'. 
                ' province=:province, locality=:locality, terrainType=:terrainType, date=:date,' . 
                ' bannerPicture=:bannerPicture, type=:type WHERE id=:id');

                // Binding all the parameters
                $update->bindParam(':name', $this->name);
                $hostId = $this->host->getId();
                $update->bindParam(':host', $hostId);
                $update->bindParam(':description', $this->description);
                $update->bindParam(':province', $this->province);
                $update->bindParam(':locality', $this->locality);
                $update->bindParam(':terrainType', $this->terrainType);
                $update->bindParam(':date', $this->date);
                $update->bindParam(':bannerPicture', $this->bannerPicture);
                $update->bindParam(':type', $this->type);
                $update->bindParam(':id', $this->id);

                // Executing the statement
                $connection->exec($update);
            } catch(Exception $e) {
                echo "<p>Error en la BBDD al insertar el Evento: " . $e->getMessage() . "</p>";

                // Rollback of the transaction
                $connection->rollback();
            } finally {
                // Closing the connection and statement
                $update = null;
                $connection = null;
            }
        }

        /**
         * Method that gets all the Events from the database
         */
        public static function getAll(): array {
            // Declaring the connection, the select statement and the array of events
            $connection = null;
            $select = null;
            $events = [];

            try {
                // Connecting to the database
                $connection = ReforestaDB::connectDB();

                // Declaring the select and executing it
                $query = 'SELECT * FROM events';
                $select = $connection->query($query);
                $events = [];

                // Looping through the result to add it to the events array
                while ($entry = $select->fetchObject()) {
                    // We add an Event to the array with our own method
                    $events[] = Event::getById($entry->id);
                }
            } catch(Exception $e) {
                // If we catch an Exception, we empty the array
                $events = [];
            } finally {
                // Closing the connection and statement
                $connection = null;
                $select = null;
            }

            // We return the array of events
            return $events; 
        }

        /**
         * Method that gets a specific Event with an id passed through parameters
         */
        public static function getById(int $id): Event|null {
            // Declaring the connection, selection statements and the returned event
            $event = null;
            $connection = null;
            $select = null;
            $selectAttendees = null;
            $selectSpecies = null;

            try {
                // Connecting to the database
                $connection = ReforestaDB::connectDB();

                // Getting the basic info
                $select = $connection->prepare('SELECT * FROM events WHERE id=:id');
                $select->bindParam(':id', $id);
                $select->setFetchMode(PDO::FETCH_ASSOC);
                $select->execute();

                $entry = $select->fetch();

                if ($entry != null) {
                    $host = User::getById($entry['host']);

                    // Creating the base Event
                    $event = new Event($entry['name'], $entry['description'], $entry['province'],
                    $entry['locality'], $entry['terrainType'], new DateTime($entry['date']), $entry['type'],
                    $host, $entry['bannerPicture'], $entry['id']);

                    // Getting the attendees
                    $selectAttendees = $connection->prepare('SELECT * FROM usersInEvent WHERE eventId=:eventId');
                    $selectAttendees->bindParam(':eventId', $id);
                    $selectAttendees->setFetchMode(PDO::FETCH_ASSOC);
                    $selectAttendees->execute();

                    while($entry = $selectAttendees->fetch()) {
                        $event->attendees[] = User::getById($entry['userId']);
                    }

                    // Getting the species
                    $selectSpecies = $connection->prepare('SELECT * FROM speciesInEvent WHERE eventId=:eventId');
                    $selectSpecies->bindParam(':eventId', $id);
                    $selectSpecies->setFetchMode(PDO::FETCH_ASSOC);
                    $selectSpecies->execute();

                    while($entry = $selectSpecies->fetch()) {
                        $event->species[] = Specie::getSpecie($entry['specieId']);
                    }
                }
                
            } catch(Exception $e) {
                // If an exception is found, we empty the entire event
                $event = null;
            } finally {
                // Closing the connection and statements
                $connection = null;
                $select = null;
                $selectAttendees = null;
                $selectSpecies = null;
            }

            return $event;
        }

        /**
         * Method that gets an array of Events based on the name
         */
        public static function getByName(string $name): array {
            // Declaring the connection, select statement and the array of Events
            $connection = null;
            $select = null;
            $events = [];

            try {
                // Connecting to the database
                $connection = ReforestaDB::connectDB();

                // Preparing the select statement
                $select = $connection->prepare('SELECT * FROM events WHERE name=:name');
                $select->bindParam(':name', $name);
                $select->setFetchMode(PDO::FETCH_ASSOC);
                $select->execute();

                // Looping through the result to add it to the events array
                while ($entry = $select->fetch()) {
                    // We add an Event to the array with our own method
                    $events[] = Event::getById($entry->id);
                }
            } catch(Exception $e) {
                // If an exception is found, we empty the array
                $events = [];
            } finally {
                // Closing the connection and statements
                $connection = null;
                $select = null;
            }

            return $events;
        }

        /**
         * Method that adds an Attendee to the event, both in the object and in the database
         */
        public function addAttendee(User $attendee): void {
            // Declaring the connection
            $connection = null;

            try {
                // Connecting to the database
                $connection = ReforestaDB::connectDB();

                // Using our method to add the attendee to the DB
                $this->insertAttendeeDB($attendee->getId(), $connection);
                // Adding the attendee at the end of our array
                $this->attendees[] = $attendee;
            } catch(Exception $e) {
                echo "<p>Error añadiendo participante al Evento: " . $e->getMessage() . "</p>";
            } finally{
                // Closing the connection
                $connection = null;
            }
        }

        /**
         * Method that removes an attendee from the Event
         */
        public function removeAttendee(User $attendee): void {
            try {
                // Using our method to remove the attendee from the DB
                $this->deleteAttendeeDB($attendee->getId());

                // Looping through the attendees array to remove it
                $found = false;
                $index = 0;
                do {
                    if ($this->attendees[$index]->getId() == $attendee->getId()) {
                        $found = true;
                        unset($this->attendees[$index]);
                    }
                    $index++;
                } while(!$found);
            } catch(Exception $e) {
                echo "<p>Error eliminando participante del Evento: " . $e->getMessage() . "</p>";
            }
        }

        /**
         * Method that adds an specie to the Event
         */
        public function addSpecie(Specie $specie) {
            // Declaring the connection
            $connection = null;

            try {
                // Connecting to the database
                $connection = ReforestaDB::connectDB();

                // Using our own method to insert the specie to the DB
                $this->insertSpecieDB($specie->getId(), $connection);
                // Adding the specie to the array
                $this->species[] = $specie;
            } catch(Exception $e) {
                echo "<p>Error añadiendo especie al Evento: " . $e->getMessage() . "</p>";
            } finally{
                // Closing the connection
                $connection = null;
            }
        }

        /**
         * Method that removes an specie from the Event
         */
        public function removeSpecie(Specie $specie) {
            try {
                // Using our method to delete it from the DB
                $this->deleteSpecieDB($specie->getId());

                // Looping through the array to find and remove the specie
                $found = false;
                $index = 0;
                do {
                    if ($this->species[$index]->getId() == $specie->getId()) {
                        $found = true;
                        unset($this->species[$index]);
                    }
                    $index++;
                } while(!$found);
            } catch(Exception $e) {
                echo "<p>Error eliminando especie del Evento: " . $e->getMessage() . "</p>";
            }
        }

        /**
         * Method that prints a card with the basic info of the Event
         */
        public function showCard(bool $loggedIn) {
            ?>
                <div class="event">
                    <img src="../res/images/species/<?=$this->getBannerPicture();?>"
                            alt="<?= $this->getBannerPicture() ?>">
                    <div class="event-body">
                        <h2><a href="<?= dirname(__DIR__) . '/controller/EventController.php?action=2&id=' . $this->getId();?>"><?=$this->getName();?></a></h2>
                        <p><small><?= $this->getLocality() ?></small></p>
                        <?php
                            if ($loggedIn) {
                                // TODO: Call some kind of "joinToEvent" method
                                ?>
                                <form action="#">
                                    <input type="submit" value="Join Event" id="btnJoinEvent">
                                </form>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            <?php
        }

        /**
         * Method that inserts an attendee into usersInEvents onto the DB
         */
        private function insertAttendeeDB(int $idAttendee, PDO $connection): void {
            $insert = null;

            try {
                $insert = $connection->prepare('INSERT INTO usersInEvents (userId, eventId) VALUES (:userId, :eventId)');
                $insert->bindParam(':userId', $idAttendee);
                $insert->bindParam(':eventId', $this->id);
    
                $connection->exec($insert);
            } catch(Exception $e) {
                throw new Exception($e->getMessage());
            } finally {
                $insert = null;
            }
        }

        /**
         * Method that inserts a specie into speciesInEvents onto the DB
         */
        private function insertSpecieDB(int $idSpecie, PDO $connection): void {
            $insert = null;

            try {
                $insert = $connection->prepare('INSERT INTO speciesInEvents (specieId, eventId) VALUES (:specieId, :eventId)');
                $insert->bindParam(':specieId', $idSpecie);
                $insert->bindParam(':eventId', $this->id);

                $connection->exec($insert);
            } catch(Exception $e) {
                throw new Exception($e->getMessage());
            } finally {
                $insert = null;
            }
        }

        /**
         * Method that deletes an attendee from usersInEvents on the DB
         */
        private function deleteAttendeeDB(int $idAttendee): bool {
            $connection = null;
            $delete = null;
            $deleted = false;

            try {
                $connection = ReforestaDB::connectDB();

                $delete = $connection->prepare('DELETE FROM usersInEvent WHERE userId=:userId AND eventId=:eventId');
                $delete->bindParam(':userId', $idAttendee);
                $delete->bindParam(':eventId', $this->id);

                $connection->exec($delete);
                $deleted = true;
            } catch(Exception $e) {
                throw new Exception($e->getMessage());
            } finally {
                $delete = null;
                $connection = null;
            }

            return $deleted;
        }

        /**
         * Method that deletes a specie from speciesInEvents on the DB
         */
        private function deleteSpecieDB(int $idSpecie): bool {
            $connection = null;
            $delete = null;
            $deleted = false;

            try {
                $connection = ReforestaDB::connectDB();

                $delete = $connection->prepare('DELETE FROM speciesInEvent WHERE specieId=:userId AND eventId=:eventId');
                $delete->bindParam(':specieId', $idSppecie);
                $delete->bindParam(':eventId', $this->id);

                $connection->exec($delete);
                $deleted = true;
            } catch(Exception $e) {
                throw new Exception($e->getMessage());
            } finally {
                $delete = null;
                $connection = null;
            }

            return $deleted;
        }
    }

    // If I have to write more code for this class, my will to live is going to disappear :)
?>