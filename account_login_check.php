<?php
    include "connect.php";
    //echo session_id();
    if (session_id()=='')
        session_start();
    if (!isset($_SESSION['username']))
    {
        echo 'Bạn chưa đăng nhập</br>';
        echo 'Click vào đây để <a href="account_login.php">Đăng nhập</a><br/>';
        exit;
    }
    else if ($_SESSION['isDeleted']==1)
    {
        echo 'Bạn chưa đăng nhập</br>';
        echo 'Click vào đây để <a href="account_login.php">Đăng nhập</a><br/>';
        exit;    
    }
?>
