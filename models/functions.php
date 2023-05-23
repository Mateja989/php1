<?php 
    function get_data($table_name){
        global $conn;

        $sql="SELECT * FROM $table_name";

        return $conn->query($sql)->fetchAll(); //kada vracam vise redova
        
    }

    function registrationUser($first_name,$last_name,$username,$email,$password,$city_id,$street,$street_number){
        global $conn;
        $role_id=2;
        $sql="INSERT INTO user(first_name,last_name,passwd,mail,city_id,street,street_number,role_id,username) VALUES (:first_name,:last_name,:passwd,:mail,:city,:street,:street_number,:role_id,:username)";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":first_name",$first_name);
        $stmt->bindParam(":last_name",$last_name);
        $stmt->bindParam(":passwd",$password);
        $stmt->bindParam(":mail",$email);
        $stmt->bindParam(":city",$city_id);
        $stmt->bindParam(":street",$street);
        $stmt->bindParam(":street_number",$street_number);
        $stmt->bindParam(":role_id",$role_id);
        $stmt->bindParam(":username",$username);
    
        $result=$stmt->execute();
    
        return $result;
    }

    function loginUser($username,$password){
        $result;
        global $conn;
        $sql="SELECT * FROM user u JOIN role r ON u.role_id = r.role_id WHERE u.username = :username AND u.passwd = :pass";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":pass",$password);
        $stmt->execute();
    
        $result=$stmt->fetch();
    
        return $result;
    }
    
    function existEmail($email){
        global $conn;
        $sql = "SELECT * FROM user WHERE mail = :mail";
    
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":mail",$email);
        $stmt->execute();
    
        $count=$stmt->rowCount();
    
        if($count){
            return false;
        }else{
            return true;
        }
    }

    function existUsername($username){
        global $conn;
        $sql = "SELECT * FROM user WHERE username = :username";
    
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":username",$username);
        $stmt->execute();
        $count=$stmt->rowCount();
        if($count){
            return false;
        }else{
            return true;
        }
    }

    function invalidInput($field,$fieldReg){
        $result;
        if(preg_match($fieldReg,$field)){
    
            $result=true;
        }
        else{
            $result=false;
        }
        return $result;
    }

    function invalidEmail($email){
        $result;
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $result=true;
        }
        else{
            $result=false;
        }
        return $result;
    }
    function addProduct($model,$brand_id,$category_id,$gender_id,$pathForDB){
        global $conn;
        $sql="INSERT INTO sneaker(sneaker_name,brand_id,gender_id,category_id,cover_picture) VALUES (:model,:brand,:gender,:category,:picture)";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":model",$model);
        $stmt->bindParam(":brand",$brand_id);
        $stmt->bindParam(":gender",$gender_id);
        $stmt->bindParam(":category",$category_id);
        $stmt->bindParam(":picture",$pathForDB);

        $result=$stmt->execute();

        return $result;
    }
    
    function addPrice($price,$modelId){
        global $conn;
        $sql="INSERT INTO price(sneaker_id,price) VALUES (:model,:price)";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":model",$modelId);
        $stmt->bindParam(":price",$price);

        $result=$stmt->execute();

        return $result;
    }
    function addSizes($modelId,$size){
        global $conn;
        $sql="INSERT INTO sneaker_size(sneaker_id,size_id) VALUES (:model,:size)";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":model",$modelId);
        $stmt->bindParam(":size",$size);

        $result=$stmt->execute();

        return $result;
    }
    function addSpecification($specification,$modelId){
        global $conn;
        $sql="INSERT INTO sneaker_specification(sneaker_Id,specification_id) VALUES (:model,:spec)";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":model",$modelId);
        $stmt->bindParam(":spec",$specification);

        $result=$stmt->execute();

        return $result;
    }
    define("MODEL_OFFSET", 6);

    function get_products_with_price($brand=0,$category=0,$gender=0,$sort=0,$limit=0){
        global $conn;
        $sql="SELECT * FROM sneaker s INNER JOIN gender g ON s.gender_id=g.gender_id INNER JOIN category c ON s.category_id=c.category_id INNER JOIN brand b ON s.brand_id=b.brand_id ";

        if($brand != 0){
            $sql.="WHERE b.brand_id = $brand ";
        }
        if($category != 0){
            if($brand !=0){
                $sql.="AND c.category_id = $category ";
            }
            else{
                $sql.="WHERE c.category_id = $category ";
            }
        }
        if($gender != 0){
            if($category !=0 || $brand != 0){
                $sql.="AND g.gender_id = $gender ";
            }
            else{
                $sql.="WHERE g.gender_id = $gender ";
            }
        }

        if($sort != 0){
            if($sort == "asc"){
                $sql.="ORDER BY s.sneaker_name ASC";
            }
            if($sort == "desc"){
                $sql.="ORDER BY s.sneaker_name DESC";
            }
        }

        $sql.=" LIMIT :limit,:offset";

        $stmt=$conn->prepare($sql);
        $limit = ((int) $limit) * MODEL_OFFSET;
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT); 
        $offset = MODEL_OFFSET;
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);

        $stmt->execute(); 
        $models = $stmt->fetchAll();

        foreach($models as $model){
            $priceObj=get_price($model->sneaker_id);
            $model->currently_price=$priceObj->price;
        }
        

        return $models;
    }
    function get_price($id){
        global $conn;
        $sql="SELECT * FROM price WHERE sneaker_id=:id ORDER BY started_at DESC LIMIT 1";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":id",$id);

        $result=$stmt->execute();
        $result=$stmt->fetch();

        return $result;
    }
    function get_model_with_sizes($id){
        global $conn;
        $sql="SELECT * FROM sneaker s INNER JOIN gender g ON s.gender_id=g.gender_id INNER JOIN category c ON s.category_id=c.category_id INNER JOIN brand b ON s.brand_id=b.brand_id WHERE s.sneaker_id=:id";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':id',$id);

        
        $stmt->execute();
        $model=$stmt->fetch();

        $priceObj=get_price($model->sneaker_id);
        $model->price=$priceObj->price;
        $model->sizes = get_sizes_for_model($model->sneaker_id);
        
        return $model;
    }
    function get_num_of_model($brand=0,$category=0,$gender=0,$sort=0){

        global $conn;
        $sql="SELECT COUNT(*) as num_of_model FROM sneaker s INNER JOIN gender g ON s.gender_id=g.gender_id INNER JOIN category c ON s.category_id=c.category_id INNER JOIN brand b ON s.brand_id=b.brand_id ";

        if($brand != 0){
            $sql.="WHERE b.brand_id = $brand ";
        }
        if($category != 0){
            if($brand !=0){
                $sql.="AND c.category_id = $category ";
            }
            else{
                $sql.="WHERE c.category_id = $category ";
            }
        }
        if($gender != 0){
            if($category !=0 || $brand != 0){
                $sql.="AND g.gender_id = $gender ";
            }
            else{
                $sql.="WHERE g.gender_id = $gender ";
            }
        }

        if($sort != 0){
            if($sort == "asc"){
                $sql.="ORDER BY s.sneaker_name ASC";
            }
            if($sort == "desc"){
                $sql.="ORDER BY s.sneaker_name DESC";
            }
        }

        return $conn->query($sql)->fetch();
    }
    
    function get_pagination_count($brand=0,$category=0,$gender=0,$sort=0){
        $result = get_num_of_model($brand,$category,$gender,$sort);
        $num_of_movies = $result->num_of_model;
    
        return ceil($num_of_movies / MODEL_OFFSET);
    }

    function get_sizes_for_model($model){
        global $conn;
        $sql="SELECT * FROM sneaker s INNER JOIN sneaker_size ss ON s.sneaker_id=ss.sneaker_id INNER JOIN size si ON ss.size_id=si.size_id WHERE s.sneaker_id=:id";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':id',$model);

        $stmt->execute();
        $result=$stmt->fetchAll();

        return $result;
    }
    function brand_exist($brand){
        global $conn;
        $sql = "SELECT * FROM brand WHERE brand_name = :brand";
    
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":brand",$brand);
        $stmt->execute();
        $count=$stmt->rowCount();
        if($count){
            return false;
        }else{
            return true;
        }
    }
    function insert_brand($brand){
        global $conn;
        $sql="INSERT INTO brand(brand_name) VALUES (:brand_name)";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":brand_name",$brand);
        $result=$stmt->execute();

        return $result;
    }
    function delete_model($id){
        global $conn;
        $sql="DELETE FROM sneaker WHERE sneaker_id=:id";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":id",$id);
        $result=$stmt->execute();

        return $result;
    }
    function get_user($id){
        global $conn;
        $sql="SELECT * FROM user u INNER JOIN city c ON u.city_id=c.city_id INNER JOIN role r ON u.role_id=r.role_id WHERE u.user_id=:id";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":id",$id);
        $result=$stmt->execute();
        $result=$stmt->fetch();

        return $result;
    }
    function insert_new_price($id,$price){
        global $conn;
        $sql="INSERT INTO price(sneaker_id,price) VALUES(:id,:price)";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":price",$price);

        $result=$stmt->execute();
        
        return $result;
    }
    function create_order($user){
        global $conn;
        $sql="INSERT INTO cart(user_id) VALUES(:id)";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":id",$user);

        $result=$stmt->execute();
        
        return $result;

    }

    function exist_not_confirm_order($user){
        global $conn;
        $status=0;
        $sql="SELECT * FROM cart WHERE user_id=:id AND status=:x";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":id",$user);
        $stmt->bindParam(":x",$status);

        $result=$stmt->execute();
        $result=$stmt->rowCount();
        
        return $result;
    }
    
    function get_price_for_item($sneaker){
        global $conn;
        $sql="SELECT price FROM price WHERE sneaker_id=:id ORDER BY started_at DESC";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":id",$sneaker);

        $result=$stmt->execute();
        $result=$stmt->fetch();
        
        return $result;
    };
    function insert_order_item($cart,$sneaker,$item_price){
        global $conn;
        $sql="INSERT INTO cart_sneaker(cart_id,sneaker_id,price) VALUES(:cart,:sneaker,:price)";

        

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":cart",$cart);
        $stmt->bindParam(":sneaker",$sneaker);
        $stmt->bindParam(":price",$item_price);

        $result=$stmt->execute();
        
        return $result;
    }
    function cart_id($user){
        global $conn;
        $status=0;
        $sql="SELECT * FROM cart WHERE user_id=:id AND status=:x";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":id",$user);
        $stmt->bindParam(":x",$status);

        $result=$stmt->execute();
        $result=$stmt->fetch();
        
        return $result;
    }
    function exist_item_in_cart($cart_id,$sneaker){
        global $conn;
        $status=0;
        $sql="SELECT * FROM cart_sneaker WHERE cart_id=:id AND sneaker_id=:x";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":id",$cart_id);
        $stmt->bindParam(":x",$sneaker);

        $result=$stmt->execute();
        $result=$stmt->rowCount();
        
        return $result;
    }

    function get_cart_items($user,$status){
        global $conn;

        $sql="SELECT c.cart_id,cs.price,s.sneaker_name,s.cover_picture,cs.cart_snaker_id FROM cart c INNER JOIN cart_sneaker cs ON c.cart_id=cs.cart_id INNER JOIN sneaker s ON cs.sneaker_id=s.sneaker_id WHERE c.user_id=:id AND c.status=:s";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":id",$user);
        $stmt->bindParam("s",$status);

        $stmt->execute();
        $result=$stmt->fetchAll();

        return $result;
    }
    function delete_model_from_cart($id){
        global $conn;

        $sql="DELETE FROM cart_sneaker WHERE cart_snaker_id=:id";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam("id",$id);
        $result=$stmt->execute();
        
        return $result;
    }
    function finished_purchase($user,$status,$total_price){
        global $conn;
        $finished=1;
        $sql="UPDATE cart SET status = :finished,total_price = :total_price WHERE user_id = :id AND status = :s";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":finished",$finished);
        $stmt->bindParam(":total_price",$total_price);
        $stmt->bindParam(":id",$user);
        $stmt->bindParam(":s",$status);

        $result=$stmt->execute();

        return $result;
    }

    function sendMessage($firstName,$lastName,$headline,$message){
        global $conn;
    
        $sql="INSERT INTO contact(message_header,message_body,first_name,last_name) VALUES(:header,:body,:firstname,:lastname)";
    
        $stmt=$conn->prepare($sql);
    
        $stmt->bindParam(':header',$headline);
        $stmt->bindParam(':body',$message);
        $stmt->bindParam(':firstname',$firstName);
        $stmt->bindParam(':lastname',$lastName);
    
        $result=$stmt->execute();
    
        return $result;
    }
    function get_message($id){
        global $conn;
        $sql="SELECT * FROM contact WHERE contact_id= :id";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result=$stmt->fetch();

        return $result;
    }
    function mark_as_message_read($id){
        global $conn;

        $read_mark=1;
        $sql="UPDATE contact SET message_read = :mark WHERE contact_id=:id";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":mark",$read_mark);
        $stmt->bindParam(":id",$id);
        $result=$stmt->execute();

        return $result;
    }
    function get_complete_purchases($status){
        global $conn;
        $sql="SELECT * FROM cart c INNER JOIN user u ON c.user_id=u.user_id INNER JOIN city ci ON u.city_id=ci.city_id WHERE c.status=:s";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':s',$status);
        $stmt->execute();
        $result=$stmt->fetchAll();

        return $result;
    }
    function get_cart_details($id){
        global $conn;
        $sql="SELECT * FROM cart_sneaker cs INNER JOIN sneaker s ON cs.sneaker_id=s.sneaker_id INNER JOIN brand b ON s.brand_id=b.brand_id WHERE cart_id = :id";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $result=$stmt->fetchAll();

        return $result;
    }
    function get_total_price($id,$status){
        global $conn;
        $sql="SELECT SUM(cs.price) as total_price FROM cart_sneaker cs INNER JOIN cart c ON cs.cart_id=c.cart_id WHERE user_id = :id  AND status = :s";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':s',$status);
        $stmt->execute();
        $result=$stmt->fetch();

        return $result;
    }

   function get_num_of_products($id,$status){
        global $conn;
        $sql="SELECT * FROM cart_sneaker cs INNER JOIN cart c ON cs.cart_id=c.cart_id WHERE user_id = :id  AND status = :s";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':s',$status);
        $stmt->execute();

        $result=$stmt->rowCount();

        return $result;
   }
   function recordAuthorizedUser($username){
        $open = fopen("../data/login_record.txt", "a");
        if($open){


            $date = date('d-m-Y H:i:s');
            $user=$username;

            fwrite($open, "{$username}\t{$date}\t{$_SERVER['REMOTE_ADDR']}\t\n");
            fclose($open);
        }
    }


    function dohvatiSpec($kat)
    {
        global $conn;
        $sql = "SELECT * FROM specifikacija_kategorija WHERE kategorija_id = :id";

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(":id",$kat);

        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;

    }

    function stranaPregled($name){
        $open = fopen("data/stranica.txt", "a");
        if($open){
            

            $date = date('d-m-Y H:i:s');
    
            $user="unauthorized";
    
            if(isset($_SESSION['user'])){
                $user=$_SESSION['user']->mail;
            }
    
            fwrite($open, "{$date}\t{$_SERVER['REMOTE_ADDR']}\t{$name}\t\n");
            fclose($open);
        }
    }

  



