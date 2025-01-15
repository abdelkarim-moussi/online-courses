<?php
include_once "../classes/Tag.php";
if(isset($_POST['add-tag'])){

    $tagName = $_POST['tag-name'];

    if(!empty($tagName)){
        $tag = new Tag($tagName);
        $existingTag = $tag->getTagByName();
    
        if($tagName === $existingTag['tag_name']){
            header("Location: ../public/adminDashboard.php?tag-already-exist");
        }

        else {
            $tag->createTag();
        }

    }
}