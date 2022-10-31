<?php

class Session{


    public static function userConnected()
    {
        if(isset($_SESSION['login'])){
            return true;
        } else {
            return false;
        }
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
}