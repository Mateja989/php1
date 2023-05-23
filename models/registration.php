<?php 
    if(isset($_POST['submit-btn'])){
        
        session_start();
        require_once "../config/connection.php";
        require_once "functions.php";
         
        $first_name=$_POST["first_name"];
        $last_name=$_POST["last_name"];
        $username=$_POST["username"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $street=$_POST["street"];
        $street_number=$_POST["street"];
        $city_id=$_POST["city-ddl"];
        $passwordCript=md5($_POST["password"]);
        $error=false;

        $nameReg="/^[A-Z]{1}[a-z]{2,14}$/";
        $surnameReg="/^[A-Z]{1}[a-z]{4,29}$/";
        $passwordReg="/^[A-Z]{1}[a-z0-9!@#$%^.&*]{7,19}$/";
        $usernameReg="/^([a-z]{1})[a-z0-9]{4,29}$/";
        $streetRegex="/^([A-ZČĆŽŠĐ]|[1-9]{1,5})[A-ZČĆŽŠĐa-zčćžšđ\d\-\.\s]+$/";
      
        if(!invalidInput($first_name,$nameReg)){
            $_SESSION['first_name']="First name isn`t in right format.";
            $error=true;
        }
        if(!invalidInput($last_name,$surnameReg)){
            $_SESSION['last_name']="Last name isn`t in right format.";
            $error=true;
        }
        if(!invalidInput($street,$streetRegex)){
            $_SESSION['street']="Street isn`t in right format.";
            $error=true;
        }
        if(!invalidInput($password,$passwordReg)){
            $_SESSION['password']="Password isn`t in right format.";
            $error=true;
        }
        if(!invalidEmail($email)){
            $_SESSION['email']="Email isn`t in right format.";
            $error=true;
        }
        if(!invalidInput($username,$usernameReg)){
            $_SESSION['username']="Username isn`t in right format.";
            $error=true;
        }
        if(!existEmail($email)){
            $_SESSION['existMail']="Email already exist in database.";
            $error=true;
        }
        if(!existUsername($username)){
            $_SESSION['existUser']="Username already exist in database.";
            $error=true;
        }

        if(!$error){
            $result=registrationUser($first_name,$last_name,$username,$email,$passwordCript,$city_id,$street,$street_number);
            if(!$result){
              $error['serverError']="Error";
            }
            else{
              header('location: ../index.php');
            }
        }else{
            header('location: ../index.php?page=registration');
        }
    }
    else{
        header('location: index.php');
    }
      

?>