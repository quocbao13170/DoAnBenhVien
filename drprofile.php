<?php
    include_once 'header.php';
?>
<script>
    $(document).ready(function(){
        $(".content .radio_content").hide();

        $(".radio_wrap").click(function(){
            var current_radio = $(this).attr("data-radio");
            $(".content .radio_content").hide();
            $("." + current_radio).show();
        });
    });
</script>
<div class="profile-wrapper">
    
    <div style="width:92%;min-height:860px;margin:auto;padding-top:40px;">
        <div style="display:flex;">
            <div>
                <?php 
                    echo "<img class='pro-load' style='width:200px;border:solid black;' src='uploads/profile-".$_SESSION['userUid'].".jpg' alt='uploads/default-profile-icon-17.jpg' onload='javascript: alert('success')'
                    onerror='javascript: alert('failure')'/>";
                ?>
                <div style="display:flex;margin-top:10px;">
                <p>Đổi Hình Ảnh: </p>
                    <form style="margin-left:20px;" action='upload.php' method='POST' enctype='multipart/form-data'>
                        <input type="file" name="file-img">
                        </br>
                        <button type="submit" name="submit-img">UPLOAD</button>
                    </form>
                </div>
            </div>
    
    <?php 
        if(isset($_SESSION['userId'])){
            echo '<div style="margin-left:-100px;">';
            echo '<h1 id="nameBS" style="font-size:60px">'.$_SESSION['userUid'].'</h1>';
            echo '<h2 style="font-size:35px">'.$_SESSION['userEmail'].'</h2>';
            
            echo '</div>';
            echo '</div>';
            echo '<div style="width:100%;height:3px;background-color:white;margin-top:15px;border-radius:100%;"></div>';



            echo '<div style="display:flex;">';
            echo '<div>';
            echo '<b class="lichtitle">Các lịch đặt hẹn khám bệnh :</b>';
            require 'inc/dbc.inc.php';
            $nameBS = $_SESSION['userUid'];
            $listsql = "SELECT * FROM datlich WHERE tenBacSi = '$nameBS' ORDER BY time ASC";
            $listresult = mysqli_query($conn, $listsql);
            
            echo '<h2 style="text-decoration: underline;margin-left:70px">Ca Sáng (6h -> 11h):</h2>';
            $j='k';
            if(mysqli_num_rows($listresult) > 0){
                    echo '<div class="fulllichhen">';
                while($row = mysqli_fetch_assoc($listresult)){
                    if($row['time'] <= '12:00')
                    {
                        echo '<div class="lichhen">';
                        echo '<p>Tên : '.$row['userTen'].'</p>';
                        echo '<p>Họ : '.$row['userHo'].'</p>';
                        echo '<p>SDT : '.$row['sodt'].'</p>';
                        echo '<p>Thời gian : '.$row['time'].'</p>';
                        echo '<p>Ngày đặt : '.$row['date_created'].'</p>';
                        echo '<a href="inc/delete-lich.inc.php?rn='.$row['date_created'].'">Hoàn thành</a>';
                        echo '</div>';
                        $j='c';
                    }
                }
                echo '</div>';
            }
            if($j=='k' && mysqli_num_rows($listresult) > 0){
                echo '<h2 style="font-size:30px;margin-top:-100px;margin-left:30px">Không có lịch...</h2>';
            }else if($j=='k'){
                echo '<h2 style="font-size:30px;margin-left:30px">Không có lịch...</h2>';
            }
            echo '<div style="width:100%;height:3px;background-color:white;margin-top:15px;margin-left:30px;border-radius:100%;"></div>';
            $listsql2 = "SELECT * FROM datlich WHERE tenBacSi = '$nameBS' ORDER BY time ASC";
            $listresult2 = mysqli_query($conn, $listsql2);
            echo '<h2 style="text-decoration: underline;margin-left:70px">Ca Chiều (13h -> 19h):</h2>';
            $i=0;
            if(mysqli_num_rows($listresult2) > 0){
                    echo '<div class="fulllichhen">';
                
                while($row2 = mysqli_fetch_assoc($listresult2)){
                    if($row2['time'] >= '13:00')
                    {
                        echo '<div class="lichhen">';
                        echo '<p>Tên : '.$row2['userTen'].'</p>';
                        echo '<p>Họ : '.$row2['userHo'].'</p>';
                        echo '<p>SDT : '.$row2['sodt'].'</p>';
                        echo '<p>Thời gian : '.$row2['time'].'</p>';
                        echo '<p>Ngày đặt : '.$row2['date_created'].'</p>';
                        echo '<a href="inc/delete-lich.inc.php?rn='.$row2['date_created'].'">Hoàn thành</a>';
                        echo '</div>';
                        $i=1;
                    }
                }
                echo '</div>';
            }
            if($i== 0 && mysqli_num_rows($listresult2) > 0){
                echo '<h2 style="font-size:30px;margin-top:-100px;margin-left:30px">Không có lịch...</h2>';
            }else if($i== 0 ){
                echo '<h2 style="font-size:30px;margin-left:30px">Không có lịch...</h2>';
            }
            echo '</div>';
            //chat box here
            
    if(isset($_SESSION['userId'])){
                if($_SESSION['userUid'] == 'Moreyra Francisco Carlos'){
                    echo '<div style="width:20%;height:530px;border-left:solid white;margin-left:400px;padding-left:20px;">';
                    require 'inc/dbc.inc.php';
                    $ngnhan = $_SESSION['userUid'];
                    $listsql2 = "SELECT * FROM chatbox WHERE ngnhan = '$ngnhan' group BY nggui";
                    $listresult2 = mysqli_query($conn, $listsql2);
                    echo '<h1 style="margin-left:30px;">Khám bệnh trực tiếp :</h1>';
                    echo '<div style="">';
                    if(mysqli_num_rows($listresult2) > 0){
                        while($row2 = mysqli_fetch_assoc($listresult2)){
                            $ngguitt = $row2['nggui'];
                            echo '
                            <label style="float:left;" class="radio_wrap" data-radio="radio_'.$ngguitt.'">
                            <input type="radio" name="account" class="input"/>
                            <div>
                                <span class="radio_mark">
                                    '.$ngguitt.'
                                </span>
                            </div>
                            </label>';
                        }
                    }
                    echo '</div>';
                }
            }
    if(isset($_SESSION['userId'])){
        if($_SESSION['userUid'] == 'Moreyra Francisco Carlos'){
            require 'inc/dbc.inc.php';
            $ngnhan = $_SESSION['userUid'];
            $listsql2 = "SELECT * FROM chatbox WHERE ngnhan = '$ngnhan' group BY nggui";
            $listresult2 = mysqli_query($conn, $listsql2);
            echo '<div class="content">';
            if(mysqli_num_rows($listresult2) > 0){
                while($row2 = mysqli_fetch_assoc($listresult2)){
                    $ngguitt = $row2['nggui'];
                    echo '  
                            <div class="radio_content radio_'.$ngguitt.'" style="width:300px;min-height:300px;background-color:white;float:left;margin-top:5px;margin-left:10px;border:solid black;">
                            <div style="display:flex;">
                                <h2 style="margin-left:40px;margin-right:30px">'.$ngguitt.'</h2>
                                <a style="text-decoration:none;color:black;" href="inc/chat-delete.inc.php?ngg='.$ngguitt.'">
                                    <div class="delete-button">
                                        <h1>X</h1>
                                    </div>
                                </a>
                            </div>
                            <div style="width:100%;height:2px;background-color:gray;"></div>
                            <div style="width:300px;height:300px;background-color:white;margin:auto;overflow:hidden;overflow-y: scroll;color:black;">';
                                require 'inc/dbc.inc.php';
                                $sql = "SELECT * FROM chatbox where nggui = '$ngguitt' or ngnhan = '$ngguitt'";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                       echo '<div style="width:100%;height:60px">';
                                         //if( $row['nggui'] == $info1 ){
                                            echo '<b>'.$row['nggui'].' :</b>';
                                         //}else{
                                            //echo '<p>'.$row['ngnhan'].'</p>';
                                         //}
                                         echo '<p>'.$row['ndchat'].'</p>
                                         </div>';
                                    }
                                }            
                        echo '</div>';
                        echo '<form style="" action="inc/chat2.inc.php?nggui='.$ngnhan.'&ngnhan='.$row2['nggui'].'" method="post">
                                    <div style="width:100%;height:30px;background-color:gray;">
                                        <input style="width:80%;height:85%;position:relative;" type="text" id="chat-text" name="chat-text" placeholder="Replay..." >
                                        <button style="float:right;height:100%;width:50px;" id="" type="submit" name="chat-submit">-></button>
                                    </div>
                            </form>
                            </div>';
                            
                }
            }
            echo '</div>';
    }
    echo '</div>';
}


            //chat box above
            echo '</div>';

                
        }
        else{
            header("Location: ../index.php");
        }
    ?>
    
    </div>
</div>

<?php
    require "footer.php";
?>

