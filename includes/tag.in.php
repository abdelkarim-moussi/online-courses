<?php
include_once "../classes/Tag.php";
if(isset($_POST['add-tag'])){

    $tagName = htmlspecialchars($_POST['tag-name']);

    if(!empty($tagName)){
        $tag = new Tag($tagName);
        $existingTag = $tag->getTagByName();
    
        if($tagName === $existingTag['tag_name']){
            header("Location: ../public/adminDashboard.php?tag-already-exist");
        }

        else {
            $tag->createTag();
            header("Location: ../public/adminDashboard.php");
        }

    }
}


if(isset($_GET["idtag"])){
    $tagId = $_GET["idtag"];
    $tag = new Tag("");
    $tag->deleteTag($tagId);
    header("Location: ../public/adminDashboard.php");
}