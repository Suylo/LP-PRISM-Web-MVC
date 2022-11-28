<?php

class ObjetControleur
{
    public static function lireObjets(){
        $titre = "Les " . strtolower(static::$objet). "s";
        $tableauAffichage = array();
        static::$objet::getAllObjets();
        foreach(static::$objet::getAllObjets() as $objet){
            $numObjet = $objet->get(static::$cle);
            $lienDetails = "<a class='bouton bouton-see' href=\"index.php?controleur=" . static::$objet . "Controleur&action=lireObjet&num" .static::$objet . "=$numObjet\"><i class='bi bi-eye'></i></a>";
            $lienEdit = "<a class='bouton bouton-edit' href=\"index.php?controleur=" . static::$objet . "Controleur&action=editObjet&num" .static::$objet . "=$numObjet\"><i class='bi bi-pencil'></i></a>";
            $lienDelete = "<a class='bouton bouton-delete' href=\"index.php?controleur=" . static::$objet . "Controleur&action=deleteObjet&num" .static::$objet . "=$numObjet\"><i class='bi bi-trash'></i></a>";
            $lienLivre = "<a class='bouton bouton-livre' href=\"index.php?controleur=" . static::$objet . "Controleur&action=definirAuteurs&num" .static::$objet . "=$numObjet\"><i class='bi bi-pencil-square'></i></a>";
            $lienAuteurs = "<a class='bouton bouton-nationalite' href=\"index.php?controleur=AuteurControleur&action=definirNationalites&num" .static::$objet . "=$numObjet\"><i class='bi bi-flag'></i></a>";
            if (Session::adminConnected()){
                if(static::$objet == "Auteur"){
                    $tableauAffichage[] = "
                    <div class='ligne'>
                        <div>
                           
                            [N°<strong>" . $numObjet. "</strong>] " .  $objet->afficher() . "
                        </div>
                        <div> 
                            $lienAuteurs&nbsp;&nbsp;$lienDetails&nbsp;$lienEdit&nbsp;$lienDelete
                        </div>
                    </div>
                ";
                } else if (static::$objet == "Livre") {
                    $tableauAffichage[] = "<div class='ligne'><div>[N°<strong>" . $numObjet . "</strong>] " . $objet->afficher() . "</div><div> $lienLivre&nbsp;&nbsp;$lienDetails&nbsp;$lienEdit&nbsp;$lienDelete</div> </div>";
                } else {
                    $tableauAffichage[] = "<div class='ligne'><div>[N°<strong>" . $numObjet. "</strong>] " .  $objet->afficher() . "</div><div> $lienDetails&nbsp;$lienEdit&nbsp;$lienDelete</div> </div>";
                }
            } else {
                $tableauAffichage[] = "<div class='ligne'><div>[N°<strong>" . $numObjet. "</strong>] " .  $objet->afficher() . "</div><div> $lienDetails</div> </div>";

            }
        }
        include "views/debut.php";
        Session::menuUrl();
        include "views/lesObjets.php";
        include("views/fin.html");
    }

    public static function lireObjet(){
        $titre = "Un " . strtolower(static::$objet) . " : " . $_GET['num'.static::$objet];
        $numObjet = $_GET["num".static::$objet];
        $objet = static::$objet::getObjetById($numObjet);
        $objetPrint = $objet->afficher();
        $tableauAffichage = array();
        $tableauAffichage[] = "<div class='ligne'><div>[N°<strong>" . static::$objet. "</strong>] " .  $objetPrint. "</div><div></div></div>";
        include "views/debut.php";
        Session::menuUrl();
        include("views/lesObjets.php");
        include("views/fin.html");
    }

    /**
     * @return void VUE FORMULAIRE ADD
     */
    public static function addObjet(){
        $titre = "Ajouter un " . strtolower(static::$objet);
        $fields = static::$champs;
        include "views/debut.php";
        Session::menuUrl();
        include("views/formAddObjet.php");
        include("views/fin.html");
    }

    /**
     * @return void VUE FORMULAIRE EDIT
     */
    public static function editObjet(){
        $titre = "Modifier un " . strtolower(static::$objet);
        $numObjet = $_GET["num".static::$objet];
        $objet = static::$objet::getObjetById($numObjet);
        $fields = static::$champs;
        include "views/debut.php";
        Session::menuUrl();
        include("views/formEditObjet.php");
        include("views/fin.html");
    }


    /**
     * @return void - FONCTION CREATION
     */
    public static function creerObjet()
    {
        $table = static::$objet;

        $tableauDonnees = $_GET;
        unset($tableauDonnees['controleur']);
        unset($tableauDonnees['action']);
        if (static::$objet == "Adherent") {
            $tableauDonnees['numCategorie'] = 1;
            $tableauDonnees['champValidationEmail'] = bin2hex(openssl_random_pseudo_bytes(16));
        }

        $newObjet = $table::addObjet($tableauDonnees);
        if ($newObjet) {
            $msg = "$table créé avec succès";
            header("Location: index.php?action=lireObjets&controleur=" . $table . "Controleur&msg=" . $msg ."#modal__msg");
        } else {
            $msg = "Erreur lors de la création de $table";
            header("Location: index.php?action=lireObjets&controleur=" . $table . "Controleur&msg=" . $msg ."#modal__msg");
        }
    }

    /**
     * @return void - FONCTION MODIFICATION
     */
    public static function modifierObjet(){
        $table = static::$objet;

        $tableauDonnees = $_GET;
        unset($tableauDonnees['controleur']);
        unset($tableauDonnees['action']);
        $numObjet = $_GET["num".static::$objet];
        if ($table == "Adherent") {
            $updateObjet = $table::updateObjet($tableauDonnees, $tableauDonnees["login"]);
        } else {
            $updateObjet = $table::updateObjet($tableauDonnees, $numObjet);
        }
        if ($updateObjet){
            $msg = "$table modifié avec succès";
            header("Location: index.php?action=lireObjets&controleur=" . $table . "Controleur&msg=" . $msg ."#modal__msg");
        } else {
            $msg = "Erreur lors de la modification de $table";
            header("Location: index.php?action=lireObjets&controleur=" . $table . "Controleur&msg=" . $msg ."#modal__msg");
        }
    }



    public static function deleteObjet(){
        $titre = "Supprimer un " . strtolower(static::$objet);
        $numObjet = $_GET["num".static::$objet];
        if(static::$objet::deleteObjetById($numObjet)){
            $msg = "Suppression réussie";
        }else{
            $msg = "Suppression échouée";
        }
        header("Location: index.php?controleur=" . static::$objet . "Controleur&action=lireObjets&msg=$msg" . "#modal__msg");

    }

}