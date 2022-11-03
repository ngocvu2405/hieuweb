<?php
//Khai báo sử dụng session
session_start();

if (isset($_SESSION['username']))
{
    echo "Bạn đã đăng nhập. Vui lòng quay lại <a href='page_main'.php'>trang chủ</a>";
    exit();
}
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');

//Xử lý đăng nhập
if (isset($_POST['dangnhap'])) 
{
    //Kết nối tới database
    include 'connect.php';

    //Lấy dữ liệu nhập vào
    $username = mysqli_real_escape_string($con,addslashes($_POST['txtUsername']));
    $password = mysqli_real_escape_string($con,addslashes($_POST['txtPassword']));

    //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
    if (!$username || !$password) {
        echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";       exit;
    }

    // mã hóa pasword
    $password = md5($password);

    //Kiểm tra tên đăng nhập có tồn tại không
    $query = mysqli_query($con,"SELECT username, password,isDeleted,level FROM member WHERE username='$username'");
    if (mysqli_num_rows($query) == 0) {
        echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }

    //Lấy mật khẩu trong database ra
    $row = mysqli_fetch_array($query);

    //So sánh 2 mật khẩu có trùng khớp hay không
    if ($password != $row['password']) {
        echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }

    if ($row['isDeleted']==1)
    {
        echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }


    //Lưu tên đăng nhập
    $_SESSION['username'] = $username;
    $_SESSION['isDeleted'] = $row['isDeleted'];
    $_SESSION['level'] = $row['level'];
    echo "Xin chào " . $username . ". Bạn đã đăng nhập thành công. <a href='page_main.php'>Về trang chủ</a>";
    $_POST=array();
    die();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <form action='account_login.php?do=login' method='POST'>
            <p>
                <label for="txtUsername" aria-label='Nhập tên đăng nhập'> Tên đăng nhập : </label> 
                <input type="text" name="txtUsername" size="50" />
            </p>
            <p>
                <label for="txtPassword"> Mật khẩu : </label> 
                <input type="password" name="txtPassword" size="50" />
            </p>
            <input type='submit' name="dangnhap" value='Đăng nhập' />
            <a href='account_registration.php' title='Đăng ký'>Đăng ký</a>
        </form>
    </body>
</html>