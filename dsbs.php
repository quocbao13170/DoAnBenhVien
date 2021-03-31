<?php
    include_once 'header.php';
?>
<?php 
    if(empty($_GET['khoa'])){
        header("Location: ./index.php?error=kokhoa");
        exit();
    }
?>
<div style="width:100vw;min-height:600px;">
    <div style="width:80%;min-height:600px;margin:auto;">
        <?php 
            $khoa = $_GET['khoa'];
            require 'inc/dbc.inc.php';
            echo '<h1 style="text-decoration: underline;">'.$khoa.'</h1>';
            $datasql = "SELECT * FROM bacsi WHERE khoa = '$khoa'";
            $dataresult = mysqli_query($conn, $datasql);
            if(mysqli_num_rows($dataresult) > 0){
                while($row = mysqli_fetch_assoc($dataresult)){
                    echo '<div style="display:flex;margin-top:20px">';
                        echo "<img class='pro-load' style='width:130px;height:150px;' src='uploads/profile-".$row['tenBacSi'].".jpg'/>";
                        echo '<div style="margin-left:20px;font-size:18px;">';
                        echo '<a class="drlink" href="drprofile-guess.php?dr='.$row['tenBacSi'].'">'.$row['tenBacSi'].'</a>';
                        echo '<p>'.$row['emailBacSi'].'</p>';
                        echo '<p>'.$row['khoa'].'</p>';
                        echo '<b>'.$row['chinhanh'].'</b>';
                        $tenbs = $row['tenBacSi'];
                        $linethrough1 = 'none';
                        $linethrough2 = 'none';
                        $linethrough3 = 'none';
                        $linethrough4 = 'none';
                        $linethrough5 = 'none';
                        $linethrough6 = 'none';
                        $black1 = 'black';
                        $black2 = 'black';
                        $black3 = 'black';
                        $black4 = 'black';
                        $black5 = 'black';
                        $black6 = 'black';
                        
                        ///////////////////////
                        $linethrough7 = 'none';
                        $linethrough8 = 'none';
                        $linethrough9 = 'none';
                        $linethrough10 = 'none';
                        $linethrough11 = 'none';
                        $linethrough12 = 'none';
                        $linethrough13 = 'none';
                        $black7 = 'black';
                        $black8 = 'black';
                        $black9 = 'black';
                        $black10 = 'black';
                        $black11 = 'black';
                        $black12 = 'black';
                        $black13 = 'black';

                        $sqldl = "SELECT * FROM datlich WHERE tenBacSi = '$tenbs'";
                        $resultdl = mysqli_query($conn, $sqldl);
                        if(mysqli_num_rows($resultdl) > 0){
                            while($rowdl = mysqli_fetch_assoc($resultdl)){
                                if($rowdl['time'] == '06:00:00'){
                                    $linethrough1 = 'line-through';
                                    $black1 = 'red';
                                }
                                if($rowdl['time'] == '07:00:00'){
                                    $linethrough2 = 'line-through';
                                    $black2 = 'red';
                                }
                                if($rowdl['time'] == '08:00:00'){
                                    $linethrough3 = 'line-through';
                                    $black3 = 'red';
                                }
                                if($rowdl['time'] == '09:00:00'){
                                    $linethrough4 = 'line-through';
                                    $black4 = 'red';
                                }
                                if($rowdl['time'] == '10:00:00'){
                                    $linethrough5 = 'line-through';
                                    $black5 = 'red';
                                }
                                if($rowdl['time'] == '11:00:00'){
                                    $linethrough6 = 'line-through';
                                    $black6 = 'red';
                                }
                                /////////////////////////////////////
                                if($rowdl['time'] == '13:00:00'){
                                    $linethrough7 = 'line-through';
                                    $black7 = 'red';
                                }
                                if($rowdl['time'] == '14:00:00'){
                                    $linethrough8 = 'line-through';
                                    $black8 = 'red';
                                }
                                if($rowdl['time'] == '15:00:00'){
                                    $linethrough9 = 'line-through';
                                    $black9 = 'red';
                                }
                                if($rowdl['time'] == '16:00:00'){
                                    $linethrough10 = 'line-through';
                                    $black10 = 'red';
                                }
                                if($rowdl['time'] == '17:00:00'){
                                    $linethrough11 = 'line-through';
                                    $black11 = 'red';
                                }
                                if($rowdl['time'] == '18:00:00'){
                                    $linethrough12 = 'line-through';
                                    $black12 = 'red';
                                }
                                if($rowdl['time'] == '19:00:00'){
                                    $linethrough13 = 'line-through';
                                    $black13 = 'red';
                                }
                            }
                        }
                        /////////////////////////////////////////////////////////////////
                            echo '<div style="display:flex;margin-top:20px;font-size:20px;">';
                                echo '<p style="margin-right:30px;">Thời gian đặt lịch khám :</p>';
                                echo 'S :';
                                echo '<p style="text-decoration:'.$linethrough1.';color:'.$black1.';">6:00</p>';
                                echo '<p style="margin-left:10px;text-decoration:'.$linethrough2.';color:'.$black2.';">7:00</p>';
                                echo '<p style="margin-left:10px;text-decoration:'.$linethrough3.';color:'.$black3.';">8:00</p>';
                                echo '<p style="margin-left:10px;text-decoration:'.$linethrough4.';color:'.$black4.';">9:00</p>';
                                echo '<p style="margin-left:10px;text-decoration:'.$linethrough5.';color:'.$black5.';">10:00</p>';
                                echo '<p style="margin-left:10px;text-decoration:'.$linethrough6.';color:'.$black6.';">11:00</p>';
                                echo '<div style="width:3px;height:25px;background-color:gray;margin-left:15px;margin-right:10px;"></div>';
                                echo 'C :';
                                echo '<p style="text-decoration:'.$linethrough7.';color:'.$black7.';">13:00</p>';
                                echo '<p style="margin-left:10px;text-decoration:'.$linethrough8.';color:'.$black8.';">14:00</p>';
                                echo '<p style="margin-left:10px;text-decoration:'.$linethrough9.';color:'.$black9.';">15:00</p>';
                                echo '<p style="margin-left:10px;text-decoration:'.$linethrough10.';color:'.$black10.';">16:00</p>';
                                echo '<p style="margin-left:10px;text-decoration:'.$linethrough11.';color:'.$black11.';">17:00</p>';
                                echo '<p style="margin-left:10px;text-decoration:'.$linethrough12.';color:'.$black12.';">18:00</p>';
                                echo '<p style="margin-left:10px;text-decoration:'.$linethrough13.';color:'.$black13.';">19:00</p>';
                            echo '</div>';
                        //////////////////////////////////////////////////////////////////
                        echo '</div>';
                    echo '</div>';
                    echo '<hr>';
                }
            }
        ?>
    </div>
</div>
<?php
    require "footer.php";
?>

