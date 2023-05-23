<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../config/connection.php";
        include "functions.php";
        try{

            $brand=$_POST['brand'];
            $category=$_POST['category'];
            $gender=$_POST['gender'];
            $sort=$_POST['sort'];

            $limit=$_POST['limit'];
            $models=get_products_with_price($brand,$category,$gender,$sort,$limit);
            $num_of_pages = get_pagination_count($brand,$category,$gender,$sort);

            echo json_encode([
                "models" => $models,
                "num_of_pages" => $num_of_pages
            ]);
            http_response_code(200);


            
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


