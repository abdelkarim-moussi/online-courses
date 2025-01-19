<?php
include_once "../config/DataBase.php";

class Tag{
    private $tagId;
    private $tagName;

    public function __construct(){
        
    }

    public function gettagName(){
        return $this->tagName;
    }
    public function setTagName($tagName){
        $this->tagName = $tagName;
    }

    public function gettagId(){
        return $this->tagId;
    }
    public function setTagId($tagId){
        $this->tagId = $tagId;
        return $this;
    }

}