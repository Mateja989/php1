<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../config/connection.php";
        include "functions.php";
        session_start();
        

        try{
            $sneaker = $_POST['sneaker'];
            $user = $_SESSION['user']->user_id;
            $itemObj=get_price_for_item($sneaker);
            $item_price=$itemObj->price;
            

            $order_check=exist_not_confirm_order($user);

            if(!$order_check){
                $cart=create_order($user);
                if($cart){
                    $cart_id=cart_id($user)->cart_id;
                    $item_in_cart=exist_item_in_cart($cart_id,$sneaker);
                    if(!$item_in_cart){
                            $item=insert_order_item($cart_id,$sneaker,$item_price);
                            if($item){
                                $response=["message" => "Succesfully added to cart"];
                                echo json_encode($response);
                                http_response_code(200);
                            }
                            else{
                                $response=["message" => "Error added to cart"];
                                echo json_encode($response);
                                http_response_code(300);
                            }
                    }
                    else{
                        $response=["message" => "Order already added to cart"];
                        echo json_encode($response);
                    } 
                }
            }
            else{
                $cart_id=cart_id($user)->cart_id;
                $item_in_cart=exist_item_in_cart($cart_id,$sneaker);
                    if(!$item_in_cart){
                            $item=insert_order_item($cart_id,$sneaker,$item_price);
                            if($item){
                                $response=["message" => "Succesfully added to cart"];
                                echo json_encode($response);
                                http_response_code(200);
                            }
                            else{
                                $response=["message" => "Error added to cart"];
                                echo json_encode($response);
                                http_response_code(300);
                            }
                    }
                    else{
                        $response=["message" => "Order already added to cart"];
                        echo json_encode($response);
                    } 
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


