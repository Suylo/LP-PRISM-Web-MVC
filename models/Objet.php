<?php

class Objet{

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

}