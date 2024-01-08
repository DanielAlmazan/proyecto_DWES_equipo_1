<?php

    namespace DB;

    use PDO;
    use User;

    class ReforestaDB {
        /** Gets a PDO object.
         * @return PDO The PDO object.
         */
        function getPdo(): PDO {
            $host = "database";
            $nombreDB = "reforestaDB";
            $usuario = "root";
            $password = "Pass1234";

            $pdo = new PDO("mysql:host=$host;dbname=$nombreDB;charset=utf8", $usuario, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }

        /* User constructor:
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