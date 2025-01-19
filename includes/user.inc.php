<?php
include_once "../classes/User.php";
include_once "../dao/UserDao.php";

$userDao = new UserDao();
if(isset($_GET["action"])){
    $array = explode("?",$_GET["action"]);
    $action = $array[0];
    $userId = $array[1];

    switch($action){
        case 'activate' : $userDao->changeUserStatus($userId,'active');
        header("Location: ../public/adminDashboard.php");
        break;
        case 'suspend' : $userDao->changeUserStatus($userId,'suspended');
        header("Location: ../public/adminDashboard.php");
        break;
        case 'delete' : $userDao->deleteUser($userId);
        header("Location: ../public/adminDashboard.php");
        break;
    }
}