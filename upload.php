<?php

session_start();
$nameBS = $_SESSION['userUid'];


if(isset($_POST['submit-img']))
{
    $file = $_FILES['file-img'];

    $fileName = $_FILES['file-img']['name'];
    $fileTmpName = $_FILES['file-img']['tmp_name'];
    $fileSize = $_FILES['file-img']['size'];
    $fileError = $_FILES['file-img']['error'];
    $fileType = $_FILES['file-img']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png','pdf');

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize > 1){
                $fileNameNew = "profile-".$nameBS.".jpg";
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName,$fileDestination);
                header("Location: ../DoAnBenhVien/drprofile.php?upload=success");
                exit();
            }
            else{
                header("Location: ../DoAnBenhVien/drprofile.php?error=tooheavyfile");
                exit();
            }
        }
        else{
            header("Location: ../DoAnBenhVien/drprofile.php?error=errorfile");
            exit();
        }
    }else{
        header("Location: ../DoAnBenhVien/drprofile.php?error=cannotuploadthistype");
        exit();
    }
}