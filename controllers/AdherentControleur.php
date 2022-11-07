<?php

require_once "models/Adherent.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

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
        $titre = "Connexion / Inscription";
        $message = "";
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

            if($checkMdp && $unAdherent->get('chaineValidationEmail') == NULL){
                $phpmailer = new PHPMailer();
                $phpmailer->isSMTP();
                $phpmailer->Host = 'smtp.mailtrap.io';
                $phpmailer->SMTPAuth = true;
                $phpmailer->Port = 2525;
                $phpmailer->Username = '50b2e77111cabb';
                $phpmailer->Password = '3e9eef1f0c7a06';
                $phpmailer->CharSet = 'UTF-8';

                try {
                    $phpmailer->setFrom('mvcbibli@llubine.com', 'Administrator');
                    $phpmailer->addAddress($unAdherent->get('email'), $unAdherent->get('nomAdherent') . " " . $unAdherent->get('prenomAdherent'));
                    $phpmailer->isHTML(true);
                    $phpmailer->Subject = 'Connexion à la bibliothèque';
                    $phpmailer->Body = "Bonjour " . $unAdherent->get('nomAdherent') . " " . $unAdherent->get('prenomAdherent') . ", vous êtes connecté !";
                    $phpmailer->send();

                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
                }

                $_SESSION['login'] = $mdp;
                $_SESSION['nomAdherent'] = $unAdherent->nomAdherent;
                $_SESSION['prenomAdherent'] = $unAdherent->prenomAdherent;
                $_SESSION['isAdmin'] = $unAdherent->isAdmin;
                header('Location: index.php');
            } else {
                $message = "Le login ou le mot de passe est incorrect !";
                self::afficherFormulaireConnexion();
            }
        }
    }

    public static function creerCompteAdherent(){
        $login = $_GET['login'];
        $mdp = $_GET['mdp'];
        $nom = $_GET['nomAdherent'];
        $prenom = $_GET['prenomAdherent'];
        $email = $_GET['email'];
        $dateAdhesion = date("Y-m-d");
        Adherent::addAdherent($login, $mdp, $nom, $prenom, $email, $dateAdhesion);
        $message = "Votre compte a bien été créé !";
        self::afficherFormulaireConnexion();
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