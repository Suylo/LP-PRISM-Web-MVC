<?php

require_once "models/Nationalite.php";

class NationaliteControleur extends ObjetControleur {

    protected static $objet = "Nationalite";
    protected static $cle = "numNationalite";
    protected static $champs = [
        "pays" => ["Pays", "text"],
        "abrege" => ["Code abrégé", "text"]
    ];


    public static function creerNationalite(){
        $pays = $_GET['pays'];
        $abrege = $_GET['abrege'];
        if(Nationalite::addNationalite($pays, $abrege)){
            $msg = "La nationalité a bien été ajoutée !";
            header("Location: index.php?action=lireObjets&controleur=NationaliteControleur&msg=" . $msg ."#modal__msg");
        } else {
            $msg = "La nationalité n'a pas pu être ajoutée !";
            header("Location: index.php?action=lireObjets&controleur=NationaliteControleur&msg=" . $msg . "#modal__msg");
        }
    }

    public static function modifierNationalite(){
        $numNationalite = $_GET['numNationalite'];
        $pays = $_GET['pays'];
        $abrege = $_GET['abrege'];
        if(Nationalite::updateNationalite($numNationalite, $pays, $abrege)){
            $msg = "La nationalité $numNationalite a bien été modifiée !";
            header("Location: index.php?action=lireObjets&controleur=NationaliteControleur&msg=" . $msg ."#modal__msg");
        } else {
            $msg = "La nationalité $numNationalite n'a pas pu être modifiée !";
            header("Location: index.php?action=lireObjets&controleur=NationaliteControleur&msg=" . $msg . "#modal__msg");
        }
    }
}