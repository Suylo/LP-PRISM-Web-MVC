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
}