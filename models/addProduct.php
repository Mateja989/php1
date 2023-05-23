<?php
    $uploadDir='../assets/img/';
    if(isset($_POST['btn-product'])){

        session_start();
        require_once "../config/connection.php";
        require_once "functions.php";

        //$conn->beginTransaction();

        $model=$_POST['model'];
        $brand_id=$_POST['brand']; 
        $category_id=$_POST['category']; 
        $gender_id=$_POST['gender'];
        $price=$_POST['price'];
        $sizes=$_POST['chbSize']; 
        $errors=false;

        $brandArray=get_data('brand');
        $genderArray=get_data('gender');
        $categoryArray=get_data('category');

        $brandIds=[];
        foreach($brandArray as $brand){
            $brandIds[]=$brand->brand_id;
        }
        if(!in_array($brand_id,$brandIds) || $brand_id == 0){
            $_SESSION['brandError']="You have to choose only available brand.";
            $errors=true;
        }


        $categoryIds=[];
        foreach($categoryArray as $category){
            $categoryIds[]=$category->category_id;
        }
        if(!in_array($category_id,$categoryIds) || $category_id == 0){
            $_SESSION['categoryError']="You have to choose only available category.";
            $errors=true;
        }


        $genderIds=[];
        foreach($genderArray as $gender){
            $genderIds[]=$gender->gender_id;
        }
        if(!in_array($gender_id,$genderIds) || $gender_id == 0){
            $_SESSION['genderError']="You have to choose only available gender.";
            $errors=true;
        }

        if(empty($sizes)){
            $_SESSION['sizesError']="You have to choose at least one size for model.";
            $errors=true;
        }

        if($price <= 0 || $price >= 999){
            $_SESSION['priceError']="Price have to be in range of 1-999.";
            $errors=true;
        }

        $regModel="/^[a-z0-9 ,.'-]+/";

        if(invalidInput($model,$regModel) || $model== ""){
            $_SESSION['modelError']="Model's name does not in correct format.";
            $errors=true;
        }

        $pictureName=$_FILES['cover_picture']['name'];
        $tmpName=$_FILES['cover_picture']['tmp_name'];
        $pictureType=$_FILES['cover_picture']['type'];

        $fileTypes=["image/jpg","image/jpeg","image/png"];

        if(!in_array($pictureType,$fileTypes)){
            $_SESSION['pictureError']="Picture have to be in jpg/png or jpeg format.";
            $errors=true;
        }

        $filePath=$uploadDir . $pictureName;
        $pathForDB="assets/img/" . $pictureName;

        if(!$errors){
            move_uploaded_file($tmpName,$filePath);


            $add = addProduct($model,$brand_id,$category_id,$gender_id,$pathForDB);

            if($add){
                $lastId=$conn->lastInsertId(); 
                $addPrice=addPrice($price,$lastId);
            if($addPrice){
                    foreach($sizes as $size){
                        $addSizes=addSizes($lastId,$size);
                    }
                    $_SESSION['successModel']="Successfully added new product.";
                }
            }

            header('location: ../index.php?page=add_product');
        }
        else{
            header('location: ../index.php?page=add_product');
        }
       //$conn->commit();
    }
    else{
        header('location: ../index.php');
    }