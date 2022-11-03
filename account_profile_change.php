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
        <form action="account_profile_change_check.php" method="post">
            <p>
                <label for="txtNameC">Họ và tên: </label>
                <input type="text" name="txtNameC" size="50">
            </p>
            <p>
                <label for="txtBirthdayC">Ngày sinh: </label>
                <input type="text" name="txtBirthdayC" size="50">
            </p>
            <p>
                <label for="txtGenderC">Giới tính: </label> 
                <select name = "txtGenderC">
                    <option value=""></option>
                    <option value="Không muốn tiết lộ">Không muốn tiết lộ</option>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </p>
            <p>
                <label for="txtEmailC">Email: </label>
                <input type="text" name="txtEmailC" size="50">
            </p>
            <p>
                <input type="submit" value="Xác nhận"></input>
                <input type="reset"value="Nhập lại"></input>
            </p>
        </form>
    </body>
</html>