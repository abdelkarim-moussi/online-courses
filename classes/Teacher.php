<?php
include_once "User.php";
include_once "Course.php";

class Teacher extends User{

    public function __construct(){
        parent::__construct();
    }
  
}