<?php

    require_once dirname(__DIR__) . '/DB/ReforestaDB.php';

    class User {
        private int $id;
        private string $name;
        private string $surnames;
        private string $email;
        private string $nickName;
        private string $password;
        private int $karma;
        private string $avatar;
        private bool $newsletterSubscription;

        public function __construct(int $id, string $name, string $surnames, string $email,
            string $nickName, string $password, string $avatar) {
            $this->id = $id;
            $this->name = $name;
            $this->surnames = $surnames;
            $this->email = $email;
            $this->nickName = $nickName;
            $this->password = $password;
            $this->karma = 0;
            $this->avatar = $avatar;
            $this->newsletterSubscription = false;
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
	    }

	    public function getAvatar(): string {
		    return $this->avatar;
	    }

	    public function setAvatar(string $avatar): void {
		    $this->avatar = $avatar;
	    }

	    public function isNewsletterSubscription(): bool {
		    return $this->newsletterSubscription;
	    }

	    public function setNewsletterSubscription(bool $newsletterSubscription): void {
		    $this->newsletterSubscription = $newsletterSubscription;
	    }


        function insertUser(User $user) {
            $pdo = ReforestaDB::connectDB();
            $sql = "INSERT INTO users (name, surnames, email, nickName, password, avatar)" .
				" VALUES (:name, :surnames, :email, :nickName, :password, :avatar)";
            $insert = $pdo->prepare($sql);

			// Get params
            $name = $user->getName();
            $surnames = $user->getSurnames();
            $email = $user->getEmail();
			$nickName = $user->getNickName();
            $password = $user->getPassword();
			$avatar = $user->getAvatar();

			// Bind params
            $insert->bindParam(":name", $name);
            $insert->bindParam(":surnames", $surnames);
            $insert->bindParam(":email", $email);
            $insert->bindParam(":nickName", $nickName);
			$insert->bindParam(":password", $password);
			$insert->bindParam(":avatar", $avatar);
			
            $insert->execute();
			$pdo = null;
        }

	
		public static function getUsers():array {
            $db = ReforestaDB::connectDB();
            $sql = "SELECT * FROM users";
            $stmt = $db->query($sql);
            $users = [];
        
            while ($record = $stmt->fetchobject()) {
                $users[] = new User(
                    $record->id,$record->name,$record->surenames,$record->email,$record->nickName,
					$record->password,$record->avatar,$record->newsletterSubscription
                );
            }
            return $users;
        }
		
		function getUser(int $id):User {
			$db = ReforestaDB::connectDB();
			$sql = "SELECT * FROM users WHERE id= :id";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			$record = $stmt->fetchObject();
			$user = new User(
				$record->id, $record->name, $record->surnames, $record->email, $record->nickName,
				$record->password, $record->avatar
			);
			return $user;
		}
		
		function updateUser(User $user):void {
			$db = ReforestaDB::connectDB();
			$sql = "UPDATE users SET name=:name, surnames=:surnames, email=:email, nickName=:nickName, password=:password, avatar=:avatar WHERE id=:id";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":name", $user->getName());
			$stmt->bindParam(":surnames", $user->getSurnames());
			$stmt->bindParam(":email", $user->getEmail());
			$stmt->bindParam(":nickName", $user->getNickName());
			$stmt->bindParam(":password", $user->getPassword());
			$stmt->bindParam(":avatar", $user->getAvatar());
			$stmt->bindParam(":id", $user->getId(), PDO::PARAM_INT);
			$stmt->execute();
		}
		
		function deleteUser(int $id):void {
			$db = ReforestaDB::connectDB();
			$sql = "DELETE FROM users WHERE id= :id";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
		}
		


    }
?>