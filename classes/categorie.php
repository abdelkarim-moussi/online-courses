<?php

class Categorie{
    
    private $categorieId;
    private $categorie_name;
    private $description;

    public function __construct(){

    }

    public function getCatName(){
        return $this->categorie_name;
    }

    public function setCatName($categorie_name){
        $this->categorie_name = $categorie_name;
        return $this;
    }

    public function getDescription(){
        return $this->description;
    }
    public function setDescription($description){
        $this->description = $description;
        return $this;
    }

    public function getCategorieId(){
        return $this->categorieId;
    }
    public function setCategorieId($categorieId){
        $this->categorieId = $categorieId;
        return $this;
    }



}