<?php 

    //enctype="multipart/form-data" 
    $uploadDir = "upload/"
    if(isset($_POST['slika'])){
        
        //prvo dohvatimo sliku koju smo postavili
        $fileName = $_FILES['userFiles']['name'];
        $fileTmp = $_FILES['userFiles']['tmp_name'];
        $fileSize=$_FILES['useFiles']['size'];
        $fileType = $_FILES['userfiles']['type'];

        //inicijalizujemo i deklarisemo putanju slike
        $filePath=$uploadDir. "mala-" .$fileName;

        $nazivFajla = $tmpName;

        $novaSirina = 300; //fiksno
        //obavezno modifikovati heder
        //header('Content-type: image/jpeg');

        //proporcija 
        //staraSirina : staraVisina = novaSirina : novaVisina
        // staraVisina * novaSirina = staraSirina * novaVisina
        // novaVisina = staraVisina * novaSirina / staraVisina
        
        list($sirina,$visina) = getimagesize($nazivFajla);

        //ovo iz liste ubacimo u proporciju

        //1.korak pravljenje slike tacnije objekat slike u php
        //$thumb = imagecreatetruecolor($novaSirina,$novaVisina);

        //2.korak pravljenje jpg slike na osnovu fajla ili url
        //$izvor = imagecreatefromjpeg($nazivFajla);

        //3.kopiranje sadrzaja uz resize cele slike 
        //imagecopyresized($thumb,$izvor,0,0,0,0,$novaSirina,$novaVisina,$staraSirina,$staraVisina);

        //4.pravljenje slike za browser ili fajl
        //$done = imagejpeg($thumb,$filePath);
        if($done){
            echo "radi";
        }
        //imagedestroy($thumb);

    }