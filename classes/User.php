<?php
include_once "../config/DataBase.php";

abstract class User{
  
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $role;
    private string $photo;
    private string $password;

    public function __construct($firstname,$lastname,$email, $role, $photo, $password){
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->role = $role;
        $this->photo = $photo;
        $this->password = $password;
    }

    //firstname getter and setter
    public function getFirstName(){
        return $this -> firstname;
    }
    public function setFirstName($firstname){
      $this -> firstname = $firstname;
    }

    //lastname getter and setter
    public function getLastName(){
        return $this -> lastname;
    }
    public function setLastName($lastname){
      $this -> firstname = $lastname;
    }

    //email getter and setter
    public function getEmail(){
        return $this -> email;
    }
    public function setEmail($email){
      $this -> email = $email;
    }

    //role getter and setter
    public function getRole(){
        return $this -> role;
    }
    public function setRole($role){
      $this -> role = $role;
    }

    //photo getter and setter
    public function getPhoto(){
        return $this -> photo;
    }
    public function setphoto($photo){
      $this -> photo = $photo;
    }

    //password getter and setter
    public function getPassword(){
        return $this -> password;
    }
    public function setPassword($password){
      $this -> password = $password;
    }
   


    public static function login($email,$password){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        if(empty($email) || empty($password)){
            header("Location: ../public/login.php?email-or-password-can-not-be-empty");
            exit();
        }

        try {
            // Prepare query to fetch hashed password by email
            $sql = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $sql->bindParam(':email',$email);
            $sql->execute();

            // Check if the user exists
            if ($sql->rowCount() == 0) {
                header("Location: ../public/login.php?error=usernotfound");
                exit();
            }

            $user = $sql->fetch(PDO::FETCH_ASSOC); // Use fetch() for single-row retrieval

            // Verify the password
            if (!password_verify($password, $user["password"])) {
                header("Location: ../public/login.php?error=passwordincorrect");
                exit();
            }

            $_SESSION["username"] = $user["firstname"];
            $_SESSION["userId"] = $user["user_id"];
            $_SESSION["urole"] = $user["role"];


        } catch (PDOException $e) {
            // Log error for debugging
            error_log("Database Error: " . $e->getMessage());
            header("Location: ../public/login.php?error=stmfailed");
            exit();
        }
    }

    public static function createAccount($firstname, $lastname, $email, $role, $photo, $password){
        
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

            // Check if email already exists
            $sql = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $sql->bindParam(":email", $email, PDO::PARAM_STR);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                header("Location: ../public/signup.php?error=emailalreadyexist");
                exit();
            }

            // Hash the password
            $hashedPass = password_hash($password, PASSWORD_BCRYPT);

            // Insert new user into the database
            $insertSQL = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, role, photo) VALUES (:firstname, :lastname, :email, :password, :role, :photo)");
            $insertSQL->bindParam(":firstname", $firstname, PDO::PARAM_STR);
            $insertSQL->bindParam(":lastname", $lastname, PDO::PARAM_STR);
            $insertSQL->bindParam(":email", $email, PDO::PARAM_STR);
            $insertSQL->bindParam(":password", $hashedPass, PDO::PARAM_STR);
            $insertSQL->bindParam(":role", $role, PDO::PARAM_STR);
            $insertSQL->bindParam(":photo", $photo, PDO::PARAM_STR);
            // $insertSQL->execute();
            if ($insertSQL->execute()) {
                header("Location: ../public/login.php");
            } else {
                header("Location: ../public/signup.php?error=insert-failed");
            }

    }

    public static function changeUserStatus($userId,$status){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $changeUserStatus = $conn->prepare("UPDATE users SET user_status = ? WHERE user_id = ?");
        $changeUserStatus->execute([$status,$userId]);
        
    }

    public static function deleteUser($userId){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $deleteUser = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $deleteUser->execute([$userId]);
    }
    
    public function UserInfo($userId){

        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $getUser = $conn->query("SELECT * FROM users WHERE user_id = $userId");
        $result = $getUser->fetch();
        return $result;

    }

    public function updateUser($userId,$firstname,$lastname,$email,$image){

        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $updateUser = $conn->prepare("UPDATE users
        SET firstname = ?, lastname = ?, email = ?, photo = ?
        WHERE user_id = ?");
        $updateUser->execute([$firstname,$lastname,$email,$image,$userId]);

    }

    public function getOldImage($userId){
        $db = DataBase::getInstance();
        $conn = $db->getConnection();

        $selectImage = $conn->query("SELECT photo FROM users WHERE user_id = $userId");
        $result = $selectImage->fetch();
        return $result;
    }

   

}

