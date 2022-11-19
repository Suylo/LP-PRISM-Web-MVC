<?php

class Session{


    public static function userConnected()
    {
        return isset($_SESSION['login']);
    }

    public static function adminConnected()
    {
        if (isset($_SESSION['login']) && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function userConnecting()
    {
        if (isset($_GET['login']) && isset($_GET['password'])){
            return true;
        } else {
            return false;
        }
    }

    public static function userCreatingAccount()
    {
        $bool = isset($_GET['action']) && $_GET['action'] == "creerCompteAdherent";
        return $bool;
    }

    public static function menuUrl()
    {
        return self::adminConnected() ? include_once "views/menuAdmin.php" : include_once "views/menuDefault.php";
    }

    public static function getUserLogged()
    {
        return $_SESSION['nomAdherent'] . " " . $_SESSION['prenomAdherent'];
    }

    public static function userValidatingAccount()
    {
        $bool = isset($_GET["action"]) && $_GET["action"] == "validerCompteAdherent";
        return $bool;
    }
}