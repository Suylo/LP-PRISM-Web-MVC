<?php

require_once "models/Categorie.php";

class CategorieControleur extends ObjetControleur {

    protected static $objet = "Categorie";
    protected static $cle = "numCategorie";
    protected static $champs = [
        "libelle" => ["Nom de la catégorie", "text"],
        "nbLivresAutorises" => ["Nb Livres", "number"]
    ];

}