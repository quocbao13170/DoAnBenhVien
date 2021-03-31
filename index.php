<?php
    include_once 'header.php';
?>
<div class="v-nav">
    <div style="display:flex;border-bottom:solid 1px gray;">
    <div onclick="openmenu()" class="menu-icon open-menu" ><img src="icons/menu.png"></div>
    <div onclick="closemenu()" class="menu-icon close-menu" ><img src="icons/menu.png"></div>
    <div style="display:none;margin-left:33px;" class="logo logo2"><a style="text-decoration:none;" href="index.php">HOSPITAL</a></div>
    </div>
    <ul style="margin-top:0px;">
        <li class="icon-li move-top">
            <a class="house" href="#s1"></a>
            <div class="icon-name icon-name1">Trang chủ</div class="icon-name">
        </li>
        <li class="icon-li move-top">   
            <a class="lbulb" href="#s2"></a>
            <div class="icon-name icon-name2">Chuẩn Đoán</div class="icon-name">
        
        </li>
        <li  class="icon-li">
            <a class="scroll" href="#s3"></a>
            <div class="icon-name icon-name3">Đặt Lịch</div class="icon-name">
            
        </li>
    </ul>
    <div class="cross-bar"></div>
    <div style="display:none;" class="bakabakaka">
        <div style="width:100%;height:150px;">
            <?php 
            if(isset($_SESSION['usernameG'])){}
            else{
                echo '<div class="login-open-button" style="background-color:rgb(198, 190, 214);cursor:pointer;width:80%;height:40px;margin:auto;margin-top:20px;" onclick="loginform()">
                    <p style="font-size:30px;margin-left:60px;">Login</p>
                </div>';
            }
            ?>
            <?php if(isset($_SESSION['usernameG'])){
                echo '<form class="login-guess" action="inc/logout.inc.php" method="post"> 
                            <button style="width:100%;height:35px;margin-top:20px;font-size:25px;" type="submit" name="logout-submit">Logout</button>
                        </form>';
                }else {
                    echo '<form style="display:none;" class="login-guess" action="inc/guess-login.inc.php" method="post">
                    <div>
                        <input style="width:97.5%;height:35px;" type="text" name="usernameG" placeholder="Username...">
                        <input style="width:97.5%;height:35px;" type="password" name="passwordG" placeholder="Password...">
                    </div>
                    <button style="width:100%;height:25px;" type="submit" name="guess-login-submit">Login</button>
                </form>';
                }
            ?>
            <?php if(isset($_SESSION['usernameG'])){
                
                    require 'inc/dbc.inc.php';
                    $unbn = $_SESSION['usernameG'];
                    $sqluser = "SELECT * FROM benhnhan where usernameG = '$unbn'";
                    $resultuser = mysqli_query($conn, $sqluser);
                    if(mysqli_num_rows($resultuser) > 0){
                        while($rowuser = mysqli_fetch_assoc($resultuser)){
                            echo '<div style="margin-top:20px;">';
                            echo '<h2 style="font-size:20px;">Ho va Ten :</h2>';
                            echo '<p>'.$rowuser['tenBN'].'</p>';
                            echo '<h2 style="font-size:20px;">Email :</h2>';
                            echo '<p>'.$rowuser['email'].'</p>';
                            echo '<h2 style="font-size:20px;">So dien thoai :</h2>';
                            echo '<p>'.$rowuser['sodt'].'</p>';
                            echo '<h2 style="font-size:20px;">CMND :</h2>';
                            echo '<p>'.$rowuser['soCMND'].'</p>';
                            echo '<h2 style="font-size:20px;">Dia chi :</h2>';
                            echo '<p>'.$rowuser['diachi'].'</p>';
                            echo '</div>';
                        }
                    }
                }else{
                    echo '<a class="login-open-button" style="text-decoration: none;" href="signup.php">
                        <div style="background-color:rgb(198, 190, 214);cursor:pointer;width:80%;height:40px;margin:auto;margin-top:20px;" >
                            <p class="login-open-button" style="font-size:30px;margin-left:50px;color:black;">Signup</p>
                        </div>
                    </a>';
                }
            ?>
        </div>
    </div>
</div>

<div class="wrapper">
    <div style="background-color:black;" class="tintuc" id="s1">
        <div class="new"><h1>Tin tức mới :</h1></div>
        <div class="section1">
            <?php 
            require 'inc/dbc.inc.php';
            echo '<div style="display:flex;position:relative;width:100%;height:100%;margin-top:20px;"> ';
                    
                    $sql = "SELECT * FROM dangtai ORDER BY tgdang desc";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                                echo '<div class="posts post-'.$row['idLich'].'">
                                        <div class="layer-2">dsadsa</div>
                                        <img src="images/post-img/post-'.$row['idLich'].'.png" alt="">
                                        <div class="posts-content post-c-'.$row['idLich'].'">
                                            <h2>'.$row['chude'].'</h2>
                                            <div style="width:100%;height:1px;background-color:gray;"></div>
                                            <p>'.$row['noidung'].'</p>
                                        </div>
                                    </div>';
                        }
                    }
                   
                echo    '</div>';
            ?>
        </div>
        <!--<div class="new"><h1>ThanhTuu</h1></div>
        <div class="section2">
            
        </div>-->
        <div class="new"><h1>Nổi tiến :</h1></div>
        <div class="section3">
            <?php 
                require 'inc/dbc.inc.php';
                $persondatasql4 = "SELECT tenBacSi,AVG(danhgia) as avgscore,COUNT(binhluan) as countscore FROM binhluan group by tenBacSi";
                $persondataresult4 = mysqli_query($conn, $persondatasql4);
                echo '<div style="display:flex;margin-top:20px;">';
                while($row4 = mysqli_fetch_assoc($persondataresult4)){
                    $round = round($row4['avgscore'], 2);
                    echo '<div style="margin-left:30px;">';
                    echo '<img class="pro-load" style="width:150px;box-shadow: -0px 0px 20px rgb(0, 0, 0);" src="uploads/profile-'.$row4['tenBacSi'].'.jpg" alt="">';
                    echo '<div class="image-rank" style="text-align: center;width:150px;height:162px;position:absolute;background-color:black;margin-top:-162px;">
                        <p style="font-size:23px">Lượi bình luận :</p>
                        <b style="font-size:90px">'.$row4['countscore'].'</b>
                    </div>';
                    echo '<b>';
                    echo '</br>';
                    echo 'Tên : '.$row4['tenBacSi'].'.';
                    echo '</br>';
                    echo 'Đánh giá : '.$round.'/5.';
                    echo '</br>';
                    echo '<a style="color:white;" href="drprofile-guess.php?dr='.$row4['tenBacSi'].'">Xem trang cá nhân</a>';
                    echo '</b>';
                    echo '</div>';
                }
                echo '</div>';
            ?>
        </div>
    </div>
    <div style="width:90%;height:3px;background-color:gray;margin:auto;border-radius:100%;"></div>
    <div class="chuandoan" id="s2">
        <div class="section-title">
            <p style="font-size:30px" class="question">Bạn không biết mình đang gặp chứng bệnh gì ?</p>
            <h1 style="font-size:60px" class="question2">Hãy chuẩn đoán bệnh ngay bây giờ...</h1>
        </div>
        <div class="checking-form">
            <div style="box-shadow: -10px 5px 50px rgb(0, 0, 0);border: 0.5px solid gray;width:80%;min-height:420px;background-color: rgb(10, 10, 27);margin:auto;border-radius:3rem;display:flex;overflow:hidden;position:relative;">
                <div class="prediction">
                    <div style="display:flex;width:100%;height:50px;">
                        <p style="font-size:30px;text-decoration:underline;margin-left:50px;margin-top:30px;" class="question">Hãy chọn những triệu chứng sau :</p>
                        <div style="margin-left:200px;margin-top:30px;width:400px;height:100%;">
                            <div style="display:flex;">
                                <div class="icon-orange"></div>
                                <b style="font-size:18px;margin-left:10px;">: Những triệu chứng bạn nên kiểm tra lại</b>
                            </div>
                        </div>
                    </div>
                    <div style="display:flex;">
                    <div style="margin-bottom:20px;" class="box">
                        <div class="box1">
                            <input type="checkbox" id="1"  value="sot" onclick="survey();changeprofilewindow(1.5);" >
                            <label id="1.5" for="1">Sốt từ 37,5 độ C</label>
                            <p id="1.6" style="display:none;">PB</p><p id="1.7" style="display:none;">PB</p><p id="1.8" style="display:none;">NO</p>
                            <br>
                            <input type="checkbox" id="2"  value="ho" onclick="survey();changeprofilewindow(2.5);">
                            <label id="2.5" value1="PB" value2="PB" value3="TT" for="2">Ho</label>
                            <p id="2.6" style="display:none;">PB</p><p id="2.7" style="display:none;">PB</p><p id="2.8" style="display:none;">TT</p>
                            <br>
                            <input type="checkbox" id="3"  value="chaymui" onclick="survey();changeprofilewindow(3.5);">
                            <label id="3.5"            value2="TT" value3="PB" for="3">Chảy nước mũi</label>
                            <p id="3.6" style="display:none;">NO</p><p id="3.7" style="display:none;">TT</p><p id="3.8" style="display:none;">PB</p>
                            <br>
                            <input type="checkbox" id="4"  value="tacmui" onclick="survey();changeprofilewindow(4.5);">
                            <label id="4.5"                        value3="PB" for="4">Tắc mũi</label>
                            <p id="4.6" style="display:none;">NO</p><p id="4.7" style="display:none;">NO</p><p id="4.8" style="display:none;">PB</p>
                            <br>
                            <input type="checkbox" id="5"  value="hathoi" onclick="survey();changeprofilewindow(5.5);">
                            <label id="5.5"            value2="TT" value3="PB" for="5">Hắt hơi</label>
                            <p id="5.6" style="display:none;">NO</p><p id="5.7" style="display:none;">TT</p><p id="5.8" style="display:none;">PB</p>
                            <br>
                        </div>
                        <div class="box2">
                            <input type="checkbox" id="6"  value="dauhong" onclick="survey();changeprofilewindow(6.5);">
                            <label                                 value3="PB" id="6.5" for="6">Đau họng</label>
                            <p id="6.6" style="display:none;">NO</p><p id="6.7" style="display:none;">NO</p><p id="6.8" style="display:none;">PB</p>
                            <br>
                            <input type="checkbox" id="7"  value="rathong" onclick="survey();changeprofilewindow(7.5);">
                            <label value1="TT"                      value3="PB" id="7.5" for="7">Rát họng</label>
                            <p id="7.6" style="display:none;">TT</p><p id="7.7" style="display:none;">NO</p><p id="7.8" style="display:none;">PB</p>
                            <br>
                            <input type="checkbox" id="8"  value="ho" onclick="survey();changeprofilewindow(8.5);">
                            <label value1="PB" id="8.5" for="8">Thở gấp, khó thở</label>
                            <p id="8.6" style="display:none;">PB</p><p id="8.7" style="display:none;">NO</p><p id="8.8" style="display:none;">NO</p>
                            <br>
                            <input type="checkbox" id="9"  value="chaymui" onclick="survey();changeprofilewindow(9.5);">
                            <label value1="PB" id="9.5" for="9">Có đờm mủ</label>
                            <p id="9.6" style="display:none;">PB</p><p id="9.7" style="display:none;">NO</p><p id="9.8" style="display:none;">NO</p>
                            <br>
                            <input type="checkbox" id="10"  value="tacmui" onclick="survey();changeprofilewindow(10.5);">
                            <label                     value2="PB" id="10.5" for="10">Nôn mửa</label>
                            <p id="10.6" style="display:none;">NO</p><p id="10.7" style="display:none;">PB</p><p id="10.8" style="display:none;">NO</p>
                            <br>
                        </div>
                        <div class="box3">    
                            <input type="checkbox" id="11"  value="hathoi" onclick="survey();changeprofilewindow(11.5);">
                            <label                     value2="PB" id="11.5" for="11">Tiêu chảy</label>
                            <p id="11.6" style="display:none;">NO</p><p id="11.7" style="display:none;">PB</p><p id="11.8" style="display:none;">NO</p>
                            <br>
                            <input type="checkbox" id="12"  value="dauhong" onclick="survey();changeprofilewindow(12.5);">
                            <label value1="PB" id="12.5" for="12">Cơ thể không có sức</label>
                            <p id="12.6" style="display:none;">PB</p><p id="12.7" style="display:none;">NO</p><p id="12.8" style="display:none;">NO</p>
                            <br>
                            <input type="checkbox" id="13"  value="hathoi" onclick="survey();changeprofilewindow(13.5);">
                            <label value1="TT"         value2="PB" id="13.5" for="13">Cơ bắp đau nhức</label>
                            <p id="13.6" style="display:none;">TT</p><p id="13.7" style="display:none;">PB</p><p id="13.8" style="display:none;">NO</p>
                            <br>
                            <input type="checkbox" id="14"  value="dauhong" onclick="survey();changeprofilewindow(14.5);">
                            <label value1="PB" id="14.5" for="14">X-quang phổi mờ</label>
                            <p id="14.6" style="display:none;">PB</p><p id="14.7" style="display:none;">NO</p><p id="14.8" style="display:none;">NO</p>
                            <br>
                        </div>
                    </div>
                    <div style="" class="Submit-predic" onclick="start()">Submit</div>
                    <?php
                    ?>
                    </div>
                    <div class="cross-bar" style="margin-top:0;"></div>
                    <div class="per-bars" style="display:none;margin-left:60px;">
                        <div style="font-size:25px;display:flex;width:320px;" >
                            <b>Covid :</b>
                            <div style="height:20px;width:200px;">
                                <div id="traloi" style="height:100%;width:0%;background-color:red;margin-top:10px;"></div>
                            </div>
                            <b id ="phantram">0%</b>
                        </div>
                        <div style="font-size:25px;display:flex;width:320px;margin-left:30px;">
                            <b>Cúm :</b>
                            <div style="height:20px;width:200px;">
                                <div id="traloi2" style="height:100%;width:0%;background-color:orange;margin-top:10px;"></div>
                            </div>
                            <b id ="phantram2">0%</b>
                        </div>
                        <div style="font-size:25px;display:flex;width:390px;margin-left:30px;">
                            <b>Cảm Lạnh :</b>
                            <div style="height:20px;width:200px;">
                            <div id="traloi3" style="height:100%;width:0%;background-color:yellow;margin-top:10px;"></div>
                            </div>
                            <b id ="phantram3">0%</b> 
                        </div>
                    </div>
                    <p id="error-answers" style="font-size:25px;margin-left:60px;"></p>
                    <div style="font-size:25px;margin-left:60px;z-index:3;color:white;display:flex;">
                    <b id="warning-lich"></b>
                    <a id="info-lich" style="color:white;display:none;" href="#s3"></a>
                    </div>
                    <p style="font-size:30px;margin-left:60px;">Kết quả bạn thấy không hài lòng ? Hãy đặt lịch ở khoa xét nghiệm <a style="margin-left:20px;z-index:3;color:white;" href="#s3">Đặt lịch</a></p>
                </div>
                
                <?php
                //chatbox 
                    if(isset($_SESSION['usernameG'])){
                        echo '<div style="width:100%;height:90%;position:absolute;margin-top:20px;display:flex;" class="prediction2" >
                            
                            <div>
                            <h1 style="margin-left:50px;text-decoration:underline">Tra hoi truoc tiep voi bac si :</h1>
                            <div style="margin-left:100px;margin-top:20px;">
                                <img class="pro-load" style="width:250px;" src="uploads/profile-Moreyra Francisco Carlos.jpg" alt="">
                            </br>
                            Tên : Moreyra Francisco Carlos
                            </br>
                            <a style="color:white;" href="drprofile-guess.php?dr=Moreyra Francisco Carlos">Xem trang cá nhân</a>
                            </div>
                            </div>
                            <div style="width:300px;min-height:300px;background-color:white;margin:auto;">
                            <div style="border:solid 1px black;width:300px;height:300px;background-color:white;margin:auto;overflow:hidden;overflow-y: scroll;color:black;">';
                                require 'inc/dbc.inc.php';
                                $info1 = $_SESSION['usernameG'];
                                $sql = "SELECT * FROM chatbox where nggui='$info1' or ngnhan='$info1'";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                       echo '<div style="width:100%;height:60px;border:solid 1px black;">';
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
                        echo '<form style="" action="inc/chat.inc.php?nggui='.$_SESSION['usernameG'].'&ngnhan=Moreyra Francisco Carlos" method="post">
                                    <div style="width:100%;height:30px;background-color:gray;">
                                        <input style="width:80%;height:30px;position:relative;border-radius:1.5rem;border:none" type="text" id="chat-text" name="chat-text" placeholder="Replay..." >
                                        <button style="float:right;height:100%;width:50px;" id="" type="submit" name="chat-submit">-></button>
                                    </div>
                            </form>
                            </div>
                        </div>';
                }?>
            </div>
        </div>
        <?php 
                    if(isset($_SESSION['usernameG'])){
                        echo '<div class="switch-button1" style="box-shadow: -10px 5px 50px rgb(0, 0, 0);margin-top:-300px;float:right;width:120px;height:120px;background-color:red;border-radius:4rem;background-color:gray;cursor:pointer;" onclick="pre2()">
                            <p style="font-size:75px;margin-left:30px;">></p>
                        </div>';
                    }
                    if(isset($_SESSION['usernameG'])){
                        echo '<div class="switch-button2" style="box-shadow: -10px 5px 50px rgb(0, 0, 0);margin-top:-300px;float:left;width:120px;height:120px;border-radius:4rem;background-color:gray;cursor:pointer;display:none" onclick="pre1()">
                                <p style="font-size:75px;margin-left:30px;"><</p>
                            </div>';
                    }
                    ?>
        <img class="backimg" src="icons/PngItem_52349.png" alt="">
        <div style="margin-top:23px;"></div>
        <div style="width:300px;height:280px;position:relative;margin:auto;border-radius:2rem 2rem 0 0;overflow:hidden;">
            <div class="profile-window" style="width:100%;height:100%;background-color: rgb(4, 4, 17);border-radius:2rem 2rem 0 0">        
                    <img class="close-window" style="width:50px;height:50px;margin-left:41%;cursor:pointer;display:none;" src="icons/iconfinder_arrow-up-01_186407.png" alt="" onclick="closeprofile()">
                    <img class="open-window" style="width:50px;height:50px;margin-left:41%;cursor:pointer;" src="icons/iconfinder_arrow-up-01_186407.png" alt="" onclick="openprofile()">
                    <div id="profile-predict" style="width:100%;height:80%;">
                        
                    </div>
            </div>
        </div>
    </div>
    
    <div style="width:90%;height:3px;background-color:gray;margin:auto;border-radius:100%;"></div>
    <div class="datlich" id="s3">
        <div class="section-title">
            <p style="font-size:60px;">Hãy đặt lịch khám bệnh ngay bây giờ...</p>
        </div>
        <div style="display:flex;">
        <div class="picpic left-pic">
            <img class="left-img" src="images/1202_benh-vien-da-khoa.jpg" alt="">
            <div class="img-desc">
                <ul>
                    <li><img src="icons/location-pin.png"> Võ Nguyên Giáp, Q.Lê Chân, TP Hải Phòng</li>
                    <li>+   Leading doctors and medical experts with high-level expertise, enthusiasm and devotion for the patients</li>
                    <li>+   Comprehensive and professional medical examination, consultation and treatment</li>
                    <li>+   Modern medical equipment which supports diagnosis and efficient treatment</li>
                </ul>
            </div>
        </div>
        <div class="order-form form-style-8">
        <h2>Hãy điền thông tin :</h2>
        <form action="inc/datlich.inc.php" method="post">
            <div>
            <label for="fname">Tên :</label>
            <input type="text" id="fname" name="firstname" placeholder="Tên..">

            <label for="lname">Họ :</label>
            <input type="text" id="lname" name="lastname" placeholder="Họ..">
            
            <label for="num">Số điện thoại :</label>
            <input type="text" id="num" name="phonenumber" placeholder="Số điện thoại..">
            
            </div>
            <label for="tag0">Chi nhánh :</label>
            <select id="select1" class="tags-select" name="tag0"  onChange='change_location()'>
                <?php 
                $cn = $_GET['cn'];
                if(empty($cn)){
                    echo '<option value="">Chọn chi nhánh</option>';
                    require 'inc/dbc.inc.php';
                    $sql = "SELECT * FROM bacsi group by chinhanh";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo '<option id="IDchinhanh" value="'.$row['chinhanh'].'">'.$row['chinhanh'].'</option>';
                        }
                    }
                }else{
                    echo '<option value="'.$cn.'">'.$cn.'</option>';
                }   
                
                ?>
            </select>
            <label for="tag1">Khoa :</label>
            <select id="select2" class="tags-select" name="tag1" onChange =change_profession()>
                <?php 
                    $kh = $_GET['k'];
                    if(empty($kh)){
                        echo '<option value="">Chọn khoa</option>';
                    }else{
                        echo '<option value="'.$kh.'">'.$kh.'</option>';
                    }   
                    
                    ?>
            </select>
            <label for="tag2" >Bác sĩ :</label>
            <select id="select3" class="tags-select" name="tag2" onChange =change_profile()>
                <?php 
                $cn = $_GET['cn'];
                $kh = $_GET['k'];
                if(empty($cn) || empty($kh)){
                    echo '<option value="">Chọn bác sĩ</option>';
                }else{
                    require 'inc/dbc.inc.php';
                    $sql2 = "SELECT * FROM bacsi where chinhanh= '$cn' and khoa = '$kh'";
                    $result2 = mysqli_query($conn, $sql2);
                    if(mysqli_num_rows($result2) > 0){
                        while($row2 = mysqli_fetch_assoc($result2)){
                            echo '<option id="IDchinhanh" value="'.$row2['tenBacSi'].'" selected>'.$row2['tenBacSi'].'</option>';
                        }
                    }
                }
                
                ?>
            </select>
            <div id="profile1"></div>
            <label for="tag3">Chọn thời gian :</label>
            <select id="select4" class="tags-select" name="tag3">
                <option value="" disabled><--Ca Sáng--></option>
                <option value="6:00">6:00</option>
                <option value="7:00">7:00</option>
                <option value="8:00">8:00</option>
                <option value="9:00">9:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="" disabled><--Ca Chiều--></option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
                <option value="19:00">19:00</option>
            </select>
            <?php 
            if(isset($_GET['error'])){
                echo '<p style="font-size:20px;color:red;text-transform: capitalize;">'.$_GET['error'].'</p>';
            }
            ?>
            <button type="submit" name="datlich-submit">ĐẶT LỊCH</button>
            
        </form>
            <!------------------------------->
            <script type = "text/javascript">
            function change_location(){
                var xmlhttp= new XMLHttpRequest();
                xmlhttp.open("GET","inc/load-db-cs.php?location="+document.getElementById("select1").value,false);
                xmlhttp.send(null);
                document.getElementById("select2").innerHTML = xmlhttp.responseText;
                //alert(xmlhttp.responseText);
            }
            function change_profession(){
                var xmlhttp= new XMLHttpRequest();
                xmlhttp.open("GET","inc/load-db-cs2.php?location="+document.getElementById("select1").value+"&profession="+document.getElementById("select2").value,false);
                xmlhttp.send(null);
                document.getElementById("select3").innerHTML = xmlhttp.responseText;
                //alert(xmlhttp.responseText);
            }
            function change_profile(){
                var xmlhttp= new XMLHttpRequest();
                xmlhttp.open("GET","inc/load-db-cs3.php?profile="+document.getElementById("select3").value,false);
                xmlhttp.send(null);
                document.getElementById("profile1").innerHTML = xmlhttp.responseText;
                //alert(xmlhttp.responseText);
            }
            function changeprofilewindow(x){
                var xmlhttp= new XMLHttpRequest();
                j = x;
                xmlhttp.open("GET","inc/load-profile-window.php?profile="+document.getElementById(j).innerHTML,false);
                xmlhttp.send(null);
                document.getElementById("profile-predict").innerHTML = xmlhttp.responseText;
                //alert(xmlhttp.responseText);
            }
            </script>
        </div>
        <div class="picpic right-pic">
            <img class="right-img" src="images/benh-vien-vinmec.png" alt="">
            <div class="img-desc2">
                <ul>
                    <li><img src="icons/location-pin.png"> Đường 30 Tháng 4, Khu dân cư số 4 Nguyễn Tri Phương, phường Hòa Cường Bắc, Q Hải Châu, TP Đà Nẵng Đà Nẵng</li>
                    <li>+ Leading doctors and medical experts with high expertise who care for patients devotedly and whole-heartedly.</li>
                    <li>+ Comprehensive and professional medical examination, consultation and treatment.</li>
                    <li>+ Vinmec is a leading health-care system in Vietnam with state-of-the-art facilities and advanced equipment from the world's leading medical equipment suppliers, supporting diagnosis and efficient treatment.</li>
                    <li>+ Modern, premium medical space with maximum sterilization.</li>
                    <li>+ Management, connection of the online database, modern for optimal efficiency.</li>
                    <li>+ Vinmec is the first and only private healthcare system in</li>
                    <li>+ Vietnam with 02 hospitals achieved JCI accreditation–the strictest criteria in patient safety in the world.</li>
                </ul>
            </div>
        </div>
        </div>
    </div>
</div>
<?php
    require "footer.php";
?>