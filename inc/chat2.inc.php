<?php
if(isset($_POST['chat-submit'])){
    require 'dbc.inc.php';

    $nggui = $_GET['nggui'];
    $ngnhan = $_GET['ngnhan'];

    $chat = $_POST['chat-text'];

    $sql = "INSERT INTO chatbox (nggui,ngnhan,ndchat) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../drprofile.php?&error=sqlerror");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt, "sss", $nggui, $ngnhan, $chat);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        header("Location: ../drprofile.php");
        exit();
    }
}

