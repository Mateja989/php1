<?php
if(isset($_POST['btn-contact'])){
        
        session_start();
        require_once "../config/connection.php";
        require_once "functions.php";

      $firstName=$_POST['firstName'];
      $lastName=$_POST['lastName'];
      $headline=$_POST['headline'];
      $message=$_POST['message'];
      $error=false;

      $firstNameReg="/^[A-Z]{1}[a-z]{2,14}$/";
      $lastNameReg="/^[A-Z]{1}[a-z]{4,29}$/";
      $headlineReg="/^[\w\d\s!?*]{1,99}$/";



      if(!invalidInput($firstName,$firstNameReg)){
        $_SESSION['firstNameError']="First name isn`t in correct format";
        $error=true;
      }
      if(!invalidInput($lastName,$lastNameReg)){
        $_SESSION['lastNameError']="Last name isn`t in correct format";
        $error=true;
      }
      if(!invalidInput($headline,$headlineReg)){
        $_SESSION['headlineError']="Headline isn`t in correct format";
        $error=true;
      }
      if(!$error){
        $sendMessage=sendMessage($firstName,$lastName,$headline,$message);
        if($sendMessage){
            $_SESSION['success']="Your message was sent.";
        }
      }

      header('location: ../index.php?page=contact');
      
    }
    else{
        header('location: ../index.php');
    }