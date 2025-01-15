<?php

include_once "User.php";

class Teacher extends User{

    public function __construct($firstname,$lastname,$email, $role, $photo, $password){
        parent::__construct($firstname,$lastname,$email, $role, $photo, $password);
    }

  
}