<?php
 require 'dbc.inc.php';

 $getrow=$_GET['ddr'];
 $sql = 'DELETE FROM bacsi WHERE tenBacSi=?';
 $stmt = mysqli_stmt_init($conn);
 if(!mysqli_stmt_prepare($stmt, $sql)){
     header("Location: ../admin.php?error=sqlerror");
     exit();
 }
 else{
     mysqli_stmt_bind_param($stmt, "s", $getrow);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_store_result($stmt);
     
     header("Location: ../admin.php?delete=success");
     exit();
 }