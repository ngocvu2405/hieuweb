<?php
    include 'account_login_check.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Sửa thông tin</title>
    </head>
    <body>
        <h1>Sửa thông tin cá nhân</h1>
        <h2>Điền thông tin mới vào chỗ bảng, để trống nếu không cần chỉnh sửa</h2>
        <form method="post">
            <p>
                <label for="txtPasswordO">Nhập lại mật khẩu cũ</label>
                <input type="password" name="txtPasswordO" size="50">
            </p>
            <p>
                <label for="txtPasswordC"> Nhập lại mật khẩu mới </label>
                <input type="password" name="txtPasswordC" size="50">
            </p>
            <p>
                <input type="submit" name="Permission" value="Xác nhận"></input>
                <input type="reset"value="Nhập lại"></input>
            </p>
            <p> <a href='page_main.php'>Quay lại</a> </p>
        </form>
        
    </body>
</html>

<?php
    include 'account_login_check.php';
    if(isset($_POST['Permission']))
    {
        $username = $_SESSION['username'];
        $PasswordO = md5($_POST['txtPasswordO']);
        $Password = mysqli_fetch_array(mysqli_query($con,"SELECT password FROM member WHERE username='$username'"))['password'];
        $PasswordC = md5($_POST['txtPasswordC']);
        if ($PasswordO == $Password)
        {
            if (mysqli_query($con,"UPDATE member SET password='$PasswordC' WHERE username = '$username'"))
            {
                echo "<h1><b>Đổi mật khẩu thành công.</b></h1>";
            }
            else
            {
                echo "<h1><b>Đổi mật khẩu thất bại.</b></h1>";
            }
        }
        else
        {
            echo "<h1><b>Mật khẩu cũ không khớp.</b></h1>";
        }
        unset($_POST['txtPasswordO']);
        unset($_POST['txtPasswordC']);
        unset($_POST['Permission']);
    }
