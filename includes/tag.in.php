<?php
include_once "../classes/Tag.php";
include_once "../dao/tagDao.php";


$tagDao = new TagDao();

if(isset($_POST['add-tag'])){

    $tagName = htmlspecialchars($_POST['tag-name']);

    if(!empty($tagName)){
        $tag = new Tag($tagName);
        $tagDao->createTag($tag);
        $msg = $tagDao->createTag($tag);
        header("Location: ../public/adminDashboard.php");
    }
}


if(isset($_GET["idtag"])){
    $tagId = $_GET["idtag"];
    $tagDao->deleteTag($tagId);
    header("Location: ../public/adminDashboard.php");
}