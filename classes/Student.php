<?php

include_once "User.php";

class Student extends User{

    public function __construct($firstname,$lastname,$email, $role, $photo, $password){
        parent::__construct($firstname,$lastname,$email, $role, $photo, $password);
    }


    
  
}