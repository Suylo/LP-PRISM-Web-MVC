<?php

class ObjetControleur
{
    public static function lireObjets(){
        $titre = "Les " . strtolower(static::$objet). "s";
        $tableauAffichage = array();
        static::$objet::getAllObjets();
        foreach(static::$objet::getAllObjets() as $objet){
            $numObjet = $objet->get(static::$cle);
            $lienDetails = "<a class='bouton' href=\"routeur.php?controleur=" . static::$objet . "Controleur&action=lireObjet&num" .static::$objet . "=$numObjet\"> détails </a>";
            $tableauAffichage[] = "<div class='ligne'><div>[N°<strong>" . $numObjet. "</strong>] " .  static::$objet. "</div><div> $lienDetails</div></div>";
        }
        include("views/debut.php");
        include("views/menu.php");
        include "views/lesObjets.php";
        include("views/fin.html");
    }

    public static function lireObjet(){
        $titre = "Un " . strtolower(static::$objet) . " : " . $_GET['num'.static::$objet];
        $numObjet = $_GET["num".static::$objet];
        $objet = static::$objet::getObjetById($numObjet);
        $tableauAffichage = array();
        $tableauAffichage[] = "<div class='ligne'><div>[N°<strong>" . static::$objet. "</strong>] " .  $numObjet. "</div><div></div></div>";
        include("views/debut.php");
        include("views/menu.php");
        include("views/lesObjets.php");
        include("views/fin.html");
    }

    public static function addObjet(){
        $titre = "Ajouter un " . strtolower(static::$objet);
        include("views/debut.php");
        include("views/menu.php");
        include("views/formAddAuteur.php");
        include("views/fin.html");
    }

}