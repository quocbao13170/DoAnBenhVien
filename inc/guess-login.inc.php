<?php 
if(isset($_POST['guess-login-submit'])){ /*check if user pressed the login button or not*/
    require 'dbc.inc.php';

    $mailuid = $_POST['usernameG'];
    $password = $_POST['passwordG'];

    if(empty($mailuid) || empty($password)){
        header("Location: ../index.php?error=emptyfield");
        exit();
    }else {
        $sql = "SELECT * FROM benhnhan WHERE usernameG=?;";
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
                $pwdCheck =  password_verify($password,$row['passwordG']);
                if($pwdCheck == false){
                    header("Location: ../index.php?error=wrongpass");
                    exit();
                }
                else if($pwdCheck == true){
                    session_start();
                    $_SESSION['usernameG'] =  $row['usernameG'];
                    $_SESSION['tenBN'] =  $row['tenBN'];
                    
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
}else{
    header("Location: ../index.php");
    exit();
}