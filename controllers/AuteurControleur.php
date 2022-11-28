<?php
require_once("models/Auteur.php");

class AuteurControleur extends ObjetControleur
{

    protected static $objet = "Auteur";
    protected static $cle = "numAuteur";
    protected static $champs = [
        "nom" => ["Nom", "text"],
        "prenom" => ["Prénom", "text"],
        "anneeNaissance" => ["Année de naissance", "date"]
    ];

    public static function ajouterNationaliteDeLAuteur()
    {
        $numAuteur = $_GET['numAuteur'];
        $numNationalite = $_GET['numNationalite'];
        Auteur::addNationaliteForAuteur($numAuteur, $numNationalite);
        header("Location: index.php?action=definirNationalites&controleur=AuteurControleur&numAuteur=" . $numAuteur);
    }

    public static function supprimerNationaliteDeLAuteur()
    {
        $numAuteur = $_GET['numAuteur'];
        $numNationalite = $_GET['numNationalite'];
        Auteur::deleteNationaliteForAuteur($numAuteur, $numNationalite);
        header("Location: index.php?action=definirNationalites&controleur=AuteurControleur&numAuteur=" . $numAuteur);
    }

    public static function definirNationalites()
    {
        $titre = "Gestion nationalités";
        $numAuteur = $_GET['numAuteur'];
        $tabNationalites = Auteur::getNationalitesByNumAuteur($numAuteur);
        $tabNonNationalites = Auteur::getNonNationalitesByNumAuteur($numAuteur);
        $tableauAffichage = array();
        if (isset($tabNationalites)) {
            foreach ($tabNationalites as $tabNationalite) {
                $tableauAffichage[] = "<div class='ligne'><div>[N°<strong>" . $tabNationalite->get("numNationalite") . "</strong>] " . $tabNationalite->get("pays") . " [" . $tabNationalite->get("abrege") . "] </div> <a class='bouton bouton-delete' href=\"index.php?controleur=" . static::$objet . "Controleur&action=supprimerNationaliteDeLAuteur&numAuteur=" . $numAuteur . "&numNationalite=" . $tabNationalite->get("numNationalite") . "\"><i class='bi bi-trash'></i></a></div>";
            }
        }
        $tableauAffichage[] = "<br style='margin-bottom: 25px'>";

        if (isset($tabNonNationalites)) {
            foreach ($tabNonNationalites as $tabNonNationalite) {
                $tableauAffichage[] = "<div class='ligne'><div>[N°<strong>" . $tabNonNationalite->get("numNationalite") . "</strong>] " . $tabNonNationalite->get("pays") . " [" . $tabNonNationalite->get("abrege") . "] </div> <a class='bouton bouton-add' href=\"index.php?controleur=" . static::$objet . "Controleur&action=ajouterNationaliteDeLAuteur&numAuteur=" . $numAuteur . "&numNationalite=" . $tabNonNationalite->get("numNationalite") . "\"><i class='bi bi-plus'></i></a></div>";
            }
        }
        include "views/debut.php";
        Session::menuUrl();
        include "views/lesObjets.php";
        include("views/fin.html");
    }
}

?>
