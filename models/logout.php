<?php
    session_start();
    if((isset($_SESSION['user']))){
        unset ($_SESSION['user']);
        unset($_SESSION['agent']);
        header("location: ../index.php");
    }
?>