<?php
    if (isset($_SESSION['username']))
    {
        echo "Bạn đã đăng nhập. Vui lòng quay lại <a href='page_main'.php'>trang chủ</a>";
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Trang đăng lý</title>
    </head>
    <body>
        <h1>Trang đăng ký thành viên</h1>
        <form action="account_registration_check.php" method="POST">
            <p>
                <label for="txtUsername"> Tên đăng nhập : </label> 
                <input type="text" name="txtUsername" size="50" />
            </p>
            <p>
                <label for="txtPassword"> Mật khẩu : </label> 
                <input type="password" name="txtPassword" size="50" />
            </p>
            <p>
                <label for="txtEmail"> Email : </label> 
                <input type="text" name="txtEmail" size="50" />
            </p>
            <p>
                <label for="txtEmail"> Họ và tên : </label> 
                <input type="text" name="txtFullname" size="50" />
            </p>
            <p>
                <label for="txtEmail"> Ngày sinh : </label> 
                <input type="text" name="txtBirthday" size="50" />
            </p>
            <p>
                <label for="txtGender"> Giới tính: </label> 
                <select name = "txtGender">
                    <option value="Không muốn tiết lộ">Không muốn tiết lộ</option>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </p>
            <input type="submit" value="Đăng ký" />
            <input type="reset" value="Nhập lại" />
        </form>
    </body>
</html>