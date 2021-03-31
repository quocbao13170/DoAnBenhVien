<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="stylecss.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="admin-body">
<div style="margin-top:50px;margin-left:50px">
<?php 
    if(isset($_SESSION['AdId'])){
        echo '<form  action="inc/logout-admin.inc.php" method="post"> 
                    <button class="admin-logout" style="width:150px;height:30px;font-size:20px;" type="submit" name="logout-admin-submit">Logout</button>
              </form>';
        echo '<div style="float:right;display:flex;">';
        echo '<div style="margin-right:50px;">';
        echo '
        <div class="ad-dk">
            <h1>Đăng Ký Tải Khoản Bác Sĩ</h1>
                    <form  style="" action="inc/drsignup.inc.php" method="post">
                    <div class="input-fields">
                    <input type="text" name="namedr" placeholder="Tên bác sĩ mới...">
                    <input type="text" name="emaildr" placeholder="Email bác sĩ mới...">
                    <input type="password" name="passdr" placeholder="Password...">
                    <input type="text" name="khoadr" placeholder="Khoa...">
                    <input type="text" name="cndr" placeholder="Chi nhánh...">
                    
                    <button type="submit" name="signupdr-submit">Dang Ky</button>
                    </div>
                </form>
        </div>';
        echo '<div class="ad-x">';
        echo '<h1>Xóa Tài Khoản Bác Sĩ</h1>';
        require 'inc/dbc.inc.php';
        echo '<select style="margin-top:10px;margin-bottom:10px;" id="select-dr" onChange="change_name()"> ';
                echo '<option value="">Chọn Tên</option>';
                    $sql = "SELECT * FROM bacsi";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo '<option value="'.$row['tenBacSi'].'">'.$row['tenBacSi'].'</option>';
                        }
                    }
            echo '</select>';
            
        echo '</div>';
        echo '</div>';
        echo '<div class="ad-dt">';
        echo '<h1 style="">Đăng tải thông tin</h1>
        <form style="" action="inc/post-admin.inc.php" method="post" enctype="multipart/form-data">
            <div style="width:300px;display: inline-flex;
            flex-direction: column;">
                <input type="text" name="cd" placeholder="Chu de">
                <input type="text" name="nd" placeholder="Noi dung">
                <input class="input-file-post" type="file" name="file-img">
                <button type="submit" name="post-submit">POST</button>
            </div>
        </form>';
        echo'</div>';
        echo'</div>';
        echo '<div style="float:right;background-color:white;" id="result-dr"></div>';
    }
        
    else{
        echo '<div class="ad-login">';
        echo '<h1>Administrator</h1>';
        echo '<form style="" action="inc/login-admin.inc.php" method="post">
                <input type="text" name="adid" placeholder="Admin...">
                <input type="password" name="adpass" placeholder="Password...">
                <button type="submit" name="login-admin-submit">Login</button>
              </form>';
              echo'</div>';
    }
?>

<script>
    function change_name(){
                var xmlhttp= new XMLHttpRequest();
                xmlhttp.open("GET","inc/admin-loadprofile.inc.php?name="+document.getElementById("select-dr").value,false);
                xmlhttp.send(null);
                document.getElementById("result-dr").innerHTML = xmlhttp.responseText;
                //alert(xmlhttp.responseText);
            }
</script>
</div>
</body>
</html>