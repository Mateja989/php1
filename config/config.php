<?php

// Osnovna podesavanja
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]."/Buzz");



// Ostala podesavanja
define("ENV_FILE", ABSOLUTE_PATH."/config/.env");
define("LOG_FILE", ABSOLUTE_PATH."/data/log.txt");


// Podesavanja za bazu
define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($name){
    $data = file(ENV_FILE);
    $data_value = "";
    foreach($data as $key=>$value){
        $config = explode("=", $value);
        if($config[0]==$name){
            $data_value = trim($config[1]); // trim() zbog \n
        }
    }
    return $data_value;
}