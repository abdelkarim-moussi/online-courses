<?php
include_once "Student.php";
include_once "Teacher.php";

class Visitor{

    public function createAccount($firstname, $lastname, $email, $role, $photo, $password){

        if($role === "student"){
            $student = new Student($firstname, $lastname, $email,$role, $photo, $password);

            $db = DataBase::getInstance();
            $conn = $db->getConnection();
        
            // Check if email already exists
            $sql = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $sql->bindParam(":email", $student->getEmail(), PDO::PARAM_STR);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                header("Location: ../public/signup.php?error=emailalreadyexist");
                exit();
            }

            // Hash the password
            $hashedPass = password_hash($student->getPassword(), PASSWORD_BCRYPT);

            // Insert new user into the database
            $insertSQL = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, role, user_image) VALUES (:firstname, :lastname, :email, :password, :role, :image)");
            $insertSQL->bindParam(":firstname", $student->getFirstName(), PDO::PARAM_STR);
            $insertSQL->bindParam(":lastname", $student->getLastName(), PDO::PARAM_STR);
            $insertSQL->bindParam(":email", $student->getEmail(), PDO::PARAM_STR);
            $insertSQL->bindParam(":password", $hashedPass, PDO::PARAM_STR);
            $insertSQL->bindParam(":role", $student->getRole());
            $insertSQL->bindParam(":image", $student->getPhoto(), PDO::PARAM_STR);
            // $insertSQL->execute();
            if ($insertSQL->execute()) {
                header("Location: ../public/login.php");
            } else {
                header("Location: ../public/signup.php?error=insert-failed");
            }
            
        }

        else if($role === "teacher"){
            $teacher = new Teacher($firstname, $lastname, $email,$role, $photo, $password);

            $db = DataBase::getInstance();
            $conn = $db->getConnection();
        
            // Check if email already exists
            $sql = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $sql->bindParam(":email", $teacher->getEmail(), PDO::PARAM_STR);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                header("Location: ../public/signup.php?error=emailalreadyexist");
                exit();
            }

            // Hash the password
            $hashedPass = password_hash($teacher->getPassword(), PASSWORD_BCRYPT);

            // Insert new user into the database
            $insertSQL = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, role, user_image) VALUES (:firstname, :lastname, :email, :password, :role, :image)");
            $insertSQL->bindParam(":firstname", $teacher->getFirstName(), PDO::PARAM_STR);
            $insertSQL->bindParam(":lastname", $teacher->getLastName(), PDO::PARAM_STR);
            $insertSQL->bindParam(":email", $teacher->getEmail(), PDO::PARAM_STR);
            $insertSQL->bindParam(":password", $hashedPass, PDO::PARAM_STR);
            $insertSQL->bindParam(":role", $teacher->getRole());
            $insertSQL->bindParam(":image", $teacher->getPhoto(), PDO::PARAM_STR);
            // $insertSQL->execute();
            if ($insertSQL->execute()) {
                header("Location: ../public/login.php");
            } else {
                header("Location: ../public/signup.php?error=insert-failed");
            }
            
        }

    }
}