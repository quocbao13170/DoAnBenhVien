<?php
if(isset($_POST['login-submit'])){ /*check if user pressed the login button or not*/
    require 'dbc.inc.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pass'];

    if(empty($mailuid) || empty($password)){
        header("Location: ../index.php?error=emptyfield");
        exit();
    }
    else {
        $sql = "SELECT * FROM bacsi WHERE emailBacSi=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else{
            
            mysqli_stmt_bind_param($stmt, "s", $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck =  password_verify($password,$row['pwdBacSi']);
                if($pwdCheck == false){
                    header("Location: ../index.php?error=wrongpass");
                    exit();
                }
                else if($pwdCheck == true){
                    session_start();
                    $_SESSION['userId'] =  $row['idBS'];
                    $_SESSION['userUid'] =  $row['tenBacSi'];
                    $_SESSION['userEmail'] =  $row['emailBacSi'];
                    
                    header("Location: ../index.php?login=success");
                    exit();

                }else{
                    header("Location: ../index.php?error=wrongpass");
                    exit();
                }
            }
            else{
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }
}
else{
    header("Location: ../index.php");
    exit();
}