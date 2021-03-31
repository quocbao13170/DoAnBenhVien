<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name=viewport content= "width=device-width, initial-scale=1">
        <title></title>
        <link href="stylecss.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="node_modules/brain.js/dist/brain-browser.js"></script>
        <script src = "index.js?v=<?php echo time(); ?>"> </script>
        <script src = "button.js?v=<?php echo time(); ?>"> </script>
        <script src= "http://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    </head>
    <body>
        <div class="portfolio">
            <div class="headhead">
                
                <div class="header">
                    <div class="logo"><a href="index.php">HOSPITAL</a></div>
                    <div class="button">
                        <div class="search">
                            <form action="inc/search-inc.php" method="post">
                                <input type="text" name="search" placeholder="Search...">
                                <button class="button1" type="submit" name="search-submit">Search</button>
                            </form>
                        </div>
                        
                        <div class="button-khoa-list" style="width:100px;height:100%;float:left;margin-left:50px;">
                            <div class="khoa-button">
                                <p>Khoa</p>
                            </div>
                            <ul class="list-khoa">
                                <?php 
                                    require 'inc/dbc.inc.php';
                                    $sqlk = "SELECT * FROM bacsi GROUP BY khoa";
                                    $resultk = mysqli_query($conn, $sqlk);
                                    if(mysqli_num_rows($resultk) > 0){
                                        while($rowk = mysqli_fetch_assoc($resultk)){
                                            echo '<a href="dsbs.php?khoa='.$rowk['khoa'].'"><li><p>'.$rowk['khoa'].'</p></li></a>';
                                        }
                                    }
                                ?>
                            </ul>
                            
                        </div>
                        <div class="log">
                            <?php 
                            if(isset($_SESSION['usernameG'])){
                            }else{
                                if(isset($_SESSION['userId'])){
                                    echo '<form class="logout" action="inc/logout.inc.php" method="post"> 
                                    <button type="submit" name="logout-submit">Logout</button>
                                </form>';
                                    echo '<a class="profile-link" href="drprofile.php">'.$_SESSION['userUid'].'</a>' ;                             
                                }
                                else{
                                    echo '<form class="login" action="inc/login.inc.php" method="post">
                                    <input type="text" name="mailuid" placeholder="Username/Email...">
                                    <input type="password" name="pass" placeholder="Password...">
                                    <button type="submit" name="login-submit">Login</button>
                                </form>'; 
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="head-space"></div>
       
    