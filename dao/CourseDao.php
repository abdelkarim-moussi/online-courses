<?php
include_once "../classes/Course.php";
include_once "../classes/Course_Tag.php";
include_once "ICourseDao.php";

class CourseDao implements ICourseDao{

    private $connection;

    public function __construct(){

        $db = DataBase::getInstance();
        $this->connection = $db->getConnection();

    }


    public function showCourses(){

        $selectCoureses = $this->connection->query("SELECT * FROM courses INNER JOIN users ON courses.user_id = users.user_id");
        $selectCoureses->execute();
        $courses = [];

        while($row = $selectCoureses->fetch()){

            $course = new Course();
            $course->getTeacher()->setFullName($row["firsname"].' '.$row["lastname"]);
            $course->getCategorie()->setCatName($row["categorie_name"]);
            $course->setTitle($row["title"]);
            $course->setContent($row["content"]);
            $course->setLaunchDate($row["pub_date"]);
            $course->setthumbnail($row["image"]);
            $course->setType($row["content_type"]);
            $course->setCourseId($row["course_id"]);
            $course->setStatus($row["status"]);

            array_push($courses,$course);
        }
        return $courses;

    }

    public function getNumCourses(){

        $numCourses = $this->connection->prepare("SELECT count(*) AS num FROM courses");
        $numCourses->execute();
        $result = $numCourses->fetch();
        return $result;

    }

    public function getCoursesByStatus($status){

        $selectNumCoursesByStat = $this->connection->prepare("SELECT count(*) AS num FROM courses WHERE status = ?");
        $selectNumCoursesByStat->execute([$status]);
        $result = $selectNumCoursesByStat->fetch();
        return $result;

    }

    public function getCoursesByUserId($userId){

        try{
            $selectCourses = $this->connection->prepare("SELECT * FROM courses INNER JOIN users ON courses.user_id = users.user_id
        WHERE courses.user_id = ?");
        $selectCourses->execute([$userId]);
        $courses = [];
    
        while($row = $selectCourses->fetchAll()){

            $course = new Course();
            $course->getTeacher()->setFullName($row["firsname"].' '.$row["lastname"]);
            $course->getCategorie()->setCatName($row["categorie_name"]);
            $course->setTitle($row["title"]);
            $course->setContent($row["content"]);
            $course->setType($row["content_type"]);
            $course->setCourseId($row["course_id"]);
            $course->setStatus($row["status"]);

            array_push($courses,$course);
        }

        return $courses;

        }catch(PDOException $e){
        die("execution error".$e->getMessage());
    }
        
    }


    private function checkCourseByTitle($title){
        $stmt = $this->connection->prepare("SELECT * FROM courses WHERE title = :title");
        $stmt->bindParam(":title",$title);
        $stmt->execute();
        $result = $stmt->fetch();
        if($result){
            return true;
        }
        else return false;
    } 

    public function createCourse(Course $course)
    {
        try{
            if($this->checkCourseByTitle($course->getCourseId())){
                return "course title already exist";
            }
            else{
                $insert = $this->connection->prepare("INSERT INTO courses (users_id,categorie_id,title,content,pub_date,thumbnail,content_type)
                VALUES(:usersid,:categorieid,:title,:content,:pub_date,:thumbnail,:contenttype)");
                $insert->bindParam(':userid',$course->getTeacher()->getId());
                $insert->bindParam(':categorieid',$course->getCategorie()->getCategorieId());
                $insert->bindParam(':title',$course->getTitle());
                $insert->bindParam(':content',$course->getContent());
                $insert->bindParam(':pub_date',$course->getLaunchDate());
                $insert->bindParam(':thumbnail',$course->getthumbnail());
                $insert->bindParam(':contenttype',$course->getType());

                if($insert->execute()){
                    return intval($this->connection->lastInsertId());
                }
                else return "execution error";

            }      

        }catch(PDOException $e){
            die("execution error".$e->getMessage());
        }
    }

    public function createCourseTags(Course_Tag $courseTag){

        $stmt = $this->connection->prepare("INSERT INTO courses_tags (course_id,tag_id) VALUES(:courseid,:tagid) ");
        $stmt->bindParam(":courseid",$courseTag->getCourseId());
        $stmt->bindParam(":tagid",$courseTag->getTagId());
        
        if($stmt->execute()){
            return "success";
        }

        else return "error execution";
    }
}

