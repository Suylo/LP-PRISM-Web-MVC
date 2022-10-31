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
        $tableauAffichage = array();
        $tableauAffichage[] = "<div class='ligne'><div>[N°<strong>" . static::$objet. "</strong>] " .  $numObjet. "</div><div></div></div>";
        include "views/debut.php";
        Session::menuUrl();
        include("views/lesObjets.php");
        include("views/fin.html");
    }

    public static function addObjet(){
        $titre = "Ajouter un " . strtolower(static::$objet);
        $fields = static::$champs;
        include "views/debut.php";
        Session::menuUrl();
        include("views/formAddObjet.php");
        include("views/fin.html");
    }

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