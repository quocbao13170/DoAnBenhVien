<?php 
if(isset($_POST['signup-submit'])){
    require 'dbc.inc.php';

    $hvt = $_POST['hoten'];
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $repassword = $_POST['pwd-repeat'];

    $sdt = $_POST['sdt'];
    $cmnd = $_POST['cmnd'];
    $dc = $_POST['dc'];

    if(empty($hvt) ||empty($username) || empty($email) || empty($password) || empty($repassword) || empty($sdt) || empty($cmnd) || empty($dc)){
        header("Location: ../signup.php?error=emptyfields&uid=" .$username. "&mail=" .$email);
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidmail&uid");
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid=" .$username);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduid&mail=" .$email);
        exit();
    }
    else if($password !== $repassword){
        header("Location: ../signup.php?error=passwordincorrect&uid=" .$username. "&mail=" .$email);
    }
    else if(!preg_match("/^[0-9]*$/", $sdt)) {
        header("Location: ../signup.php?error=invalidphonenumber");
        exit();
    }
    else if(!preg_match("/^[0-9]*$/", $cmnd)) {
        header("Location: ../signup.php?error=invalididnumber");
        exit();
    }
    else {
        $sql = "SELECT usernameG From benhnhan WHERE usernameG=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: ../signup.php?error=usertaken&mail=" .$email);
                exit();
            }
            else{
                $sql = "INSERT INTO benhnhan (tenBN,usernameG,email,passwordG,sodt,soCMND,diachi) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else{
                    $encryptedpwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssssss", $hvt, $username, $email, $encryptedpwd , $sdt,$cmnd,$dc);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../signup.php");
    exit();
}
