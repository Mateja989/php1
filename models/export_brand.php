<?php


session_start();
if($_SESSION['user']->role_id == 1)
{
    header("Content-Disposition: attachment; filename=brands.xls");
    header("Content-Type: application/x-msexcel");
    header('Content-Type: application/vnd.ms-excel');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header("Pragma: no-cache");
    include "../config/connection.php";
    include "functions.php";
    $brands = get_data("brand");
    $export_string = "Id\t Name\n";
    foreach($brands as $brand) {
        $export_string .= $brand->brand_id . "\t" . $brand->brand_name
        ."\n";
    }
    echo $export_string;
    }
    else{
header("Location: index.php");
}


