<?php

class Objet{


    public function affichable() { return true; }

    public function __construct($data = NULL){
        if(!is_null($data)){
            foreach ($data as $k => $v){
                $this->set($k, $v);
            }
        }
    }

    public function get($attribut){
        return $this->$attribut;
    }


    public function set($attribut, $valeur){
        $attribut = $valeur;
    }

    public static function getAllObjets(){
        $table = static::$objet;
        $requete = "SELECT * FROM $table;";
        $resultat = Connexion::pdo()->query($requete);
        $resultat->setFetchmode(PDO::FETCH_CLASS, $table);
        $tableau = $resultat->fetchAll();
        return $tableau;
    }

    // get objet by id
    public static function getObjetById($id){
        $table = static::$objet;
        $cle = static::$cle;
        $requete = "SELECT * FROM $table WHERE $cle = :id_tag;";
        $req_prep = Connexion::pdo()->prepare($requete);
        $valeurs = array("id_tag" => $id);
        try {
            $req_prep->execute($valeurs);
            $req_prep->setFetchmode(PDO::FETCH_CLASS, $table);
            $a = $req_prep->fetch();
            return $a;
        } catch(PDEException $e) {
            echo $e->getMessage();
        }
    }

    // delete objet by id
    public static function deleteObjetById($id){
        $table = static::$objet;
        $cle = static::$cle;
        $requete = "DELETE FROM $table WHERE $cle = :id_tag;";
        $req_prep = Connexion::pdo()->prepare($requete);
        $valeurs = array("id_tag" => $id);
        try {
            $req_prep->execute($valeurs);
            return true;
        } catch(PDEException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public static function addObjet($tableauDonnes)
    {
        $table = static::$objet;
        $cle = static::$cle;

        $requete = "INSERT INTO $table (";
        $i = 0;
        foreach ($tableauDonnes as $k => $v) {
            if ($i == 0) {
                $requete .= $k;
            } else {
                $requete .= ", " . $k;
            }
            $i++;
        }
        $requete .= ") VALUES (";
        $i = 0;
        foreach ($tableauDonnes as $k => $v) {
            if ($i == 0) {
                $requete .= ":" . $k;
            } else {
                $requete .= ", :" . $k;
            }
            $i++;
        }
        $requete .= ");";
        $req_prep = Connexion::pdo()->prepare($requete);
        try {
            $req_prep->execute($tableauDonnes);
            return true;
        } catch (PDOException $e) {
            echo $requete . "\n";
            echo "Erreur d'ajout : " . $e->getMessage();
            die();
            return false;
        }
    }

    public static function updateObjet($tableauDonnes, $id){
        $table = static::$objet;
        $cle = static::$cle;
        $requete = "UPDATE $table SET ";
        $i = 0;
        foreach ($tableauDonnes as $k => $v) {
            if ($i == 0) {
                $requete .= $k . " = :" . $k;
            } else {
                $requete .= ", " . $k . " = :" . $k;
            }
            $i++;
        }
        $requete .= " WHERE $cle = :id_tag;";
        $tableauDonnes["id_tag"] = $id;
        $req_prep = Connexion::pdo()->prepare($requete);
        try {
            $req_prep->execute($tableauDonnes);
            return true;
        } catch (PDOException $e) {
            echo $requete . "\n";
            echo "Erreur d'ajout : " . $e->getMessage();
            die();
            return false;
        }
    }
}