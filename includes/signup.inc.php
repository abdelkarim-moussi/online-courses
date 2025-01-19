<?php
include_once "../classes/User.php";
include_once "../dao/UserDao.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    $email = htmlspecialchars($_POST["email"]);
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $role = htmlspecialchars($_POST["role"]);
    $password = htmlspecialchars($_POST["password"]);
    $passConfirm = htmlspecialchars($_POST["confirm-password"]);

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
    
    $user = new User();
    $user->setEmail($email);
    $user->setFirstName($firstname);
    $user->setLastName($lastname);
    $user->setRole($role);
    $user->setPassword($password);
    $user->setphoto($photo);

    $userDao= new UserDao();
    $userDao->createAccount($user);

    header("Location: ../public/index.php");

}