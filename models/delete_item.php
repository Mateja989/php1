<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../config/connection.php";
        include "functions.php";
        session_start();

        try{
            $id = $_POST['id'];
            $user=$_SESSION['user']->user_id;
            $status=0;
            $cart_id=cart_id($user)->cart_id; //7
            $deleteModel=delete_model_from_cart($id);
            $cart_items=get_cart_items($user,$status); 
            $total_price=get_total_price($user,$status);  
            if($deleteModel){        
                echo json_encode([
                    "models"=>$cart_items,
                    "message"=>'Successfully deleted',
                    "total"=>$total_price
                ]);

                http_response_code(200);
            }else{
                $response=['message'=>'Bad parrametar.'];
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


