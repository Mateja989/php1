<?php

require_once "../config/connection.php";
include "functions.php";

$movies = get_data('brand');

// Pokretanje Excel aplikacije
$excel = new COM("Excel.Application");

// Da bi se fizički videlo otvaranje fajla
$excel->Visible = 1;

// recommend to set to 0, disables alerts like "Do you want MS Word to be the default .. etc"
$excel->DisplayAlerts = 1;

// Otvaranje Excel fajla
$workbook = $excel->Workbooks->Open("") or die('Did not open filename');

// Otvaranje Sheet
$sheet = $workbook->Worksheets('Sheet1');
$sheet->activate;

$br = 1;
foreach($movies as $movie){
    // U A kolonu upisujemo ID
    $polje = $sheet->Range("A{$br}");
    $polje->activate;
    $polje->value = $movie->brand_id;

    // U B kolonu upisujemo TITLE
    $polje = $sheet->Range("B{$br}");
    $polje->activate;
    $polje->value = $movie->brand_name;

   

    $br++;
}



// Cuvanje promena u fajla
$workbook->_SaveAs("http://localhost/Buzz/Filmovi.xlsx", -4143);
$workbook->Save();

// Zatvaranje Excel fajla
$workbook->Saved=true;
$workbook->Close;

$excel->Workbooks->Close();
$excel->Quit();

unset($sheet);
unset($workbook);
unset($excel);