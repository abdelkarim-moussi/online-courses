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

    public function getTagByName(){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $slectTag = $conn->prepare("SELECT tag_name FROM tags WHERE tag_name = :tagname");
        $slectTag->bindParam(":tagname",$this->tagName);
        $slectTag->execute();
        $result = $slectTag->fetch();
        return $result;

    }

    public function createTag(){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $slectTag = $conn->prepare("INSERT INTO tags (tag_name) VALUES(:tagname)");
        $slectTag->bindParam(":tagname",$this->tagName);
        $slectTag->execute();
    }

    public function getTags(){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $selectTags = $conn->query("SELECT * FROM tags");
        $result = $selectTags->fetchAll();
        return $result;
    }

    public function deleteTag($tagId){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $deleteTag = $conn->prepare("DELETE FROM tags WHERE tag_id = ?");
        $deleteTag->execute([$tagId]);
    }
}