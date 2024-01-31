<?php
    use User;

    class UserController {
        private array $users;
        private User $currentUser;

        public function __construct($users) {
            $this->users = $users;
        }

        public function __get($field) {
            if ($field == "currentUser" && isset($this->currentUser)) {
                return $this->currentUser;
            }
            // TODO: Throw exception or something
        }

        public function logIn(User $user) {
            if (!isset($this->currentUser)) {
                $this->currentUser = $user;
            }
        }

        public function logOut() {
            if (isset($this->currentUser)) {
                unset($this->currentUser);
            }
        }

        public function addKarmaPoints(int $value) {
            if (isset($this->currentUser)) {
                $this->currentUser->setKarma($this->currentUser->getKarma() + $value);
            }
        }

        public function editProfile($field, $value) {
            if (isset($this->currentUser)) {
                $this->currentUser->$field = $value;
            }
        }
    }

    ?>