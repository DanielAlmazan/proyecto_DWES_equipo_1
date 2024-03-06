<?php
    function logIn(User $user) {
        $_SESSION['user'] = $user->getId();
    }

    function logOut() {
        if(isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            session_destroy();
        }
    }

    function addKarmaPoints(int $value, int $id) {
        $user = User::getById($id);
        if($user != null) {
            $user->setKarma($user->getKarma() + $value);
        }
    }

    function editProfile(User $user) {
        $user->update();
    }
?>