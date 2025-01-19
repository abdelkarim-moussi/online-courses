<?php

include_once "UserDao.php";
include_once "CourseDao.php";
include_once "CategorieDao.php";

$dao = new UserDao();

$users = $dao->showUsersByRole("student");

foreach($users as $user){
    echo $user->getEmail().'<br>';
}


$catDao = new CategorieDao();
echo $catDao->deleteCategorie();
