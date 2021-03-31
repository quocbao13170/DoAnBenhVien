<?php 
if(isset($_POST['comment-submit'])){
    require 'dbc.inc.php';

    if(isset($_POST['star'])){
        $star = $_POST['star'];
    }else{
        $star = 0;
    }

    $name = $_POST['comment-name'];
    $cm = $_POST['comment'];
    $doctor = $_GET['tbs'];

    if(empty($name) || empty($cm)){
        header("Location: ../drprofile-guess.php?dr=".$doctor."&error=emptyfields&uid");
        exit();
    }else{
        $sql = "INSERT INTO binhluan (tenbl,binhluan,danhgia,tenBacSi) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../drprofile-guess.php?dr=".$doctor."&error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "ssss", $name, $cm, $star, $doctor);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            header("Location: ../drprofile-guess.php?dr=".$doctor."&signup=success");
            exit();
        }
    }
}else{
    header("Location: ../drprofile-guess.php?dr=".$doctor."");
    exit();
}