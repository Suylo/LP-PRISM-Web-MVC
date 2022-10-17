<?php

require_once "models/Genre.php";

class GenreControleur extends ObjetControleur {

    protected static $objet = "Genre";
    protected static $cle = "numGenre";
    protected static $champs = [
        "intitule" => ["Nom du genre", "text"]
    ];

    public static function creerGenre(){
        $intitule = $_GET['intitule'];
        if(Genre::addGenre($intitule)){
            $msg = "Le genre a bien été ajouté !";
            header("Location: routeur.php?action=lireObjets&controleur=GenreControleur&msg=" . $msg ."#modal__msg");
        } else {
            $msg = "Le genre n'a pas pu être ajouté !";
            header("Location: routeur.php?action=lireObjets&controleur=GenreControleur&msg=" . $msg . "#modal__msg");
        }
    }

    public static function modifierGenre(){
        $numGenre = $_GET['numGenre'];
        $intitule = $_GET['intitule'];
        if(Genre::updateGenre($numGenre, $intitule)){
            $msg = "Le genre $numGenre a bien été modifié !";
            header("Location: routeur.php?action=lireObjets&controleur=GenreControleur&msg=" . $msg ."#modal__msg");
        } else {
            $msg = "Le genre $numGenre n'a pas pu être modifié !";
            header("Location: routeur.php?action=lireObjets&controleur=GenreControleur&msg=" . $msg . "#modal__msg");
        }
    }
}