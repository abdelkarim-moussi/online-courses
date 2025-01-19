<?php
include_once "../config/DataBase.php";

class User{

    private $id;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $role;
    private string $photo;
    private string $password;
    private string $status;
    private string $fullname;

    public function __construct(){
    
    }

    //firstname getter and setter
    public function getFirstName(){
        return $this->firstname;
    }
    public function setFirstName($firstname){
      $this->firstname = $firstname;
      return $this;
    }

    //lastname getter and setter
    public function getLastName(){
        return $this->lastname;
    }
    public function setLastName($lastname){
      $this->lastname = $lastname;
      return $this;
    }

    //email getter and setter
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
      $this->email = $email;
      return $this;
    }

    //role getter and setter
    public function getRole(){
        return $this->role;
    }
    public function setRole($role){
      $this->role = $role;
      return $this;
    }

    //photo getter and setter
    public function getPhoto(){
        return $this->photo;
    }
    public function setphoto($photo){
      $this->photo = $photo;
      return $this;
    }

    //password getter and setter
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
      $this->password = $password;
      return $this;
    }

    //status getter and setter
    public function getStatus(){
        return $this->status;
    }
    public function setStatus($status){
      $this->status = $status;
      return $this;
    }

    //id getter and setter
    public function getId(){
        return $this->id;
    }
    public function setId($id){
      $this->id = $id;
      return $this;
    }
   
    //fullname
    public function getFullName(){
      return $this->fullname;
    }
    public function setFullName($fullname){
      $this->fullname = $fullname;
      return $fullname;
    }
}

