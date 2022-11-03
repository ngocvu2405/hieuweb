<?php
    include 'account_login_check.php';
    if (session_id() == '')
        session_start();
    if (isset($_SESSION['username'])){
        session_destroy();
        //unset($_SESSION['username']); // xóa session login
}
    echo "Đăng xuất thành công</br> <a href='account_login.php'>Về trang đăng nhập</a>"
?>
