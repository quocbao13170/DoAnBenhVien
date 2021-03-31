<?php
    require 'dbc.inc.php';
    $CN = $_GET['location'];
    $datasql = "SELECT * FROM bacsi WHERE chinhanh = '$CN' GROUP BY khoa";
    $dataresult = mysqli_query($conn, $datasql);
    echo'<option value="">Chọn khoa</option>';
    echo'<option value="" disabled><------></option>';
    if(mysqli_num_rows($dataresult) > 0){
        while($row = mysqli_fetch_assoc($dataresult)){
            echo '<option value="'.$row['khoa'].'">'.$row['khoa'].'</option>';
            echo'<option value="" disabled><------></option>';
        }
    }