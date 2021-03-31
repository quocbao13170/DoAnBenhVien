<?php
    require 'dbc.inc.php';
    $name = $_GET['name'];
    $datasql = "SELECT * FROM bacsi WHERE tenBacSi = '$name'";
    $dataresult = mysqli_query($conn, $datasql);
    if(mysqli_num_rows($dataresult) > 0){
        while($row = mysqli_fetch_assoc($dataresult)){
        echo '<div style=width:100vw;height:190px;">';
            echo '<div style="display:flex;border:solid black;width:99.7vw;height:110px;">';
                echo '<img style="width:100px;" src="uploads/profile-'.$row['tenBacSi'].'.jpg" alt="">';
                echo '<p style="font-size:30px;margin-left:40px;margin-top:20px;">'.$row['tenBacSi'].'</p>';
                echo '<div style="width:4px;height:100%;background-color:black;margin-left:20px;"></div>';
                echo '<p style="font-size:30px;margin-left:20px;margin-top:20px;">'.$row['emailBacSi'].'</p>';
                echo '<div style="width:4px;height:100%;background-color:black;margin-left:20px;"></div>';
                echo '<p style="font-size:30px;margin-left:20px;margin-top:20px;">'.$row['khoa'].'</p>';
                echo '<div style="width:4px;height:100%;background-color:black;margin-left:20px;"></div>';
                echo '<p style="font-size:30px;margin-left:20px;margin-top:20px;">'.$row['chinhanh'].'</p>';
                echo '<div style="width:4px;height:100%;background-color:black;margin-left:20px;"></div>';
                echo '<a style="font-size:30px;margin-left:20px;margin-top:20px;" href="inc/delete-dr.inc.php?ddr='.$row['tenBacSi'].'">Delete</a>';
            echo '</div>';
            
            echo '<div class="dr-pro-change" style="">';
            echo '<form style="" action="inc/change-dr.inc.php?ddr='.$row['tenBacSi'].'" method="post">
                    <input type="text" name="namedr" placeholder="Thay đổi tên...">
                    <input type="text" name="emaildr" placeholder="Thay đổi email...">
                    <input type="password" name="passdr" placeholder="Thay đổi pass...">
                    <input type="text" name="khoadr" placeholder="Thay đổi tên khoa...">
                    <input type="text" name="cndr" placeholder="Thay dổi chi nhánh...">
                <button type="submit" name="changedr-submit">Insert</button>
            </form>';
            echo '</div>';
        echo '</div>';
        }
    }