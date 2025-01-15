<?php

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST["add-categorie"])){
    $catName = $_POST["categorie-name"];
    $catDesc = $_POST["categorie-description"];

    if(isset($catName) && isset($catDesc)){
        
        $categorie = new Categorie($catName,$catDesc);
        $adm = new Admin("","","","","","");
        $adm -> createCategorie($categorie);

        header("Location: ../public/adminDash.php");

    }
    }

}