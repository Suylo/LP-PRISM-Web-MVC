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

    public static function ajouterAuteurDuLivre(){
        $numLivre = $_GET['numLivre'];
        $numAuteur = $_GET['numAuteur'];
        Livre::addAuteurForLivre($numLivre, $numAuteur);
        header("Location: routeur.php?action=definirAuteurs&controleur=LivreControleur&numLivre=" . $numLivre);
    }

    public static function supprimerAuteurDuLivre(){
        $numLivre = $_GET['numLivre'];
        $numAuteur = $_GET['numAuteur'];
        Livre::deleteAuteurForLivre($numLivre, $numAuteur);
        header("Location: routeur.php?action=definirAuteurs&controleur=LivreControleur&numLivre=" . $numLivre);
    }

    public static function definirAuteurs(){
        $titre = "Auteurs du livre";
        $numLivre = $_GET['numLivre'];
        $tableauAuteursDuLivre = Livre::getAuteursByNumLivre($numLivre);
        $tabNonAuteursDuLivre = Livre::getNonAuteursByNumLivre($numLivre);
        $tableauAffichage = array();
        if (isset($tableauAuteursDuLivre)) {
            foreach ($tableauAuteursDuLivre as $tabAuteurs){
                $tableauAffichage[] = "<div class='ligne'><div>[N°<strong>" . $tabAuteurs->get("numAuteur"). "</strong>] " .  $tabAuteurs->get("nom") . " " . $tabAuteurs->get("prenom")  . "</div> <a class='bouton bouton-delete' href=\"routeur.php?controleur=" . static::$objet . "Controleur&action=supprimerAuteurDuLivre&numAuteur=" . $tabAuteurs->get("numAuteur") . "&numLivre=$numLivre\"><i class='bi bi-trash'></i></a></div>";
            }
        }
        $tableauAffichage[] = "<br style='margin-bottom: 25px'>";
        if (isset($tabNonAuteursDuLivre)){
            foreach ($tabNonAuteursDuLivre as $nonAuteurs){
                $tableauAffichage[] = "<div class='ligne'><div>[N°<strong>" . $nonAuteurs->get("numAuteur"). "</strong>] " .  $nonAuteurs->get("nom") . " " . $nonAuteurs->get("prenom") . "</div><a class='bouton bouton-add' href=\"routeur.php?controleur=" . static::$objet . "Controleur&action=ajouterAuteurDuLivre&numAuteur=" . $nonAuteurs->get("numAuteur"). "&numLivre=$numLivre\"><i class='bi bi-plus'></i></a></div>";
            }
        }
        include "views/debut.php";
        include("views/menu.php");
        include "views/lesObjets.php";
        include("views/fin.html");
    }

}