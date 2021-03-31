<?php
if(isset($_GET['ngg'])){
    require 'dbc.inc.php';

    $get=$_GET['ngg'];
    $sql = 'DELETE FROM chatbox WHERE nggui= ? or ngnhan= ?';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../drprofile.php?error=sqlerror");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "ss", $get , $get);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        header("Location: ../drprofile.php?delete=success");
        exit();
    }
}