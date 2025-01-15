<?php
include_once "../classes/Visitor.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    $email = $_POST["email"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $role = $_POST["role"];
    $password = $_POST["password"];
    $passConfirm = $_POST["confirm-password"];

    $filename = $_FILES["image"]["name"];
    $fileTmpName = $_FILES["image"]["tmp_name"];
    $photo = uniqid() ."-" .$filename;
    move_uploaded_file($fileTmpName,"../profile-imgs/".$photo);

    if(empty($email) || empty($firstname) || empty($lastname) || empty($role) || empty($passConfirm) || empty($passConfirm)){
      
        header("Location: ../public/signup.php?inputs-can-not-be-empty");
        exit();
    }

    else if($password != $passConfirm){
        header("Location: ../public/signup.php?passwords-not-mutch");
        exit();
    }
    
    $visitor = new Visitor();
    $visitor->createAccount($firstname, $lastname, $email, $role, $photo, $password);
  
}