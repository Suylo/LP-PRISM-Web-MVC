<?php

require_once "models/Livre.php";

class LivreControleur extends ObjetControleur {

    protected static $objet = "Livre";
    protected static $cle = "numLivre";
    protected static $champs = [
        "titre" => ["Titre", "text"],
        "anneeParution" => ["Année de Parution", "date"],
    ];

    public static function creerLivre(){
        $titre = $_GET['titre'];
        $annee = $_GET['anneeParution'];
        if(Livre::addLivre($titre, $annee, 1)){
            $msg = "Le livre a bien été ajouté !";
            header("Location: routeur.php?action=lireObjets&controleur=LivreControleur&msg=" . $msg ."#modal__msg");
        } else {
            $msg = "Le livre n'a pas pu être ajouté !";
            header("Location: routeur.php?action=lireObjets&controleur=LivreControleur&msg=" . $msg . "#modal__msg");
        }
    }

    public static function modifierLivre(){
        $numLivre = $_GET['numLivre'];
        $titre = $_GET['titre'];
        $annee = $_GET['anneeParution'];
        if(Livre::updateLivre($numLivre, $titre, $annee, 1)){
            $msg = "Le livre $numLivre a bien été modifié !";
            header("Location: routeur.php?action=lireObjets&controleur=LivreControleur&msg=" . $msg ."#modal__msg");
        } else {
            $msg = "Le livre $numLivre n'a pas pu être modifié !";
            header("Location: routeur.php?action=lireObjets&controleur=LivreControleur&msg=" . $msg . "#modal__msg");
        }
    }
}