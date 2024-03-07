<?php
    function login(User $user) {
        $_SESSION['userId'] = $user->getId();
        if(User::checkAdmin($user)) {
            $_SESSION['admin'] = true;
        }
    }

    function logout() {
        if(isset($_SESSION['userId'])) {
            unset($_SESSION['userId']);

            if(isset($_SESSION['admin'])) 
                unset($_SESSION['admin']);
            
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