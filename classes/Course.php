<?php
include_once "../config/DataBase.php";
include_once "../classes/Categorie.php";
include_once "../classes/Teacher.php";

class Course{
    
    private $courseId;
    private Teacher $teacher;
    private Categorie $categorie;
    private $title;
    private $content;
    private $launchDate;
    private $thumbnail;
    private $type;
    private $status;
    private $description;


    public function __construct(){
        
        $this->teacher = new Teacher();
        $this->categorie = new Categorie();

    }

//getters and setters

    public function getTeacher(){
        return $this->teacher;
    }
    public function setTeacher(Teacher $teacher){
        $this->teacher = $teacher;
        return $this;
    }

    public function getCategorie(){
        return $this->categorie;
    }
    public function setCategorie(Categorie $categorie){
        $this->categorie = $categorie;
        return $this;
    }

    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function getContent(){
        return $this->content;
    }
    public function setContent($content){
        $this->content = $content;
        return $this;
    }

    public function getLaunchDate(){
        return $this->launchDate;
    }
    public function setLaunchDate($launchDate){
        $this->launchDate = $launchDate;
        return $this;
    }

    public function getThumbnail(){
        return $this->thumbnail;
    }
    public function setThumbnail($thumbnail){
        $this->thumbnail = $thumbnail;
        return $this;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type){
        $this->type = $type;
        return $this;
    }

    public function getCourseId(){
        return $this->courseId;
    }

    public function setCourseId($id){
        $this->courseId = $id;
        return $this;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
        return $this;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
        return $this;
    }
   

   
}