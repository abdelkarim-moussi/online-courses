<?php
include_once "../classes/Categorie.php";
include_once "../classes/Admin.php";

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST["add-categorie"])){
    $catName = htmlspecialchars($_POST["categorie-name"]);
    $catDesc = htmlspecialchars($_POST["categorie-description"]);

    if(isset($catName) && isset($catDesc)){
        
        $categorie = new Categorie($catName,$catDesc);
        $admin = new Admin("","","","","","");
        $admin -> createCategorie($categorie);
        header("Location: ../public/adminDashboard.php");

    }
    }

}


if(isset($_POST["update-categorie"])){
    $categorieName = htmlspecialchars($_POST["up-cat-name"]);
    $categorieDescription = htmlspecialchars($_POST["up-cat-description"]);
    $categorieId = htmlspecialchars($_POST["up-cat-id"]);

    if(!empty($categorieName) && !empty($categorieDescription)){
        $categorie = new Categorie($categorieName,$categorieDescription);
        $admin = new Admin("","","","","","");
        $admin->UpdateCategorie($categorieId,$categorie);

        header("Location: ../public/adminDashboard.php");
    }
    
}

if(isset($_GET["idcat"])){
    $categorieId = $_GET["idcat"];
    $admin = new Admin("","","","","","");
    $admin->deleteCategorie($categorieId);

    header("Location: ../public/adminDashboard.php");
}