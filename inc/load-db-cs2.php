<?php
    require 'dbc.inc.php';
    $CN = $_GET['location'];
    $PF = $_GET['profession'];
    $persondatasql = "SELECT * FROM bacsi WHERE chiNhanh = '$CN' AND khoa = '$PF'";
    $persondataresult = mysqli_query($conn, $persondatasql);
    echo'<option value="">Chọn bác sĩ</option>';
    echo'<option value="" disabled><------></option>';
    if(mysqli_num_rows($persondataresult) > 0){
        while($row = mysqli_fetch_assoc($persondataresult)){
            echo '<option value="'.$row['tenBacSi'].'">'.$row['tenBacSi'].'</option>';
            echo'<option value="" disabled><------></option>';
        }
    }   