<?php
if(isset($_POST['doctor-login-submit'])){
    require 'dbc.inc.php';

    $mail = $_POST['emailBacSi'];
    $password = $_POST['pwdBacSi'];

    if(empty($mail) || empty($password)){
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?error=invalidmail");
        exit();
    }
    else {
        $sql = "SELECT * FROM bacsi WHERE emailBacSi=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $mail);
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
                    $_SESSION['idBS'] =  $row['isBS'];
                    $_SESSION['tenBacSi'] =  $row['tenBacSi'];
                    $_SESSION['emailBacSi'] =  $row['emailBacSi'];
                    
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