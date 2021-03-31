<?php
    require 'dbc.inc.php';

    $tc = $_GET['profile'];
    $datasql = "SELECT * FROM chuyennghiep WHERE trieuchung = '$tc' group by tenBacSi";
    $dataresult = mysqli_query($conn, $datasql);
    if(mysqli_num_rows($dataresult) > 0){
        while($row = mysqli_fetch_assoc($dataresult)){
            echo '<img class="pro-load" style="width:40%;height:60%;margin-left:10px;border:solid 1px white;" src="uploads/profile-'.$row['tenBacSi'].'.jpg" alt="">';
            echo '<div style="width:50%;height:50%;float:right;">';
            echo  '  <p>Tên : '.$row['tenBacSi'].'</p>';
            echo  '    <p>Chuyên nghiệp trong :</p>';
            $tbs = $row['tenBacSi'];
            $datasql2 = "SELECT * FROM chuyennghiep WHERE tenBacSi = '$tbs'";
            $dataresult2 = mysqli_query($conn, $datasql2);
            if(mysqli_num_rows($dataresult2) > 0){
                while($row2 = mysqli_fetch_assoc($dataresult2)){
                    echo '<b>.'.$row2['trieuchung'].'</b>';
                    echo'</br>';
                }
            }
            echo  '</div>';
            echo  '<a id="del-3" style="color:white;margin-left:17%;margin-top:10%;font-size:25px;"href="drprofile-guess.php?dr='.$row['tenBacSi'].'">Xem trang cá nhân</a>';
        }
    }