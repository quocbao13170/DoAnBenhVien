<?php
if(isset($_POST['login-admin-submit'])){ /*check if user pressed the login button or not*/
    require 'dbc.inc.php';

    $mailuid = $_POST['adid'];
    $password = $_POST['adpass'];

    if(empty($mailuid) || empty($password)){
        header("Location: ../admin.php?error=emptyfields&mailuid=" .$mailuid);
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE nameUsers=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../admin.php?error=sqlerror");
            exit();
        }
        else{
            
            mysqli_stmt_bind_param($stmt, "s", $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck =  password_verify($password,$row['pwdUsers']);
                if($pwdCheck == false){
                    header("Location: ../admin.php?error=wrongpass");
                    exit();
                }
                else if($pwdCheck == true){
                    session_start();
                    $_SESSION['AdId'] =  $row['id'];
                    $_SESSION['AdUid'] =  $row['nameUsers'];
                    
                    header("Location: ../admin.php?login=success");
                    exit();

                }else{
                    header("Location: ../admin.php?error=wrongpass");
                    exit();
                }
            }
            else{
                header("Location: ../admin.php?error=nouser");
                exit();
            }
        }
    }
}
else{
    header("Location: ../admin.php");
    exit();
}