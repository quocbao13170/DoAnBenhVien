<?php 
if(isset($_POST['signupdr-submit'])){
    require 'dbc.inc.php';

    $namedr = $_POST['namedr'];
    $emaildr = $_POST['emaildr'];
    $passdr = $_POST['passdr'];
    $khoa = $_POST['khoadr'];
    $chinhanh = $_POST['cndr'];

    if(empty($namedr) || empty($emaildr) || empty($passdr) || empty($khoa) || empty($chinhanh)){
        header("Location: ../admin.php?error=emptyfields");
        exit();
    }
    else if(!filter_var($emaildr, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../admin.php?error=invalidmail");
        exit();
    }
    else {
        $sql = "SELECT tenBacSi From bacsi WHERE tenBacSi=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../admin.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $namedr);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: ../admin.php?error=usertaken");
                exit();
            }
            else{
                $sql = "INSERT INTO bacsi (tenBacSi,emailBacSi,pwdBacSi,khoa,chinhanh) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../admin.php?error=sqlerror");
                    exit();
                }
                else{
                    $encryptedpwd = password_hash($passdr, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssss", $namedr, $emaildr, $encryptedpwd,$khoa,$chinhanh);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    header("Location: ../admin.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../admin.php");
    exit();
}
