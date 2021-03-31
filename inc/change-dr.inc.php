<?php 
if(isset($_POST['changedr-submit'])){
    require 'dbc.inc.php';

    $name = $_GET['ddr'];
    $namedr = $_POST['namedr'];
    $emaildr = $_POST['emaildr'];
    $passdr = $_POST['passdr'];
    $khoa = $_POST['khoadr'];
    $chinhanh = $_POST['cndr'];

    if(empty($namedr) && empty($emaildr) && empty($passdr) && empty($khoa) && empty($chinhanh)){
        header("Location: ../admin.php?error=emptyfields");
        exit();
    }
    if(empty($namedr)){
        $namedr = $name;
    }
    if(empty($emaildr)){
        $datasql1 = "SELECT * FROM bacsi WHERE tenBacSi = '$name'";
        $dataresult1 = mysqli_query($conn, $datasql1);
        if(mysqli_num_rows($dataresult1) > 0){
        while($row1 = mysqli_fetch_assoc($dataresult1)){
            $emaildr = $row1['emailBacSi'];
        }
    }
    }
    if(empty($passdr)){
        $datasql2 = "SELECT * FROM bacsi WHERE tenBacSi = '$name'";
        $dataresult2 = mysqli_query($conn, $datasql2);
        if(mysqli_num_rows($dataresult2) > 0){
        while($row2 = mysqli_fetch_assoc($dataresult2)){
            $passdr = $row2['pwdBacSi'];
        }
    }
    }
    if(empty($khoa)){
        $datasql3 = "SELECT * FROM bacsi WHERE tenBacSi = '$name'";
        $dataresult3 = mysqli_query($conn, $datasql3);
        if(mysqli_num_rows($dataresult3) > 0){
        while($row3 = mysqli_fetch_assoc($dataresult3)){
            $khoa = $row3['khoa'];
        }
    }
    }
    if(empty($chinhanh)){
        $datasql4 = "SELECT * FROM bacsi WHERE tenBacSi = '$name'";
        $dataresult4 = mysqli_query($conn, $datasql4);
        if(mysqli_num_rows($dataresult4) > 0){
        while($row4 = mysqli_fetch_assoc($dataresult4)){
            $chinhanh = $row4['chinhanh'];
        }
    }
    }
    if(!filter_var($emaildr, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../admin.php?error=invalidmail");
        exit();
    }
    else {
        $datasql = "SELECT * FROM bacsi WHERE tenBacSi = '$name'";
        $dataresult = mysqli_query($conn, $datasql);
        if(mysqli_num_rows($dataresult) > 0){
        while($row = mysqli_fetch_assoc($dataresult)){
                
                $sql = "UPDATE bacsi set tenBacSi = ? ,emailBacSi = ?,pwdBacSi = ?,khoa = ?,chinhanh = ? where tenBacSi = '$name' ";
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
