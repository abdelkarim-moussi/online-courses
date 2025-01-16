<?php
include_once "../classes/Course.php";

if(isset($_GET['action'])){
    $array = explode("?",$_GET["action"]);
    $action = $array[0];
    $courseId = $array[1];

    switch($action){
        case 'accept' : Course::changeCourseStatus($courseId,'accepted');
        header("Location: ../public/adminDashboard.php");
        break;
        case 'refuse' : Course::changeCourseStatus($courseId,'refused');
        header("Location: ../public/adminDashboard.php");
        break;
        case 'cancel' : Course::changeCourseStatus($courseId,'canceled');
        header("Location: ../public/adminDashboard.php");
        break;
        case 'delete' : Course::deleteCourse($courseId);
        header("Location: ../public/adminDashboard.php");
        break;
    }
}