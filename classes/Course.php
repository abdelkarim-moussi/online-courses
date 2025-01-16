<?php
include_once "../config/DataBase.php";
class Course{
    private $teacherId;
    private $categorieId;
    private $title;
    private $content;
    private $launchDate;
    private $cover;


    public function __construct($teacherId,$categorieId,$title,$content,$launchDate,$cover){
        
        $this->teacherId = $teacherId;
        $this->categorieId = $categorieId;
        $this->title = $title;
        $this->content = $content;
        $this->launchDate = $launchDate;
        $this->cover = $cover;

    }

//getters and setters

    public function getTeacherId(){
        return $this->teacherId;
    }

    public function getCategoriId(){
        return $this->categorieId;
    }

    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        $this->title = $title;
    }

    public function getContent(){
        return $this->content;
    }
    public function setContent($content){
        $this->content = $content;
    }

    public function getLaunchDate(){
        return $this->launchDate;
    }
    public function setLaunchDate($launchDate){
        $this->launchDate = $launchDate;
    }

    public function getCover(){
        return $this->cover;
    }
    public function setCover($cover){
        $this->cover = $cover;
    }


    public static function changeCourseStatus($status,$courseId){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $changeCourseSTatus = $conn->prepare("UPDATE courses SET status = ? WHERE course_id = ?");
        $changeCourseSTatus->execute([$status,$courseId]);

    }
   
}