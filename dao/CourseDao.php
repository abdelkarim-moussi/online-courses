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

        $selectCoureses = $this->connection->query("SELECT * FROM courses INNER JOIN users ON courses.user_id = users.user_id INNER JOIN categories ON courses.categorie_id = categories.categorie_id ");
        $selectCoureses->execute();
        $courses = [];

        while($row = $selectCoureses->fetch()){

            $course = new Course();
            $course->getTeacher()->setFullName($row["firstname"].' '.$row["lastname"]);
            $course->getCategorie()->setCatName($row["categorie_name"]);
            $course->setTitle($row["title"]);
            $course->setContent($row["content"]);
            $course->setLaunchDate($row["pub_date"]);
            $course->setthumbnail($row["thumbnail"]);
            $course->setType($row["content_type"]);
            $course->setCourseId($row["course_id"]);
            $course->setStatus($row["status"]);
            $course->setDescription($row["description"]);

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
            $course->setDescription($row["description"]);

            array_push($courses,$course);
        }

        return $courses;

        }catch(PDOException $e){
        die("execution error".$e->getMessage());
    }
        
    }


    private function checkCourseByTitle($title){
        $stmt = $this->connection->prepare("SELECT * FROM courses WHERE title = :title; ");
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
        $teacherId = $course->getTeacher()->getId();
        $catId = $course->getCategorie()->getCategorieId();
        $title = $course->getTitle();
        $content = $course->getContent();
        $date = $course->getLaunchDate();
        $thumbnail = $course->getThumbnail();
        $type = $course->getType();
        $description = $course->getDescription();

        try {
            if ($this->checkCourseByTitle($title)) {
                return "course title already exists";
            } else {
                
                $insert = $this->connection->prepare("INSERT INTO courses (user_id , categorie_id , title, content , pub_date , thumbnail , content_type, description)
                VALUES (:user_id, :categorie_id , :title , :content , :pub_date , :thumbnail , :content_type, :description)");

               
                $insert->bindParam(":user_id", $teacherId);
                $insert->bindParam(":categorie_id", $catId);
                $insert->bindParam(":title", $title);
                $insert->bindParam(":content", $content);
                $insert->bindParam(":pub_date", $date);
                $insert->bindParam(":thumbnail", $thumbnail);
                $insert->bindParam(":content_type", $type);
                $insert->bindParam(":description", $description);

                if ($insert->execute()) {
                    return intval($this->connection->lastInsertId());
                } else {
                    return "database error";
                }
            }
        } catch (PDOException $e) {
            die("Execution error: " . $e->getMessage());
        }
    }

    public function createCourseTags(Course_Tag $courseTag){
        $courseId = $courseTag->getCourse()->getCourseId();
        $tagId = $courseTag->getTag()->gettagId();
        
        $stmt = $this->connection->prepare("INSERT INTO courses_tags (course_id,tag_id) VALUES(:courseid, :tagid); ");
        $stmt->bindParam(":courseid",$courseId);
        $stmt->bindParam(":tagid",$tagId);
        
        if($stmt->execute()){
            return "success";
        }

        else return "error execution";
    }
}

