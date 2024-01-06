<?php

class UserSession{

    public function __construct(){
        session_start();
    }

    public function setCurrentUser($user){
        $_SESSION['username'] = $user;
    }

    public function getCurrentUser(){
        return $_SESSION['username'];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }
}


?>

