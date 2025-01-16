<?php
include_once "Categorie.php";
include_once "User.php";
include_once "../config/DataBase.php";

class Admin extends User{

    public function createCategorie(Categorie $categorie){

        if(!empty($categorie->getCatName()) && !empty($categorie->getDescription())){
            $db = DataBase::getInstance();
            $conn = $db->getConnection();

            $sql = $conn->prepare("INSERT INTO categories (categorie_name,categorie_description) VALUES(?,?)");
            $sql->execute([$categorie->getCatName(),$categorie->getDescription()]);
            
        }
        else return $ex = new Exception("categorie name and description can't be empty");

    }

    public function showCategories(){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $selectCat = $conn->query("SELECT * FROM categories");
        return $result = $selectCat->fetchAll();

    }

    public function showCoursesNumByCat(){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $selectNumAr = $conn->query("SELECT count(*) num FROM courses INNER JOIN categories WHERE courses.categorie_id = categories.categorie_id");
        return $result = $selectNumAr->fetchAll();

    }
   
    public function deleteCategorie($idcategorie){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();
        
        $deletQuery = $conn->prepare("DELETE FROM categories WHERE categorie_id = :idcategorie");
        $deletQuery->bindParam(":idcategorie",$idcategorie);
        $deletQuery->execute();
    }

    public function UpdateCategorie($categorieId,Categorie $categorie){

        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $updateCat = $conn->prepare("UPDATE categories 
        SET categorie_name = :name, categorie_description = :description
        WHERE categorie_id = :id");
        $updateCat->bindParam(":name",$categorie->getCatName());
        $updateCat->bindParam(":description",$categorie->getDescription());
        $updateCat->bindParam(":id",$categorieId);
        $updateCat->execute();
    }

    public function showCourses(){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $selectCoureses = $conn->query("SELECT * FROM courses INNER JOIN users WHERE courses.user_id = users.user_id");
        $selectCoureses->execute();
        return $result = $selectCoureses->fetchAll();

    }

    public function getNumCourses(){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $numCourses = $conn->prepare("SELECT count(*) AS num FROM courses");
        $numCourses->execute();
        $result = $numCourses->fetch();
        return $result;

    }

    public function getCoursesByStatus($status){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $selectNumCoursesByStat = $conn->prepare("SELECT count(*) AS num FROM courses WHERE status = ?");
        $selectNumCoursesByStat->execute([$status]);
        $result = $selectNumCoursesByStat->fetch();
        return $result;

    }

    public function showUsersByRole($role){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $selectUsersByRole = $conn->prepare("SELECT * FROM users WHERE role = ?");
        $selectUsersByRole->execute([$role]);
        $result = $selectUsersByRole->fetchAll();
        return $result;

    }

    public function calcCoursesForUser($userId){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $selectUserCoursesNum = $conn->prepare("SELECT COUNT(*) AS numcourses FROM courses 
        WHERE user_id = ?");
        $selectUserCoursesNum->execute([$userId]);
        $result = $selectUserCoursesNum->fetch();
        return $result;

    }
   
}
