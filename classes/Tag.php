<?php
include_once "../config/DataBase.php";

class Tag{
    private $tagName;

    public function __construct($tagName){
        $this->tagName = $tagName;
    }

    public function gettagName(){
        return $this->tagName;
    }
    public function setTageName($tagName){
        $this->tagName = $tagName;
    }

    public function getTagByName($tagName){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $slectTag = $conn->prepare("SELECT tag_name FROM tags WHERE tag_name = :tagname");
        $slectTag->execute(array($tagName));
        return $result = $slectTag->fetch();

    }
}