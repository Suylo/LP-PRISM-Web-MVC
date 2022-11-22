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

            if($checkMdp && $unAdherent->get('champValidationEmail') == NULL){
                header('Location: index.php');

                $_SESSION['login'] = $login;
                $_SESSION['nomAdherent'] = $unAdherent->get('nomAdherent');
                $_SESSION['prenomAdherent'] = $unAdherent->get('prenomAdherent');
                $_SESSION['isAdmin'] = $unAdherent->get('isAdmin');
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
        //Adherent::addAdherent($login, $mdp, $nom, $prenom, $email, $dateAdhesion);
        $unAdherent = Adherent::getObjetById($login);
        $champValidationEmail = bin2hex(openssl_random_pseudo_bytes(16));
        $tabObjets = [
            "login" => $login,
            "mdp" => $mdp,
            "nomAdherent" => $nom,
            "prenomAdherent" => $prenom,
            "email" => $email,
            "dateAdhesion" => $dateAdhesion,
            "numCategorie" => 1,
            "isAdmin" => 0,
            "champValidationEmail" => $champValidationEmail,
        ];
        Adherent::addObjet($tabObjets);




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
            $phpmailer->addAddress("$email", "$prenom $nom");
            $phpmailer->isHTML(true);
            $phpmailer->Subject = 'Authentification à deux facteurs';
            $phpmailer->Body = "Bonjour $prenom $nom, <br> Veuillez cliquer sur le lien ci-dessous pour valider votre adresse email : <br> <a href='http://local.lpprism.fr/index.php?controleur=AdherentControleur&action=validerCompteAdherent&login=$login&champValidationEmail=$champValidationEmail'>Valider mon adresse email</a>";
            $phpmailer->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }
        $message = "Votre compte a bien été créé !";
        include "views/debut.php";
        include "views/notifLienValidation.html";
        include "views/fin.html";
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

    public static function validerCompteAdherent()
    {
        $login = $_GET['login'];
        $ch = $_GET['champValidationEmail'];

        if (Adherent::validateAccount($login, $ch)){
            include "views/debut.php";
            include "views/compteValide.html";
            include "views/fin.html";
        } else {
            echo "Erreur de validation !";
        }
    }
}