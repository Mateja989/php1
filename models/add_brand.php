<?php
    if(isset($_POST['newBrand'])){
        
        session_start();
        require_once "../config/connection.php";
        require_once "functions.php";

        $brand=$_POST['brand'];
        $error=false;
        $brandReg="/^[A-Z]{1}[a-z]{2,14}$/";


        if(!invalidInput($brand,$brandReg)){
            $_SESSION['nameError']="First letter must to be capitalize.";
            $error=true;
        }
        if(!brand_exist($brand)){
            $_SESSION['existBrand']="Brand with this name has already exist in database.";
            $error=true;
        }

        if(!$error){
            $result=insert_brand($brand);
            if($result){
                header("location: ../index.php?page=admin_sneakers");
                $_SESSION['uploaded']="Brand succsesfully uploaded.";
            }
            else{
                header("location: ../index.php?page=admin_sneakers");
            }
        }
        else{
            header("location: ../index.php?page=admin_sneakers");
        }
        

    }
    else{
        header('location: index.php');
    }