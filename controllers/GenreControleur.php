<?php

require_once "models/Genre.php";

class GenreControleur extends ObjetControleur {

    protected static $objet = "Genre";
    protected static $cle = "numGenre";
    protected static $champs = [
        "intitule" => ["Nom du genre", "text"]
    ];

}