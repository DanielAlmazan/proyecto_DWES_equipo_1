<?php
    function register() {
        require_once('../model/User.php');
        $success = false;
        
        if (
            !empty($_POST['name']) &&
            !empty($_POST['surname']) && 
            !empty($_POST['email']) &&
            !empty($_POST['nickname']) &&
            !empty($_FILES['avatar'])) {
            
            $avatar = checkAvatar();
            if($avatar != null) {
                $user = new User(
                    $_POST['name'],
                    $_POST['surname'],
                    $_POST['email'],
                    $_POST['nickname'],
                    $_POST['password'],
                    $avatar
                );
                $user->insert();
                $success = true;
            }
        }
        
        return $success;
    }
    
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