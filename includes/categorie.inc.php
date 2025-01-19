<?php
include_once "../classes/Categorie.php";
include_once "../dao/CategorieDao.php";

$catDao = new CategorieDao();

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST["add-categorie"])){
    $catName = htmlspecialchars($_POST["categorie-name"]);
    $catDesc = htmlspecialchars($_POST["categorie-description"]);

    if(!empty($catName) && !empty($catDesc)){
        $categorie = new Categorie();
        $categorie->setCatName($catName);
        $categorie->setDescription($catDesc);
        $catDao -> createCategorie($categorie);
        header("Location: ../public/adminDashboard.php");

    }
    else header("Location: ../public/adminDashboard.php?error");

    }

}


if(isset($_POST["update-categorie"])){
    $categorieName = htmlspecialchars($_POST["up-cat-name"]);
    $categorieDescription = htmlspecialchars($_POST["up-cat-description"]);
    $categorieId = htmlspecialchars($_POST["up-cat-id"]);

    if(!empty($categorieName) && !empty($categorieDescription)){
        $categorie = new Categorie();

        $categorie->setCatName($categorieName);
        $categorie->setCategorieId($categorieId);
        $categorie->setDescription($categorieDescription);

        $catDao->UpdateCategorie($categorie);

        header("Location: ../public/adminDashboard.php");
    }
    
}

if(isset($_GET["idcat"])){
    
    $categorieId = $_GET["idcat"];

    $catDao->deleteCategorie($categorieId);

    header("Location: ../public/adminDashboard.php");
}