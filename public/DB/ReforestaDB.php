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
                return new PDOException($e);
            }
        }
    }