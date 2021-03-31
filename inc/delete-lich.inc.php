<?php 
    require 'dbc.inc.php';

    $getrow=$_GET['rn'];
    $sql = 'DELETE FROM datlich WHERE date_created=?';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../drprofile.php?error=sqlerror");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $getrow);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        header("Location: ../drprofile.php?delete=success");
        exit();
    }