<?php
include_once "../classes/Course.php";
include_once "../classes/Tag.php";
class Course_Tag{

    private Course $course;
    private Tag $tag;

    public function __construct(){

    }


    public function getCourse(){
        return $this->course;
    }
    public function setCourse(Course $course){
        $this->course = $course;
        return $this;
    }
    public function getTag(){
        return $this->tag;
    }
    public function setTag(Tag $tag){
        $this->tag = $tag;
        return $this;
    }
}