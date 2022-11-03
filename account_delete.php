<?php
    include 'account_login_check.php';
    if ($_SESSION['level']==1)
    {
        echo "ADMIN không được xóa tài khoản";
        exit();
    }
    $username = $_SESSION['username'];
    $sql = "UPDATE member SET isDeleted='1' WHERE username='$username'";
    if (mysqli_query($con, $sql))
    {
        echo "Xóa tài khoản thành công.";
        echo "</br>Quay về trang <a href='account_login.php'>đăng nhập</a>.";
        if (session_id() == '')
        session_start();
        if (isset($_SESSION['username'])){
            session_destroy();
        }
    }
    else
    {
        echo "Xóa tài khoản thất bại";
        echo "</br>Quay về <a href='page_main.php'>trang chủ</a>.";
    }
?>