<?php
    include "connect.php";
    if (session_id()=='')
        session_start();
    if ($_SESSION['level']!=1)
    {
        echo 'Bạn không có quyền truy cập vào mục này.</br>';
        echo 'Click vào đây để <a href="page_main.php">quay lại</a><br/>';
        exit;
    }
?>
