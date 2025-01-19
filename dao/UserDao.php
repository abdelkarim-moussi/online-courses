<?php
include_once "../classes/User.php";

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
    
    
    public function UserInfo($userId){

        $getUser = $this->connection->prepare("SELECT * FROM users WHERE user_id = :userId");
        $getUser->bindParam(":userId",$userId);
        $row = $getUser->fetch();
        
        if($row){
            $user = new User();
            $user->setFirstName($row['firstname']);
            $user->setLastName($row['lastname']);
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);
            $user->setRole($row['role']);
            $user->setStatus($row['user_status']);
            
            return $user;
        }

        else return "error getting user info";

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
}

