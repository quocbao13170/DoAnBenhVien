<?php
    require 'dbc.inc.php';
    $pf = $_GET['profile'];
    if(empty($pf)){
        exit();
    }
    $persondatasql4 = "SELECT AVG(danhgia) as avgscore FROM binhluan WHERE tenBacSi = '$pf'";
    $persondataresult4 = mysqli_query($conn, $persondatasql4);
    while($row4 = mysqli_fetch_assoc($persondataresult4)){
        $round = round($row4['avgscore'], 2);
        echo '<div style="display:flex;margin-top:10px;margin-bottom:10px;border:solid black">';
            echo '<img class="pro-load" style="width:70px;" src="uploads/profile-'.$pf.'.jpg" alt="">';
            echo '<div style="margin-left:10px;color:black;">';
                echo 'Tên : '.$pf.'.';
                echo '</br>';
                echo 'Đánh giá : '.$round.'/5.';
                echo '</br>';
                echo '<a style="" href="drprofile-guess.php?dr='.$pf.'">Xem trang cá nhân</a>';
            echo '</div>';
        echo '</div>';
    }