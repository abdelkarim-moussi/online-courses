<?php
include_once "../classes/User.php";
include_once "../classes/Student.php";

if(isset($_POST['login'])){

    $email = $_POST["email"];
    $password = $_POST["password"];

    if(isset($email) && isset($password)){
        
        $user = new User("","",$email, "", "", $password,"");
        if($email === null || $password === null){
            header("Location: ../public/login.php?email-or-password-can-not-be-null");
            exit();
        }
        
        $user->login();
        header("Location: ../public/index.php");
    }
}