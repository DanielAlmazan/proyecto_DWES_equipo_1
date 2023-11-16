<?php
    class UserManager {
        private array $users;
        private User $currentUser;

        public function __construct($users) {
            $this->users = $users;
        }

        public function __get($field) {
            if($field == "currentUser" && isset($this->currentUser))
                return $this->currentUser;
        }

        public function logIn(User $user) {
            if(!isset($this->currentUser))
                $this->currentUser = $user;
        }

        public function logOut() {
            if(isset($this->currentUser))
                unset($this->currentUser);
        }

        public function addKarmaPoints(int $value) {
            if(isset($this->currentUser))
                $this->currentUser->karma += $value;
        }

        public function editProfile($field, $value) {
            if(isset($this->currentUser))
                $this->currentUser->$field = $value;
        }
    }
?>