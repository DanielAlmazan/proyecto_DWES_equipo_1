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
        private bool $newsletterSubscription;

        public function __construct(int $id, string $name, string $surnames, string $email,
            string $nickName, string $password, string $avatar, bool $newsletterSubscription) {
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

        public function __get(string $field) {
            switch($field){
                case "id":
                    return $this->id;
                    break;
                case "name":
                    return $this->name;
                    break;
                case "surnames":
                    return $this->surnames;
                    break;
                case "email":
                    return $this->email;
                    break;
                case "nickName":
                    return $this->nickName;
                    break;
                case "password":
                    return $this->password;
                    break;
                case "karma":
                    return $this->karma;
                    break;
                case "avatar":
                    return $this->avatar;
                    break;
                case "newsletterSubscription":
                    return $this->newsletterSubscription;
                    break;
            }
        }

        public function __set(string $field, $value) {
            switch($field){
                case "name":
                    $this->name = $value . "";
                    break;
                case "surnames":
                    $this->surnames = $value . "";
                    break;
                case "email":
                    $this->email = $value . "";
                    break;
                case "nickName":
                    $this->nickName = $value . "";
                    break;
                case "password":
                    $this->password = $value . "";
                    break;
                case "karma":
                    $this->karma = +$value;
                    break;
                case "avatar":
                    $this->avatar = $value . "";
                    break;
                case "newsletterSubscription":
                    $this->newsletterSubscription = $value;
                    break;
            }
        }
    }
?>