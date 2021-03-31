<?php
if(isset($_POST['datlich-submit2'])){
    require 'dbc.inc.php';

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $number = $_POST['phonenumber'];
    $location = $_POST['tag0'];
    $profession = $_POST['tag1'];
    $doctor = $_POST['tag2'];
    $time = $_POST['tag3'];

    if(empty($firstname) || empty($firstname) || empty($number) || empty($location) || empty($profession) || empty($doctor)){
        header("Location: ../drprofile-guess.php?dr=".$doctor."&error=emptyfield");
        exit();
    }else if(!preg_match("/^[0-9]*$/", $number)) {
        header("Location: ../drprofile-guess.php?dr=".$doctor."&error=invalidnumber");
        exit();
    }else{
        $sql = "SELECT tenBacSi From datlich WHERE tenBacSi=? AND time=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../drprofile-guess.php?dr=".$doctor."&error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $doctor,$time);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0)
            {
                    header("Location: ../drprofile-guess.php?dr=".$doctor."&error=matchtime");
                    exit();
            }
            else
            {
                $sql = "INSERT INTO datlich (userTen,userHo,sodt,chiNhanh,khoa,tenBacSi,time) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../drprofile-guess.php?dr=".$doctor."&error=sqlerror");
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname, $number, $location,$profession,$doctor,$time);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    header("Location: ../drprofile-guess.php?dr=".$doctor."&datlich=success");
                    exit();
                }
            }
        }
        
        
    }
    
}
else{
    $doctor = $_POST['tag2'];
    header("Location: ./drprofile-guess.php?dr=".$doctor."&error=failed");
    exit();
}