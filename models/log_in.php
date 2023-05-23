<?php

   if(isset($_POST['log-btn'])){

    session_start();
    require_once "../config/connection.php";
    require_once "functions.php";


      $username=$_POST["username"];
      $password=$_POST["password"];
      $error=false;

      $passwordReg="/^[A-Z]{1}[a-z0-9!@#$%^.&*]{7,19}$/";
      $usernameReg="/^([a-z]{1})[a-z0-9]{4,29}$/";

      $passwordCript=md5($_POST["password"]);

      if(!invalidInput($username,$usernameReg)){
        $_SESSION['username']="Username isn`t in right format";
        $error=true;
    }
    if(!invalidInput($password,$passwordReg)){
        $_SESSION['password']="Password isn`t in right format.";
        $error=true;
    }


      if(!$error){
         $user=loginUser($username,$passwordCript);
         if($user){
             $_SESSION['user']=$user;
             if($_SESSION['user']->role_id==1){
                header('location: ../index.php?page=profile');
             }
             else{
                header('location: ../index.php');
             }
             recordAuthorizedUser($_SESSION['user']->username);
             
         }
         else{
            $_SESSION['noUser']="User not found in database.";
            header('location: ../index.php?page=log_in');
         }
      }
      else{
            header('location: ../index.php?page=log_in');
      }
  }
  else{
    header('location: ../index.php');
  }