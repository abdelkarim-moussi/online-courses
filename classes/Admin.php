<?php
include_once "Categorie.php";
include_once "User.php";
include_once "../config/DataBase.php";

class Admin extends User{

    public function __construct()
    {
        parent::__construct();
    }
   
}
