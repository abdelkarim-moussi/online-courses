<?php
include_once "../classes/User.php";
include_once "../dao/UserDao.php";

if(isset($_POST['login'])){

    $email = $_POST["email"];
    $password = $_POST["password"];

    if(isset($email) && isset($password)){
        
        if($email === null || $password === null){
            header("Location: ../public/login.php?email-or-password-can-not-be-null");
            exit();
        }
        
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        $userDao = new UserDao();
        $userDao->login($user);
    
        header("Location: ../public/index.php");
    }
}