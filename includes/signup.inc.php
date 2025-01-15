<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    echo "done";
    $email = $_POST["email"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $role = $_POST["role"];
    $password = $_POST["password"];
    $passConfirm = $_POST["confirm-password"];

    $filename = $_FILES["image"]["name"];
    $fileTmpName = $_FILES["image"]["tmp_name"];
    $newFileName = uniqid() ."-" .$filename;
    move_uploaded_file($fileTmpName,"../profile-imgs/".$newFileName);

    if(empty($email) || empty($firstname) || empty($lastname) || empty($role) || empty($passConfirm) || empty($passConfirm)){
      
        header("Location: ../public/signup.php?inputs-can-not-be-empty");
        exit();
    }
    
    else echo "done1";
  
 
}