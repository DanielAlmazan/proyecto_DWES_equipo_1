<?php
    class ReforestaDB {
        private static string $host = 'database';
        private static string $dbName = 'reforestaDB';
        private static string $user = 'root';
        private static string $password = 'Pass1234';

        public static function connectDB() {
            try {
                return new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbName . ";charset=utf8", self::$user, self::$password);
            } catch(PDOException $e) {
                return null;
            }
        }

        /* TODO: Mover esto a User.php
        User constructor:
        int $id, string $name, string $surnames, string $email,string $nickName, string $password, string $avatar*/
        function insertUser(PDO $pdo, User $user) {
            // TODO: Create users table in database
            $sql = "INSERT INTO users (name, surnames, email, nickName, password, avatar) VALUES (:name, :surnames, :email, :nickName, :password, :avatar)";
            $sentence = $pdo->prepare($sql);
            $name = $user->getName();
            $surnames = $user->getSurnames();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $sentence->bindParam(":name", $name);
            $sentence->bindParam(":surnames", $surnames);
            $sentence->bindParam(":email", $email);
            $sentence->bindParam(":password", $password);
            $sentence->execute();
        }

    }