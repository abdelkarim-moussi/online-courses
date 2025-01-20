<?php
include_once "../classes/User.php";
include_once "../classes/Course.php";
include_once "../classes/joinedCourse.php";

class UserDao{

    private $connection;

    public function __construct(){

        $db = DataBase::getInstance();
        $this->connection = $db->getConnection();

    }

    public function showUsersByRole($role){

        $selectUsersByRole = $this->connection->prepare("SELECT * FROM users WHERE role = ?");
        $selectUsersByRole->execute([$role]);
        
        $users = [];

        while($row = $selectUsersByRole->fetch()){

            $user = new User();
            $user->setEmail($row["email"]);
            $user->setId($row["user_id"]);
            $user->setFirstName($row['firstname']);
            $user->setLastName($row['lastname']);
            $user->setFullName($row['lastname'].' '.$row['firstname']);
            $user->setRole($row['role']);
            $user->setStatus($row['user_status']);
            array_push($users,$user);
        }
  
        return $users;

    }

    public function calcCoursesForUser($userId){

        $selectUserCoursesNum = $this->connection->prepare("SELECT COUNT(*) AS numcourses FROM courses 
        WHERE user_id = ?");
        $selectUserCoursesNum->execute([$userId]);
        $result = $selectUserCoursesNum->fetch();
        return $result;

    }

    private function checkUserByEmail($email){
    
        $sql = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $sql->bindParam(':email',$email);
        $sql->execute();
        $userData = $sql->fetch();

        if($userData){
            $user = new User();

            $user->setEmail($userData['email']);
            $user->setFirstName($userData['firstname']);
            $user->setLastName($userData['lastname']);
            $user->setPassword($userData['password']);
            $user->setRole($userData['role']);
            $user->setphoto($userData['photo']);
            $user->setstatus($userData['user_status']);
            $user->setId($userData['user_id']);

            return $user;
        }
        else return false;
    }

    public function login(User $user){
        
        $userdb = $this->checkUserByEmail($user->getEmail());

        try {
            
            if($userdb){
            // Verify the password
            if (!password_verify($user->getPassword(), $userdb->getPassword())) {
                header("Location: ../public/login.php?error=passwordincorrect");
                exit();
            }

            session_start();

            $_SESSION["username"] = $userdb->getFirstName();
            $_SESSION["userId"] = $userdb->getId();
            $_SESSION["urole"] = $userdb->getRole();

            } 
            else {
                return "incorect email or password";
            }

        } catch (PDOException $e) {
            // Log error for debugging
            error_log("Database Error: " . $e->getMessage());
            header("Location: ../public/login.php?error=stmfailed");
            exit();
        }
    }

    public function createAccount(User $user){

            if ($this->checkUserByEmail($user->getEmail())) {
                header("Location: ../public/signup.php?error=emailalreadyexist");
                exit();
            }

            // Hash the password
            $hashedPass = password_hash($user->getPassword(), PASSWORD_BCRYPT);

            // Insert new user into the database
            $insertSQL = $this->connection->prepare("INSERT INTO users (firstname, lastname, email, password, role, photo) VALUES (:firstname, :lastname, :email, :password, :role, :photo)");
            $insertSQL->bindParam(":firstname", $user->getFirstName());
            $insertSQL->bindParam(":lastname", $user->getLastName());
            $insertSQL->bindParam(":email", $user->getEmail());
            $insertSQL->bindParam(":password", $hashedPass);
            $insertSQL->bindParam(":role", $user->getRole());
            $insertSQL->bindParam(":photo", $user->getPhoto());
            // $insertSQL->execute();
            if ($insertSQL->execute()) {
                header("Location: ../public/login.php");
            } else {
                header("Location: ../public/signup.php?error=insert-failed");
            }

    }

    public function changeUserStatus($userId,$status){

        $changeUserStatus = $this->connection->prepare("UPDATE users SET user_status = ? WHERE user_id = ?");
        $changeUserStatus->execute([$status,$userId]);
        
    }

    public function deleteUser($userId){

        $deleteUser = $this->connection->prepare("DELETE FROM users WHERE user_id = ?");
        $deleteUser->execute([$userId]);
    }
    
    
    public function UserInfo($userId)
    {
        try {
            
            $getUser = $this->connection->prepare("SELECT * FROM users WHERE user_id = :user_id");
            $getUser->bindParam(":user_id", $userId);
    
            $getUser->execute();
            $row = $getUser->fetch();
    
            if ($row) {
               
                $user = new User();
                $user->setFirstName($row['firstname']);
                $user->setLastName($row['lastname']);
                $user->setEmail($row['email']);
                $user->setPassword($row['password']);
                $user->setRole($row['role']);
                $user->setStatus($row['user_status']);
                $user->setPhoto($row['photo']);
    
                return $user;
            } else {
               
                return "User not found";
            }
        } catch (PDOException $e) {
            
            return "Database error: " . $e->getMessage();
        }
    }
    public function updateUser(User $user){

        $updateUser = $this->connection->prepare("UPDATE users
        SET firstname = :fname, lastname = :lname, email = :email, photo = :photo
        WHERE user_id = :id");
        $updateUser->bindParam("fname",$user->getFirstName());
        $updateUser->bindParam("lname",$user->getLastName());
        $updateUser->bindParam(":email",$user->getEmail());
        $updateUser->bindParam(":photo",$user->getPhoto());
        $updateUser->bindParam(":id",$user->getId());
        
        $updateUser->execute();

    }

    public function getOldImage($userId){

        $selectImage = $this->connection->query("SELECT photo FROM users WHERE user_id = $userId");
        $result = $selectImage->fetch();
        return $result;
    }


    public function checkEnrollement(Course $course, User $user){

        $userid = $user->getId();
        $courseid = $course->getCourseId();

        $stmt = $this->connection->prepare("SELECT * FROM users_courses WHERE user_id = :user_id AND course_id = :course_id");
        $stmt->bindParam(':user_id',$userid);
        $stmt->bindParam(':course_id',$courseid);

        if($result = $stmt->fetch()){
            return true;
        }
        else return false;

    }

    public function enrollCourse(Course $course,User $user){

        $joinedCourse = new JoinedCourse();
        $joinedCourse->setUser($user);
        $idCo = $joinedCourse->setCourse($course);

        $idU = $joinedCourse->getUser()->getId();
        $idCo = $joinedCourse->getCourse()->getCourseId();

            if($this->checkEnrollement($course,$user) === true){
                return "user already enrolled";
                exit();
            }
            else{

            try{
                $stmt = $this->connection->prepare("INSERT INTO users_courses (user_id,course_id)
                VALUES(:user_id,:course_id)");
                $stmt->bindParam(":user_id",$idU);
                $stmt->bindParam(":course_id",$idCo);
                $stmt->execute();
                return true;
            }catch(PDOException $e){
                die("database error ".$e->getMessage());
            }    
        
        }
    }


    public function getEnrolledCourses(User $user) {
        $query = "SELECT c.*, u.firstname, u.lastname, u.email, cat.categorie_id, cat.categorie_name 
                 FROM courses c 
                 INNER JOIN users_courses jc ON c.course_id = jc.course_id 
                 LEFT JOIN users u ON c.user_id = u.user_id 
                 LEFT JOIN categories cat ON c.categorie_id = cat.categorie_id 
                 WHERE jc.user_id = ?";
                 
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$user->getId()]);
        
        $courses = [];
        
        while ($row = $stmt->fetch()) {
            $course = new Course();
            $course->setCourseId($row['course_id']);
            $course->setTitle($row['title']);
            $course->setDescription($row['description']);
            $course->setThumbnail($row['thumbnail']);
            $course->setContent($row['content']);
            $course->setLaunchDate($row['pub_date']);
            
            if ($row['user_id']) {
                $teacher = new Teacher();
                $teacher->setId($row['user_id']);
                $teacher->setFirstName($row['firstname']);
                $teacher->setLastName($row['lastname']);
                $teacher->setEmail($row['email']);
                $teacher->setFullName($row['firstname'] . ' ' . $row['lastname']);
                $course->setTeacher($teacher);
            }
            
            if ($row['categorie_id']) {
                $category = new Categorie();
                $category->setCategorieId($row['categorie_id']);
                $category->setCatName($row['categorie_name']);
                $course->setCategorie($category);
            }
            
            $courses[] = $course;
        }
        
        return $courses;
    }

    public function isEnroled(User $user ,Course $course){

        $stmt = $this->connection->prepare("SELECT * FROM users_courses WHERE user_id = ? AND course_id = ?");
                 
        $stmt->execute([$user->getId(),$course->getCourseId()]);

        if($stmt->rowCount() == 0){
            return false;
        }

        else return true;
    }


}

