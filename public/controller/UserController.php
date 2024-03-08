<?php
    function register() {
        require_once('../model/User.php');
        $success = false;

        if (
            !empty($_POST['name']) &&
            !empty($_POST['surnames']) && 
            !empty($_POST['email']) &&
            !empty($_POST['nickname']) &&
            !empty($_FILE['avatar']['name'])) {
            echo "adios";
            
            $avatar = checkAvatar();
            echo "hola";
            if($avatar != null) {
                $user = new User(
                    $_POST['name'],
                    $_POST['surnames'],
                    $_POST['email'],
                    $_POST['nickname'],
                    $_POST['password'],
                    $avatar
                );
                $success = $user->insert();
            }
        }
        
        return $success;
    }

    // Function for check img uploaded and save it
    function checkAvatar(){
        $name = null;
        if (is_uploaded_file ($_FILES['avatar']['tmp_name']) && checkType($_FILES['avatar']['type'])) {
            $nameDir = "../res/images/avatars/";
            // Asignamos un id unico para no sobreescribir fotos con el mismo nombre
            $timestamp = time();
            $nameFile = $timestamp . "-" . $_FILES['avatar']['name'];
            move_uploaded_file ($_FILES['foto']['tmp_name'], $nameDir .
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