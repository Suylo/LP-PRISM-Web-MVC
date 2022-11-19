<?php
    require_once "models/Session.php";
    require_once("models/Connexion.php");
    require_once("models/Objet.php");
    Connexion::connect();
    require_once("controllers/ObjetControleur.php");
    require_once("controllers/AuteurControleur.php");
    require_once("controllers/AdherentControleur.php");
    require_once("controllers/LivreControleur.php");
    require_once("controllers/GenreControleur.php");
    require_once("controllers/CategorieControleur.php");
    require_once("controllers/NationaliteControleur.php");

if (!Session::userConnected() && !Session::userConnecting() && Session::userCreatingAccount() && Session::userValidatingAccount()) {
    if (!empty($_GET['action']) && !empty($_GET['controleur']) && in_array($_GET["action"],get_class_methods($_GET['controleur']))) {
        $action = $_GET["action"];
        $controleur = $_GET['controleur'];
        $controleur::$action();
    } else {
        $controleur = "AdherentControleur";
        $_GET['controleur'] = "AdherentControleur";
        $_GET['action'] = 'afficherFormulaireConnexion';
        $action = "afficherFormulaireConnexion";
        $controleur::$action();
    }
} else {
    if (!empty($_GET['action']) && !empty($_GET['controleur']) && in_array($_GET["action"],get_class_methods($_GET['controleur']))) {
        $action = $_GET["action"];
        $controleur = $_GET['controleur'];
        $controleur::$action();
    } else {
        $controleur = "AuteurControleur";
        $_GET['controleur'] = "AuteurControleur";
        $_GET['action'] = 'lireObjets';
        $action = "lireObjets";
        $controleur::$action();
    }
}
