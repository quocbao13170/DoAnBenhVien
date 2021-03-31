
<?php
    include_once 'header.php';
?>
<div class="doctor-login-wrapper"></div>
<div class="signup-form">
        <div class="signup-title"><h1>Login</h1></div>
            
        <form action= "inc/drlogin.inc.php" method="post">
            <input type="text" name="emailBacSi" placeholder="Email...">
            <input type="password" name="pwdBacSi" placeholder="Password...">
            <button type="submit" name="doctor-login-submit">Login</button>
        </form>
</div>

<?php 
if(isset($_SESSION['idBS'])){
    echo '<form class="logout" action="inc/logout.inc.php" method="post"> 
                                    <button type="submit" name="logout-submit">Logout</button>
                                </form>';
    echo '<p> you are loged in</p>';
}
else{
    echo '<p> you are not </p>';
}
?>
        