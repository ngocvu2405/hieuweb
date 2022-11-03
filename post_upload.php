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
        <h2>Đăng bài</h2>
        <form action="post_upload_check.php" method="POST" enctype="multipart/form-data">
            <p>
                <label for='tieude'>Tiêu đề:</label>
                <!--<textarea rows="2" cols="50" name="tieude" size="50"></textarea> -->
                <input type="text" name="tieude" id='tieude' size="50" />
            </p>
            <p>
                <label for='noidung'>Nội dung:</label>
                <textarea rows="7" cols="80" name="noidung" id = "noidung" size="50"></textarea> 
                <!--<input type="text" name="noidung" id="noidung" size="50" /> -->
            </p>
            <p>
                <label for='status'>Trạng thái:</label>
                <select name='status'>
                    <option value="private">Riêng tư</option>
                    <option value="public">Công khai</option>
                </select>
            </p>
            <p>
                <input type="submit" value="Đăng bài"></input>
                <input type="reset"value="Nhập lại"></input>
            </p>
        </form>
        <a href ='post_all.php'>Quay lại</a>
    </body>
</html>

