<?php

class Categorie{
    private $categorie_name;
    private $description;

    public function __construct($categorie_name,$description){
    
        $this->categorie_name = $categorie_name;
        $this->description = $description;

    }

    public function getCatName(){
        return $this->categorie_name;
    }
    public function setCatName($categorie_name){
        $this->categorie_name = $categorie_name;
    }

    public function getDescription(){
        return $this->description;
    }
    public function setDescription($description){
        $this->description = $description;
    }



}