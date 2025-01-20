<?php
include_once "../classes/User.php";
include_once "../classes/Course.php";

class JoinedCourse{

    private Course $course;
    private User $user;

    public function __construct(){

    }


    public function getCourse(){
        return $this->course;
    }
    public function setCourse(Course $course){
        $this->course = $course;
        return $this;
    }
    public function getUser(){
        return $this->user;
    }
    public function setUser(User $user){
        $this->user = $user;
        return $this;
    }

}