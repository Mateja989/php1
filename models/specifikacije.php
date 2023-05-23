<?php 
    header("Content-type: application/json");
    if(isset($_POST['id'])){
    

        try{
            include_once "../config/connection.php";
            include "functions.php";
    
            $kat_id = $_POST["id"];
            $specifikacije = dohvatiSpec($kat_id);

            echo json_encode($specifikacije);
    
        }
        catch(PDOException $exception){
            echo json_encode($exception);
            http_response_code(500);
        }



    }
    else{
        http_response_code(404);
    }