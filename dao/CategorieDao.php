<?php
include_once "../config/DataBase.php";
include_once "../classes/Categorie.php";

class CategorieDao{

    private $connection;

    public function __construct(){

        $db = DataBase::getInstance();
        $this->connection = $db->getConnection();

    }

    public function getCategorieByName($catName){

        $stmt = $this->connection->prepare("SELECT * FROM categories WHERE categorie_name = :catname");
        $stmt->bindParam(":catname",$catName);
        $stmt->execute();
        $row = $stmt->fetch();
        $categorie = new Categorie();
        $categorie->setCategorieId($row["categorie_id"]);
        return $categorie;

    }

    public function showCategories(){

        $selectCat = $this->connection->query("SELECT * FROM categories");
        $categories = [];

        while($result = $selectCat->fetch()){
            $categorie = new Categorie();
            $categorie->setCatName($result["categorie_name"]);
            $categorie->setCategorieId($result["categorie_id"]);
            $categorie->setDescription($result["categorie_description"]);
            array_push($categories,$categorie);
        }
        return $categories;

    }

    private function checkCategorie($column,$value){

        $select = $this->connection->prepare("SELECT * FROM categories WHERE $column = :catname");
        $select->bindParam(":catname",$value);
        $select->execute();
        $row = $select->fetch();
        if($row){
            return true;
        }
        else return false;
    }

    public function createCategorie(Categorie $categorie){

        $catName = $categorie->getCatName();
        $catDescription = $categorie->getDescription();

        if($this->checkCategorie("categorie_name",$catName)){
            return "categorie exist";
        }

        else{

            $sql = $this->connection->prepare("INSERT INTO categories (categorie_name,categorie_description) VALUES(:catname,:catdescription)");
            $sql->bindParam(":catname",$catName);
            $sql->bindParam(":catdescription",$catDescription);

            if( $sql->execute()){
                return "done";
            }
            else return "execution failed";

        }
            

    }


    public function showCoursesNumByCat(){

        $selectNumAr = $this->connection->query("SELECT count(*) as num FROM courses INNER JOIN categories WHERE courses.categorie_id = categories.categorie_id");
        $result = $selectNumAr->fetch();
        return $result;

    }
   
    public function deleteCategorie($idcategorie){
        
       try{
        if($this->checkCategorie("categorie_id",$idcategorie)){

            $deletQuery = $this->connection->prepare("DELETE FROM categories WHERE categorie_id = :idcategorie");
            $deletQuery->bindParam(":idcategorie",$idcategorie);
            
            if($deletQuery->execute()){

                return "categorie deleted";
            }
            else return "error deleting categorie";

        }
        else return 'categorie not exist';

       }catch(PDOException $e){
         die("error execution".$e->getMessage());
       }
        
    }

    public function UpdateCategorie(Categorie $categorie){

        $catName = $categorie->getCatName();
        $catDescription = $categorie->getDescription();
        $categorieId = $categorie->getCategorieId();

        if($this->checkCategorie("categorie_id",$categorieId)){

            $updateCat = $this->connection->prepare("UPDATE categories 
            SET categorie_name = :name, categorie_description = :description
            WHERE categorie_id = :id");
            $updateCat->bindParam(":name",$catName);
            $updateCat->bindParam(":description",$catDescription);
            $updateCat->bindParam(":id",$categorieId);
            
            if($updateCat->execute()){
                return "categorie uodated succefully";
            }
            else return "categorie update error";

        }
    
    }
}

