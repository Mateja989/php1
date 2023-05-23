<?php
    $uploadDir = "../assets/images/";
    if(isset($_POST['btn-product'])){
        
        $slikaNaziv = $_FILES['cover_picture']['name']; //logo.jpg
        $slikaTmp = $_FILES['cover_picture']['tmp_name']; //putanja
        $slikaTip = $_FILES['cover_picture']['type']; //image/jpeg

        $putanja = $uploadDir."mala1-".$slikaNaziv;

        //$premestanje=move_uploaded_file($slikaTmp,$putanja);

        $novaVisina = 300;

        //staraSirina:staraVisina = novaSirina:novaVisina
        //staraVisina * novaSirina = staraSirina * novaVisina
        //novaSirina = (staraSirina * novaVisina) / staraVisina

        list($sirina,$visina) = getimagesize($slikaTmp);
        header("Content-type: image/jpeg");

        //echo $visina."  ".$sirina;

        $novaSirina = ($sirina * $novaVisina) / $visina;

        $thumb = imagecreatetruecolor($novaSirina,$novaVisina);

        $slika=imagecreatefromjpeg($slikaTmp);
        
        imagecopyresized($thumb,$slika,0,0,0,0,$novaSirina,$novaVisina,$sirina,$visina);

        imagejpeg($thumb,$putanja);
        
        imagedestroy($thumb);


        

    }