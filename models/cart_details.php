<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../config/connection.php";
        include "functions.php";
        try{
            $id = $_POST['id'];
            $cart_details=get_cart_details($id);


           if($cart_details){
                echo json_encode($cart_details);
                http_response_code(200);
            }else{
                $response=['message'=>'Bad parametars.'];
                echo json_encode($response);
                http_response_code(300);
            }

        }
        catch(PDOException $exception){
            echo json_encode($exception);
            http_response_code(500);
        }
    }
    else{
        header('location: index.php');
        http_response_code(404);
    }
?>