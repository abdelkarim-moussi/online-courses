<?php
include_once "../config/DataBase.php";
include_once "../classes/Tag.php";

class TagDao{

    private $connection;

    public function __construct()
    {
        $db = DataBase::getInstance();
        $this->connection = $db->getConnection();
    }

    private function checkTag($tagname){

        $stmt = $this->connection->prepare("SELECT * FROM tags WHERE tag_name = :tagname");
        $stmt->bindParam(":tagname",$tagname);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row){
            return true;
        }
        else return false;
        
    }


    public function createTag(Tag $tag){

        try{
            if($this->checkTag($tag->gettagName()) === true){
                return "tag-already-exist";
            }
            else{
                $inserTag = $this->connection->prepare("INSERT INTO tags (tag_name) VALUES(:tagname)");
                $inserTag->bindParam(":tagname",$tag->getTagName());
                $inserTag->execute();
            }

        }catch(PDOException $e){
            die("error adding the tag".$e->getMessage());
        }
  
    }

    public function getTags(){

        $tags = [];
        try{

            $selectTags = $this->connection->query("SELECT * FROM tags");

            while($row = $selectTags->fetch()){
                $tag = new Tag();
                $tag->setTagName($row["tag_name"]);
                $tag->setTagId($row["tag_id"]);
                
                array_push($tags,$tag);
            }
            return $tags;

        }catch(PDOException $e){
            die("error execution".$e->getMessage());
        }
        
    }

    public function getTagByName($tagName){
        
        $selectTags = $this->connection->prepare("SELECT * FROM tags WHERE tag_name = :tagname");
        $selectTags->bindParam(":tagname",$tagName);
        $selectTags->execute();

        if($row = $selectTags->fetch()){
            $tag = new Tag();
            $tag->setTagName($row["tag_name"]);
            $tag->setTagId($row["tag_id"]);
            return $tag;
        }
        else return "tag not exist";

    }

    public function deleteTag($tagId){

        $deleteTag = $this->connection->prepare("DELETE FROM tags WHERE tag_id = ?");
        $deleteTag->execute([$tagId]);
    }
}