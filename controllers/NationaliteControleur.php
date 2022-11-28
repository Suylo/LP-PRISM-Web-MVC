<?php

require_once "models/Nationalite.php";

class NationaliteControleur extends ObjetControleur {

    protected static $objet = "Nationalite";
    protected static $cle = "numNationalite";
    protected static $champs = [
        "pays" => ["Pays", "text"],
        "abrege" => ["Code abrégé", "text"]
    ];

}