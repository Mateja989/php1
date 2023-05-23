<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../config/connection.php";
        include "functions.php";
        

        try{

            
            $id = $_POST['id'];
            $price = $_POST['price'];
            $insert_price=insert_new_price($id,$price);

            if($insert_price){
                $response=['message'=>'Succesfully add new price for this product.'];
                echo json_encode($response);
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

