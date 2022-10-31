<?php

require_once "models/Adherent.php";

class AdherentControleur extends ObjetControleur {

    protected static $objet = "Adherent";
    protected static $cle = "login";
    protected static $champs = [
        "login" => ["Login", "text"],
        "mdp" => ["Mot de passe", "password"],
        "nomAdherent" => ["Nom", "text"],
        "prenomAdherent" => ["Prénom", "text"],
        "email" => ["Email", "email"],
        "dateAdhesion" => ["Date d'adhésion", "date"],
    ];

    public static function creerAdherent(){
        $login = $_GET['login'];
        $mdp = $_GET['mdp'];
        $nom = $_GET['nomAdherent'];
        $prenom = $_GET['prenomAdherent'];
        $email = $_GET['email'];
        $dateAdhesion = $_GET['dateAdhesion'];
        if(Adherent::addAdherent($login, $mdp, $nom, $prenom, $email, $dateAdhesion)){
            $msg = "L'adhérent a bien été ajouté !";
            header("Location: index.php?action=lireObjets&controleur=AdherentControleur&msg=" . $msg ."#modal__msg");
        } else {
            $msg = "L'adhérent n'a pas pu être ajouté !";
            header("Location: index.php?action=lireObjets&controleur=AdherentControleur&msg=" . $msg . "#modal__msg");
        }
    }

    public static function modifierAdherent(){
        $login = $_GET['login'];
        $mdp = $_GET['mdp'];
        $nom = $_GET['nomAdherent'];
        $prenom = $_GET['prenomAdherent'];
        $email = $_GET['email'];
        $dateAdhesion = $_GET['dateAdhesion'];
        if(Adherent::updateAdherent($login, $mdp, $nom, $prenom, $email, $dateAdhesion)){
            $msg = "L'adhérent $login a bien été modifié !";
            header("Location: index.php?action=lireObjets&controleur=AdherentControleur&msg=" . $msg ."#modal__msg");
        } else {
            $msg = "L'adhérent $login n'a pas pu être modifié !";
            header("Location: index.php?action=lireObjets&controleur=AdherentControleur&msg=" . $msg . "#modal__msg");
        }
    }

    public static function afficherFormulaireConnexion(){
        include_once "views/debut.php";
        include_once "views/formulaireConnexion.php";
        include_once "views/fin.html";
    }

    public static function connecterAdherent()
    {
        if(isset($_GET['login']) && isset($_GET['mdp'])){
            $login = $_GET['login'];
            $mdp = $_GET['mdp'];
            $checkMdp = Adherent::checkMDP($login, $mdp);
            $unAdherent = Adherent::getObjetById($login);

            if($checkMdp){
                $_SESSION['login'] = $mdp;
                $_SESSION['nomAdherent'] = $unAdherent->nomAdherent;
                $_SESSION['prenomAdherent'] = $unAdherent->prenomAdherent;
                $_SESSION['isAdmin'] = $unAdherent->isAdmin;
                header('Location: index.php');
            } else {
                self::afficherFormulaireConnexion();
            }
        }
    }

    public static function logout()
    {
        // destroy session
        $_SESSION['login'] = null;
        $_SESSION['mdp'] = null;
        setcookie(session_name(), '', time()-1);
        session_unset();
        session_destroy();
        self::afficherFormulaireConnexion();
    }
}