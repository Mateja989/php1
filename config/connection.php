<?php

require_once "config.php";

recordUserLog();

try {
    $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}

function recordUserLog(){
    $open = fopen(LOG_FILE, "a");
    if($open){
        $date = date('d-m-Y H:i:s');

        $user="unauthorized";

        if(isset($_SESSION['user'])){
            $user=$_SESSION['user']->mail;
        }

        fwrite($open, "{$_SERVER['REQUEST_URI']}\t{$date}\t{$_SERVER['REMOTE_ADDR']}\t{$user}\t\n");
        fclose($open);
    }
}