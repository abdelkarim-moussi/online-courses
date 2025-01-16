<?php
include_once "../classes/Course.php";

if(isset($_GET['action'])){
    $array = explode("?",$_GET["action"]);
    $action = $array[0];
    $courseId = $array[1];

    switch($action){
        case 'accept' : User::changeUserStatus($courseId,'accepted');
        header("Location: ../public/adminDashboard.php");
        break;
        case 'refuse' : User::changeUserStatus($courseId,'refused');
        header("Location: ../public/adminDashboard.php");
        break;
        case 'delete' : User::deleteCourse($courseId);
        header("Location: ../public/adminDashboard.php");
        break;
    }
}