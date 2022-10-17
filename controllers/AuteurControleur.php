<?php
  require_once("models/Auteur.php");

  class AuteurControleur extends ObjetControleur {

    protected static $objet = "Auteur";
    protected static $cle = "numAuteur";
    protected static $champs = [
        "nom" => ["Nom", "text"],
        "prenom" => ["Prénom", "text"],
        "anneeNaissance" => ["Année de naissance", "date"]
    ];

    public static function creerAuteur(){
      $nom = $_GET['nom'];
      $prenom = $_GET['prenom'];
      $naissance = $_GET['anneeNaissance'];
      if(Auteur::addAuteur($nom, $prenom, $naissance)){
        $msg = "L'auteur a bien été ajouté !";
        header("Location: routeur.php?msg=" . $msg ."#modal__msg");
      } else {
        $msg = "L'auteur n'a pas pu être ajouté !";
        header("Location: routeur.php?msg=" . $msg . "#modal__msg");
      }
    }

    public static function modifierAuteur(){
        $numAuteur = $_GET['numAuteur'];
        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];
        $naissance = $_GET['anneeNaissance'];
        if(Auteur::updateAuteur($numAuteur, $nom, $prenom, $naissance)){
            $msg = "L'auteur $numAuteur a bien été modifié !";
            header("Location: routeur.php?msg=" . $msg ."#modal__msg");
        } else {
            $msg = "L'auteur $numAuteur n'a pas pu être modifié !";
            header("Location: routeur.php?msg=" . $msg . "#modal__msg");
        }
    }

  }

?>
