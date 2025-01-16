<?php
include_once "../classes/User.php";
if(isset($_GET["action"])){
    $array = explode("?",$_GET["action"]);
    $action = $array[0];
    $userId = $array[1];

    switch($action){
        case 'activate' : User::changeUserStatus($userId,'active');
        header("Location: ../public/adminDashboard.php");
        break;
        case 'suspend' : User::changeUserStatus($userId,'suspended');
        header("Location: ../public/adminDashboard.php");
        break;
        case 'delete' : User::changeUserStatus($userId,'deleted');
        header("Location: ../public/adminDashboard.php");
        break;
    }
}