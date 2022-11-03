<?php
    include 'account_login_check.php';
    include 'account_admin_check.php';
    $sql = "SELECT username FROM member WHERE username!='admin'";
    $query = mysqli_query($con, $sql);
    if (mysqli_num_rows($query)>0)
        echo "Danh sách gồm ".mysqli_num_rows($query)." người dùng:</br>";
    else
    {
        echo "Không có bài đăng nào";
        echo "Quay lại <a href='page_main.php'>trang chủ</a>";
        exit;
    }
    while($list = mysqli_fetch_array($query))
    {
        echo "<a href='profile.php?username=".$list['username']."'>".$list['username']."</a></br>";
    }
    echo "Quay lại <a href='page_main.php'>trang chủ</a>";
?>