<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../config/connection.php";
        include "functions.php";
        session_start();

        try{            
            $user=$_SESSION['user']->user_id;
            $status=0;
            $total_price=get_total_price($user,$status)->total_price;
            $finish_purchase=finished_purchase($user,$status,$total_price);

            if($finish_purchase){
                $response=['message'=>'Succesfully confirm purchase.Thank you!!!'];
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