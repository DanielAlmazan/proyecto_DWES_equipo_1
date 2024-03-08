<?php
    require_once('../model/User.php');

    function register() {
        $success = false;

        if (!empty($_POST['name']) &&
            !empty($_POST['surnames']) && 
            !empty($_POST['email']) &&
            !empty($_POST['nickname']) &&
            !empty($_FILES['avatar'])) {
            
            $avatar = checkAvatar();
            if($avatar != null) {
                $user = new User(
                    filterString($_POST['name']),
                    filterString($_POST['surnames']),
                    filterString($_POST['email']),
                    filterString($_POST['nickname']),
                    filterString($_POST['pass1']),
                    $avatar
                );
                $success = $user->insert();
            }
        }
        
        return $success;
    }

    // Function to filter a string
    function filterString(string $value) {
        return filter_var(trim($value), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    // Function for check img uploaded and save it
    function checkAvatar(){
        $name = null;
        if (is_uploaded_file ($_FILES['avatar']['tmp_name']) && checkType($_FILES['avatar']['type'])) {
            $nameDir = "../res/images/avatars/";
            // Asignamos un id unico para no sobreescribir fotos con el mismo nombre
            $timestamp = time();
            $nameFile = $timestamp . "-" . $_FILES['avatar']['name'];
            move_uploaded_file ($_FILES['avatar']['tmp_name'], $nameDir .
                $nameFile);
            $name = $nameFile;
        } 
        else{
            echo "<p class='alert alert-danger'>Debes seleccionar una foto de tipo .jpeg, .jpg o .png</p>";
        }

        return $name;
    }

    // Function for check the type of img
    function checkType($img){
        $types = ["jpg", "jpeg", "png"];
        $correctType = false;
        foreach($types as $type){
            if("image/" . $type == $img)
                $correctType = true;
        }
        return $correctType;
    }
    
    function login(User $user) {
        $_SESSION['userId'] = $user->getId();
        if(User::checkAdmin($user)) {
            $_SESSION['admin'] = true;
        }
    }

    function logout() {
        if(isset($_SESSION['userId'])) {
            session_destroy();
            header("Location: home.php");
        }
    }

    function addKarmaPoints(int $value, int $id) {
        $user = User::getById($id);
        if($user != null) {
            $user->setKarma($user->getKarma() + $value);
        }
    }

    function editProfile() {
        $success = false;
        $user = User::getById($_SESSION['userId']);

        if (!empty($_POST['name']) &&
            !empty($_POST['surnames']) && 
            !empty($_POST['email']) &&
            !empty($_POST['nickname'])) {
            
            $user->setName(filterString($_POST['name']));
            $user->setSurnames(filterString($_POST['surnames']));
            $user->setEmail(filterString($_POST['email']));
            $user->setNickName(filterString($_POST['nickname']));
            $user->setPassword(filterString($_POST['pass1']));

            $success = $user->update();
        }
        
        return $success;
    }

    function changeAvatar() {
        $success = false;
        $user = User::getById($_SESSION['userId']);

        if (!empty($_FILES['avatar'])) {
            $avatar = checkAvatar();
            if($avatar != null) {
                $user->setAvatar($avatar);
                $success = $user->update();
            }
        }
        
        return $success;
    }
?>