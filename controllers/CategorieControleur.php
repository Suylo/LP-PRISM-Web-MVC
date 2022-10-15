<?php

require_once "models/Categorie.php";

class CategorieControleur extends ObjetControleur {

    protected static $objet = "Categorie";
    protected static $cle = "numCategorie";
    protected static $champs = [
        "libelle" => ["Nom de la catégorie", "text"],
        "nbLivresAutorises" => ["Nb Livres", "number"]
    ];


    public static function creerCategorie(){
        $libelle = $_GET['libelle'];
        $nbLivres = $_GET['nbLivresAutorises'];
        if(Categorie::addCategorie($libelle, $nbLivres)){
            $msg = "La catégorie a bien été ajoutée !";
            header("Location: routeur.php?action=lireObjets&controleur=CategorieControleur&msg=" . $msg ."#modal__msg");
        } else {
            $msg = "La catégorie n'a pas pu être ajoutée !";
            header("Location: routeur.php?action=lireObjets&controleur=CategorieControleur&msg=" . $msg . "#modal__msg");
        }
    }

    public static function modifierCategorie(){
        $numCategorie = $_GET['numCategorie'];
        $libelle = $_GET['libelle'];
        $nbLivres = $_GET['nbLivresAutorises'];
        if(Categorie::updateCategorie($numCategorie, $libelle, $nbLivres)){
            $msg = "La catégorie $numCategorie a bien été modifiée !";
            header("Location: routeur.php?action=lireObjets&controleur=CategorieControleur&msg=" . $msg ."#modal__msg");
        } else {
            $msg = "La catégorie $numCategorie n'a pas pu être modifiée !";
            header("Location: routeur.php?action=lireObjets&controleur=CategorieControleur&msg=" . $msg . "#modal__msg");
        }
    }
}