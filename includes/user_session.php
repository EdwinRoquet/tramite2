<?php
class UserSession{
    public function __construct(){
        //session_start();
        if(!isset($_SESSION)){session_start();}
    }
    public function setCurrentUser($user){
        //$_SESSION['id'] = $id;
        $_SESSION['user'] = $user;
    }
    public function getCurrentUser(){
        return $_SESSION['user'];
    }
    public function getCurrentId(){
        return $_SESSION['id'];
    }
    public function closeSession(){
        session_unset();
        session_destroy();
    }
}
?>