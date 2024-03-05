<?php
    class User {
        private int $id;
        private string $name;
        private string $surnames;
        private string $email;
        private string $nickName;
        private string $password;
        private int $karma;
        private string $avatar;

		// Default id = 0 for users not inserted in DB
        public function __construct(string $name, string $surnames, string $email,
            string $nickName, string $password, string $avatar, int $karma = 0, int $id = 0) {
            $this->name = $name;
            $this->surnames = $surnames;
            $this->email = $email;
            $this->nickName = $nickName;
            $this->password = $password;
            $this->avatar = $avatar;
			$this->karma = $karma;
			$this->id = $id;
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
	    
	    public function getSurnames(): string {
		    return $this->surnames;
	    }

	    public function setSurnames(string $surnames): void {
		    $this->surnames = $surnames;
	    }

	    public function getEmail(): string {
		    return $this->email;
	    }

	    public function setEmail(string $email): void {
		    $this->email = $email;
	    }

	    public function getNickName(): string {
		    return $this->nickName;
	    }

	    public function setNickName(string $nickName): void {
		    $this->nickName = $nickName;
	    }

	    public function getPassword(): string {
		    return $this->password;
	    }

	    public function setPassword(string $password): void {
		    $this->password = $password;
	    }

	    public function getKarma(): int {
		    return $this->karma;
	    }

	    public function setKarma(int $karma): void {
		    $this->karma = $karma;
			$this->updateKarma();
	    }

	    public function getAvatar(): string {
		    return $this->avatar;
	    }

	    public function setAvatar(string $avatar): void {
		    $this->avatar = $avatar;
	    }

        function insert() {
			$correct = false;

			try {
				$pdo = ReforestaDB::connectDB();
				$sql = "INSERT INTO users (name, surnames, email, nickName, password, avatar)" .
					" VALUES (:name, :surnames, :email, :nickName, :password, :avatar)";
				$insert = $pdo->prepare($sql);

				// Bind params
				$insert->bindParam(":name", $this->name);
				$insert->bindParam(":surnames", $this->surnames);
				$insert->bindParam(":email", $this->email);
				$insert->bindParam(":nickName", $this->nickName);
				$insert->bindParam(":password", $this->password);
				$insert->bindParam(":avatar", $this->avatar);
				
				$correct = $insert->execute();
			} catch(Exception $e) {
				echo "<p class='error'>" . $e->getMessage(). "</p>";
			} finally {
				$insert = null;
				$pdo = null;
			}
            
			return $correct;
        }
		
		function update() {
			$correct = false;
			
			try {
				$pdo = ReforestaDB::connectDB();
				$sql = "UPDATE users SET name=:name, surnames=:surnames, email=:email, nickName=:nickName, password=:password, avatar=:avatar WHERE id=:id";
				$update = $pdo->prepare($sql);

				// Bind params
				$update->bindParam(":name", $this->name);
				$update->bindParam(":surnames", $this->surnames);
				$update->bindParam(":email", $this->email);
				$update->bindParam(":nickName", $this->nickName);
				$update->bindParam(":password", $this->password);
				$update->bindParam(":avatar", $this->avatar);
				$update->bindParam(":id", $this->id);

				$correct = $update->execute();
			} catch(Exception $e) {
				echo "<p class='error'>" . $e->getMessage(). "</p>";
			} finally {
				$update = null;
				$pdo = null;
			}
			
			return $correct;
		}

		private function updateKarma() {
			try {
				$pdo = ReforestaDB::connectDB();
				$sql = "UPDATE users SET karma=:karma WHERE id=:id";
				$update = $pdo->prepare($sql);

				// Bind params
				$update->bindParam(":karma", $this->karma);
				$update->bindParam(":id", $this->id);

				$update->execute();
			} catch(Exception $e) {
				echo "<p class='error'>" . $e->getMessage(). "</p>";
			} finally {
				$update = null;
				$pdo = null;
			}
		}
		
		function delete() {
			$correct = false;

			try {
				$pdo = ReforestaDB::connectDB();
				$sql = "DELETE FROM users WHERE id=:id";
				$delete = $pdo->prepare($sql);

				// Bind params
				$delete->bindParam(":id", $id);

				$correct = $delete->execute();
			} catch(Exception $e) {
				echo "<p class='error'>" . $e->getMessage(). "</p>";
			} finally {
				$delete = null;
				$pdo = null;
			}

			return $correct;
		}

		static function getAll() {
			$users = [];

			try {
				$pdo = ReforestaDB::connectDB();
				$sql = "SELECT * FROM users";

				$select = $pdo->query($sql);
				$select->execute();
				while ($user = $select->fetchobject()) {
					$users[] = new User(
						$user->name,
						$user->surenames,
						$user->email,
						$user->nickName,
						$user->password,
						$user->avatar,
						$user->karma,
						$user->id
					);
				}
			} catch(Exception $e) {
				echo "<p class='error'>" . $e->getMessage(). "</p>";
			} finally {
				$select = null;
				$pdo = null;
			}

            return $users;
        }
		
		static function getById(int $id) {
			$user = null;

			try {
				$pdo = ReforestaDB::connectDB();
				$sql = "SELECT * FROM users WHERE id=:id";
				$select = $pdo->prepare($sql);

				// Bind params
				$select->bindParam(":id", $id);

				$select->execute();
				if($result = $select->fetchObject()) {
					$user = new User(
						$result->name, 
						$result->surnames, 
						$result->email, 
						$result->nickName,
						$result->password, 
						$result->avatar,
						$result->karma,
						$result->id
					);
				}
			} catch(Exception $e) {
				echo "<p class='error'>" . $e->getMessage(). "</p>";
			} finally {
				$select = null;
				$pdo = null;
			}

			return $user;
		}

		static function suscribeNewsletter(string $email) {
			$correct = false;

			try {
				$pdo = ReforestaDB::connectDB();
				$sql = "INSERT INTO newsletterSubscribers (:email)";
				$insert = $pdo->prepare($sql);

				// Bind params
				$insert->bindParam(":email", $email);
				
				$correct = $insert->execute();
			} catch(Exception $e) {
				echo "<p class='error'>" . $e->getMessage(). "</p>";
			} finally {
				$insert = null;
				$pdo = null;
			}

			return $correct;
        }

		static function unsuscribeNewsletter(string $email) {
			$correct = false;

			try {
				$pdo = ReforestaDB::connectDB();
				$sql = "SELECT * FROM newsletterSubscribers WHERE email=:email";
				$select = $pdo->prepare($sql);

				// Bind params
				$select->bindParam(":email", $email);

				$select->execute();
				if($select->fetchObject()) {
					$sql = "DELETE FROM newsletterSubscribers WHERE email=:email";
					$delete = $pdo->prepare($sql);

					// Bind params
					$delete->bindParam(":email", $email);;

					$correct = $delete->execute();
				}
			} catch(Exception $e) {
				echo "<p class='error'>" . $e->getMessage(). "</p>";
			} finally {
				$select = null;
				$delete = null;
				$pdo = null;
			}

			return $correct;
        }
    }
?>