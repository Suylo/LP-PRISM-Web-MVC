<?php

class Categorie extends Objet
{

    protected $numCategorie;
    protected $libelle;
    protected $nbLivresAutorises;
    protected static $cle = "numCategorie";
    protected static $objet = "Categorie";

    public function __construct($data = NULL)
    {
        parent::__construct($data);
    }

    public function get($attribut)
    {
        return parent::get($attribut); // TODO: Change the autogenerated stub
    }

    public function set($attribut, $valeur)
    {
        parent::set($attribut, $valeur); // TODO: Change the autogenerated stub
    }

    public function afficher(){
        return $this->get('libelle');
    }
}