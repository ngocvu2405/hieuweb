<?php 
    session_start(); 
    include 'account_login_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <?php
            if (isset($_SESSION['username']) && $_SESSION['username']){
                $username = $_SESSION['username'];
                $my_query = mysqli_fetch_assoc(mysqli_query($con,"SELECT fullname FROM member WHERE username='$username'"));
                $fullname = $my_query['fullname'];
                echo "Bạn đã đăng nhập với tên là ".$fullname."<br/>";
                echo 'Click vào đây để <a href="account_logout.php">Đăng xuất</a><br/>';
            }
        ?>
        <?php
            if ($_SESSION['level'])
            {echo "<h2>Quản lí trang web (Dành riêng cho admin)</h2>";
            echo "<a href='admin_all_user.php'>Quản lí người dùng</a></br>";
            echo "<a href='admin_all_post.php'>Quản lí bài đăng</a>";}
        ?>
        <h2>Tìm kiếm </h2>
        <form action ="search.php" method = "get">
            <label for="search"> Nhập nội dung muốn tìm kiếm: </label>
            <input type ="text" name="search_content" id = "search_content" size="50"></input>
            <p>
            <input type="checkbox" id="username_search" name="username_search">
            <label for="username_search">Tìm kiếm người dùng.</label><br>
            <input type="checkbox" id="post_search" name="post_search">
            <label for="post_search">Tìm kiếm nội dung bài viết.</label><br>
            </p>
            <input type="submit" value="Tìm kiếm"></input>
        </form>
        <h2>Quản lí bài viết </h2>
        <?php
            echo "<a href='post_upload.php'> Đăng bài </a></br>";
            echo "<a href='post_all.php'> Xem các bài đăng </a></br>";
        ?>
        <h2>Sửa thông tin người dùng</h2>
        <p>
            <?php
                echo "<a href='account_profile_change.php'> Chỉnh sửa thông tin cá nhân </a></br>";
                echo "<a href='account_password_change.php'> Đổi mật khẩu </a></br>";
                if ($_SESSION['level']==0)
                    echo "<a href='account_delete.php'> Xoá tài khoản </a></br>";
            ?>
        </p>
    </body>
</html>