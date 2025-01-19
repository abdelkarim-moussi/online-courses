<?php

class Course_Tag{

    private $courseId;
    private $tagId;

    public function __construct(){

    }


    public function getCourseId(){
        return $this->courseId;
    }
    public function setCourseId($courseId){
        $this->courseId = $courseId;
        return $this;
    }
    public function getTagId(){
        return $this->tagId;
    }
    public function setTagId($tagId){
        $this->tagId = $tagId;
        return $this;
    }
}