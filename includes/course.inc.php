<?php
session_start();

include_once "../classes/Course.php";
include_once "../classes/Tag.php";
include_once "../classes/Teacher.php";
include_once "../classes/Course_Tag.php";
include_once "../dao/CourseDao.php";
include_once "../dao/categorieDao.php";
include_once "../dao/tagDao.php";
include_once "../dao/UserDao.php";

$userDao = new UserDao();
$courseDao = new CourseDao();
$catDao = new CategorieDao();
$tagDao = new TagDao();

$userId = $_SESSION["userId"];

if(isset($_POST["add-course"])){

    $tags = $_POST["tags"];
    $title = $_POST["title"];
    $courseContent = $_POST["course-content"];
    $categorie = $_POST['categorie'];
    $description = $_POST['description'];
    $date = date("Y-m-d");


    if(empty($tags) || empty($title) || empty($description) || empty($courseContent)){
        header("Location: ../public/teacherDashboard.php?error!empty-fields");
        exit();
    }

    else {
        $catdb = $catDao->getCategorieByName($categorie);

        $categorie = new Categorie();
        $categorie->setCategorieId($catdb->getCategorieId());
        
        $teacher = new Teacher();
        $teacher->setId($userId);

        $thumbnailName = $_FILES["thumbnail"]["name"];
        $thumbnailTmpName = $_FILES["thumbnail"]["tmp_name"];
        $newthumbnailName = uniqid().'-'.$thumbnailName;
        move_uploaded_file($thumbnailTmpName,'../uploads/'.$newthumbnailName);

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
            $course->setthumbnail($newthumbnailName);
            $course->setLaunchDate($date);
            $course->setContent($newVideoName);
            $course->setDescription($description);

            $courseId = $courseDao->createCourse($course);
            $course->setCourseId($courseId);
            
            foreach($tags as $tagname){

                $tag = $tagDao->getTagByName($tagname);
                $tagId = $tag->gettagId();

                $courseTag = new Course_Tag();

                $tag = new Tag();
                $tag->setTagId($tagId);

                $courseTag->setTag($tag);
                $courseTag->setCourse($course);

                $courseDao->createCourseTags($courseTag);

            }
        }
        else if($courseContent === "document"){
            $docName = $_FILES["document"]["name"];
            $docTmpName = $_FILES["document"]["tmp_name"];
            $newdocName = uniqid().'-'.$docName;
            move_uploaded_file($docTmpName,"../uploads/".$newdocName);

            $course = new Course();

            $course->setTitle($title);
            $course->setTeacher($teacher);
            $course->setCategorie($categorie);
            $course->setType("document");
            $course->setthumbnail($newthumbnailName);
            $course->setLaunchDate($date);
            $course->setContent($newdocName);
            $course->setDescription($description);

            $courseId = $courseDao->createCourse($course);
            $course->setCourseId($courseId);
            
            foreach($tags as $tagname){

                $tag = $tagDao->getTagByName($tagname);
                $tagId = $tag->gettagId();

                $courseTag = new Course_Tag();

                $tag = new Tag();
                $tag->setTagId($tagId);

                $courseTag->setTag($tag);
                $courseTag->setCourse($course);
                $courseDao->createCourseTags($courseTag);

            }
        }

    }

    }




if(isset($_GET['action'])){
    $array = explode("?",$_GET["action"]);
    $action = $array[0];
    $courseId = intval($array[1]);

    switch($action){
        case 'accept' : $courseDao->changeCourseStatus($courseId,'accepted');
        header("Location: ../public/adminDashboard.php");
        break;
        case 'refuse' : $courseDao->changeCourseStatus($courseId,'refused');
        header("Location: ../public/adminDashboard.php");
        break;
        case 'cancel' : $courseDao->changeCourseStatus($courseId,'canceled');
        header("Location: ../public/adminDashboard.php");
        break;
        case 'delete' : $courseDao->deleteCourse($courseId);
        header("Location: ../public/adminDashboard.php");
        case 'enroll' :
        $course = new Course();
        $course->setCourseId($courseId);

        $user = new User();
        $user->setId($userId);

        if($userDao->enrollCourse($course,$user)){
            header("Location: ../public/course-details.php?id=$courseId");
        }
 
        else  header("Location: ../public/course-details.php?id=$courseId&error");
    
        break;
    }
}