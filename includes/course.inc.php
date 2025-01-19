<?php

use function PHPSTORM_META\type;

include_once "../classes/Course.php";
include_once "../classes/Tag.php";
include_once "../classes/Teacher.php";
include_once "../classes/Course_Tag.php";
include_once "../dao/CourseDao.php";
include_once "../dao/categorieDao.php";
include_once "../dao/tagDao.php";

$courseDao = new CourseDao();
$catDao = new CategorieDao();
$tagDao = new TagDao();

$teacherId = 2;

if(isset($_POST["add-course"])){

    $tags = $_POST["tags"];
    $title = $_POST["title"];
    $courseContent = $_POST["course-content"];
    $video = $_POST['video'];
    $doc = $_POST['document'];
    $categorie = $_POST['categorie'];
    $thumbnail = $_POST["thumbnail"];

    // if(empty($tags) || empty($title) || empty($thumbnail)){
    //     header("Location: ../public/teacherDashboard.php?error!empty-fields");
    //     exit();
    // }


        $catdb = $catDao->getCategorieByName($categorie);

        $categorie = new Categorie();
        $categorie->setCategorieId($catdb->getCategorieId());
        
        $teacher = new Teacher();
        $teacher->setId($teacherId);

        $thumbnailName = $_FILES["thumbnail"]["name"];
        $thumbnailTmpName = $_FILES["thumbnail"]["tmp_name"];
        $newthumbnailName = uniqid().'-'.$fileName;
        move_uploaded_file($thumbnailName,'../uploads/'.$newthumbnailName);

        if($courseContent === "video"){
            $videoName = $_FILES["video"]["name"];
            $videoTmpName = $_FILES["video"]["tmp_name"];
            $newVideoName = uniqid().'-'.$videoName;
            move_uploaded_file($videoTmpName,"../uploads/".$newVideoName);

            $course = new Course();

            $course->setTitle($title);
            $course->setTeacher($teacher);
            $course->setCategorie($categorie);
            $course->setType("video");
            $course->setthumbnail($thumbnail);

            $courseId = $courseDao->createCourse($course);

            foreach($tags as $tagname){

                $tag = $tagDao->getTagByName($tagname);
                $tagId = $tag->gettagId();

                $courseTag = new Course_Tag();
                $CourseTag->setTagId($tagId);
                $CourseTag->setCourseId($courseId);

                $courseDao->createCourseTags($courseTag);

            }
        }
        else if($courseContent === "document"){
            $docName = $_FILES["document"]["name"];
            $docTmpName = $_FILES["document"]["tmp_name"];
            $newdocName = uniqid().'-'.$docName;
            move_uploaded_file($docTmpName,"../uploads/".$newdocName);
        }
    }




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