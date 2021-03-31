<?php
    include_once 'header.php';
?>
    <div class="wrapper-signup">
        <div class="signup-form form-style-10">
            <h1>Sign Up Now!</h1>
            
            <form action= "inc/signup.inc.php" method="post">
                <?php 
                echo '<label>Họ và Tên đậy đủ: ';
                if(isset($_GET['hoten'])){
                    echo '<input type="text" name="hoten" placeholder="Họ và tên" value="'.$_GET['hoten'].'">';
                }else{
                    echo '<input type="text" name="hoten" placeholder="Họ và tên"> </input>';
                }
                echo '</label>';
                echo '<label>Username: ';
                if(isset($_GET['uid'])){
                    echo '<input type="text" name="uid" placeholder="Username" value="'.$_GET['uid'].'">';
                }else{
                    echo '<input type="text" name="uid" placeholder="Username"> </input>';
                }
                echo '</label>';
                if(isset($_GET['error'])){
                    if($_GET['error'] == "usertaken"){
                        echo '<p class="error-mess">Username has already been taken </p>';
                    }
                    if($_GET['error'] == "invaliduid"){
                        echo '<p class="error-mess">Invalid username </p>';
                    }
                }
                echo '<label>Email: ';
                if(isset($_GET['mail'])){
                    echo '<input type="text" name="mail" placeholder="E-mail" value="'.$_GET['mail'].'">';
                }else{
                    echo '<input type="text" name="mail" placeholder="E-mail">';
                }
                echo '</label>';
                if(isset($_GET['error'])){
                    if($_GET['error'] == "invalidmail"){
                        echo '<p class="error-mess">Invalid email </p>';
                    }
                }
                echo '<label>Password: ';
                echo '<input type="password" name="pwd" placeholder="Password">';
                echo '</label>';
                echo '<label>Nhập lại mật khẩu: ';
                echo '<input type="password" name="pwd-repeat" placeholder="Re-Password">';
                echo '</label>';
                if(isset($_GET['error'])){
                    if($_GET['error'] == "passwordincorrect"){
                        echo '<p class="error-mess">Incorrect password </p>';
                    }
                }
                echo '<label>Số điện thoại: ';
                if(isset($_GET['sdt'])){
                    echo '<input type="text" name="sdt" placeholder="SDT" value="'.$_GET['sdt'].'">';
                }else{
                    echo '<input type="text" name="sdt" placeholder="SDT">';
                }
                echo '</label>';
                echo '<label>Số chứng minh nhân dân: ';
                if(isset($_GET['cmnd'])){
                    echo '<input type="text" name="cmnd" placeholder="CMND" value="'.$_GET['cmnd'].'">';
                }else{
                    echo '<input type="text" name="cmnd" placeholder="CMND">';
                }
                echo '</label>';
                echo '<label>Địa chỉ liên lạc: ';
                if(isset($_GET['dc'])){
                    echo '<input type="text" name="dc" placeholder="Địa chỉ" value="'.$_GET['dc'].'">';
                }else{
                    echo '<input type="text" name="dc" placeholder="Địa chỉ">';
                }
                echo '</label>';
                if(isset($_GET['error'])){
                    if($_GET['error'] == "emptyfields") {
                        echo '<p class="error-mess">Fill in all fields </p>';
                    }
                }
                ?>
                <button type="submit" name="signup-submit">Signup</button>
            </form>
        </div>
    </div>
<?php
    require "footer.php";
?>