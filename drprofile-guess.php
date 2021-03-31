<?php
    include_once 'header.php';
?>
<div style="width:100vw;min-height:900px;position: reletive;background-color:royalblue;">
<?php
    $nameBS = $_GET['dr'];
    $listsql = "SELECT * FROM bacsi WHERE tenBacSi = '$nameBS'";
    $listresult = mysqli_query($conn, $listsql);
    if(mysqli_num_rows($listresult) > 0 && mysqli_num_rows($listresult) < 2){
        while($row = mysqli_fetch_assoc($listresult)){
            echo "<div style='display:flex;margin-left:50px;padding-top:50px;'>";
                echo "<img class='pro-load' style='width:200px;border:solid black;' src='uploads/profile-".$row['tenBacSi'].".jpg' alt='uploads/default-profile-icon-17.jpg' onload='javascript: alert('success')' onerror='javascript: alert('failure')'/>";
                    echo "<div style='font-size:30px;margin-left:50px;'>";
                        echo "<p style='font-size:50px;'>Tên Bác Sĩ : ".$row['tenBacSi']."</p>";
                        echo "<p>Phụ trách ở : ".$row['khoa']."</p>";
                        echo "<p>Làm việc ở : ".$row['chinhanh']."</p>";
                        
                        $tbs = $row['tenBacSi'];
                        $datasql2 = "SELECT * FROM chuyennghiep WHERE tenBacSi = '$tbs'";
                    $dataresult2 = mysqli_query($conn, $datasql2);
                    if(mysqli_num_rows($dataresult2) > 0){
                        echo "<p>Chuyên về : ";
                        while($row2 = mysqli_fetch_assoc($dataresult2)){
                            echo '<b>,</b>';
                            echo '<b>'.$row2['trieuchung'].'</b>';
                             
                        }
                    }
                    echo "</div>";
            echo "</div>";
        }
    
    $count = '6';
    $baka = '00';

    echo '<h1 style="margin-left:20px;">Thông tin lịch hẹn ca sáng (6h -> 11h):</h1>';
    echo '<div style="display:flex;margin-top:10px;">';
    while($count <= '11'){
        $timee = $count.':'.$baka;
        $done = $timee.':'.$baka;
        $listsql2 = "SELECT * FROM datlich WHERE tenBacSi = '$nameBS' AND time = '$done'";
        $listresult2 = mysqli_query($conn, $listsql2);
        if(mysqli_num_rows($listresult2) > 0){
            while($row2 = mysqli_fetch_assoc($listresult2)){
                echo '<div class="guess-lich" >';
                echo '<p>Thời gian : '.$timee.'</p>';
                echo '<p>Thời gian này đã được đặt</p>';
                echo '<p>Ngày đặt : '.$row2['date_created'].'</p>';
                echo '</div>';
            }
        }else{
            echo '<div class="guess-lich" >';
            echo '<p>Thời gian : '.$timee.'</p>';
            echo '<p>Thời gian này chưa được đặt</p>';
            echo '<div onclick="openform(\''.$timee.'\')">Đạt lịch hẹn</div>';
            echo '</div>';
        }
        $count = $count +1;
    }
    echo '</div>';

    $count2 = '13';
    $baka2 = '00';
    
    echo '<h1 style="margin-left:20px;">Thông tin lịch hẹn ca chiều (13h -> 19h):</h1>';
    echo '<div style="display:flex;margin-top:10px;">';
    while($count2 <= '19'){
        $timee2 = $count2.':'.$baka2;
        $done2 = $timee2.':'.$baka2;
        $listsql22 = "SELECT * FROM datlich WHERE tenBacSi = '$nameBS' AND time = '$done2'";
        $listresult22 = mysqli_query($conn, $listsql22);
        if(mysqli_num_rows($listresult22) > 0){
            while($row22 = mysqli_fetch_assoc($listresult22)){
                echo '<div class="guess-lich">';
                echo '<p>Thời gian : '.$timee2.'</p>';
                echo '<p>Thời gian này đã được đặt</p>';
                echo '<p>Ngày đặt : '.$row22['date_created'].'</p>';
                echo '</div>';
            }
        }else{
            echo '<div class="guess-lich">';
            echo '<p>Thời gian : '.$timee2.'</p>';
            echo '<p>Thời gian này chưa được đặt</p>';
            echo '<script>var myVar = '.$timee2.';</script>';
            echo '<div onclick="openform(\''.$timee2.'\')">Đạt lịch hẹn</div>';
            echo '</div>';
        }
        $count2 = $count2 +1;
    }
    echo '</div>';

    
    }
    else{
        header("Location: ./index.php");
    }
?>
</div>
<div class="form-popup ">
    <div style="margin-top:150px;color:white;">
        <div class="order-form">
            <form action="inc/datlich2.inc.php" method="post">
                <label for="fname">Tên :</label>
                <input type="text" id="fname" name="firstname" placeholder="Tên..">

                <label for="lname">Họ :</label>
                <input type="text" id="lname" name="lastname" placeholder="Họ..">
                
                <label for="num">Số điện thoại :</label>
                <input type="text" id="num" name="phonenumber" placeholder="Số điện thoại..">

                <?php 

                $nameBS = $_GET['dr'];
                $listsql = "SELECT * FROM bacsi WHERE tenBacSi = '$nameBS'";
                $listresult = mysqli_query($conn, $listsql);
                while($row = mysqli_fetch_assoc($listresult)){
                    echo'
                        <label for="tag0">Chi nhánh :</label>
                        <input type="text" id="tag0cn" name="tag0" placeholder="Chi nhánh..." value="'.$row['chinhanh'].'" disabled>

                        <label for="tag1">Khoa :</label>
                        <input type="text" id="tag1k" name="tag1" placeholder="Khoa..." value="'.$row['khoa'].'" disabled>
                        
                        <label for="tag2">Bác sĩ :</label>
                        <input type="text" id="tag2bs" name="tag2" placeholder="Bác sĩ..." value="'.$row['tenBacSi'].'" disabled>';
                }
                ?>
                <label for="tag3">Chọn thời gian :</label>
                <input type="text" id="tag3tg" name="tag3" placeholder="TG..."  disabled>

                <button id="button-form-disable" onclick="formenable()" type="submit" name="datlich-submit2">Dat Lich</button>
            </form>
        </div>
        <h1 id="exit-form" style="color:white;font-family: Verdana, Geneva, Tahoma, sans-serif;cursor:pointer;margin-top:-550px;margin-left:1300px;" onclick="exitform()">X</h1>
        
    </div>
    
</div>
<h1 style="margin-left:200px;">Những bình luận :</h1>
<div style="width:81vw;height:500px;margin:auto;border:solid black;overflow:hidden;overflow-y:scroll;">
    <?php 
        require 'inc/dbc.inc.php';
        $namedr = $_GET['dr'];
        $listsql3 = "SELECT * FROM binhluan WHERE tenBacSi = '$namedr'";
        $listresult3 = mysqli_query($conn, $listsql3);
        while($row3 = mysqli_fetch_assoc($listresult3)){
            echo '<div style="font-size:30px;">';
            echo 'Tên : '.$row3['tenbl'].'.';
            echo '<label style="margin-left:30px;" for="rating">(</label>';
            echo '<u  name="rating">'.$row3['danhgia'].'</u>';
            echo '<label class="rate-star" for="rating">)</label>';
            echo '</br>';
            echo 'Bình luận : '.$row3['binhluan'].'';
            echo '</br>';   
            echo '</div>';
            echo '<hr>';
        }
    ?>
</div>
<div class="form-style-9" style="width:80vw;min-height:100px;background-color:gray;padding-left:25px;padding-top:30px;padding-bottom:30px;margin:auto;">
<?php echo '<form action="inc/comment.inc.php?tbs='.$_GET['dr'].'" method="post">'; ?>
    <h2>Đánh giá :</h2>
    <div class="rating">
        <input type="radio" name="star" id="star1" value="5"><label class="left-star" for="star1"></label>
        <input type="radio" name="star" id="star2" value="4.5"><label class="right-star" for="star2"></label>
        <input type="radio" name="star" id="star3" value="4"><label style="margin-right:-30px;" class="left-star" for="star3"></label>
        <input type="radio" name="star" id="star4" value="3.5"><label class="right-star" for="star4"></label>
        <input type="radio" name="star" id="star5" value="3"><label  style="margin-right:-30px;" class="left-star" for="star5"></label>
        <input type="radio" name="star" id="star6" value="2.5"><label class="right-star" for="star6"></label>
        <input type="radio" name="star" id="star7" value="2"><label style="margin-right:-30px;" class="left-star" for="star7"></label>
        <input type="radio" name="star" id="star8" value="2.5"><label class="right-star" for="star8"></label>
        <input type="radio" name="star" id="star9" value="1"><label style="margin-right:-30px;" class="left-star" for="star9"></label>
        <input type="radio" name="star" id="star10" value="0.5"><label class="right-star" for="star10"></label>
    </div>
            </br>
            </br>
    <h2>Name :</h2>
    <input type="text" id="comment-name" name="comment-name" placeholder="Tên..." ></br>
    <h2>Comment :</h2>
    <textarea rows="8" cols="90" name="comment" placeholder="Bình luận..."></textarea>
    </br>
    <button id="" type="submit" name="comment-submit">Comment</button>
</form>
</div>


<?php
    require "footer.php";
?>