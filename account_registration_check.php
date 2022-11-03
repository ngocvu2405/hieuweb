<?php
    if (isset($_SESSION['username']))
    {
        echo "Bạn đã đăng nhập. Vui lòng quay lại <a href='page_main'.php'>trang chủ</a>";
        exit();
    }
    // Nếu không phải là sự kiện đăng ký thì không xử lý
    if (!isset($_POST['txtUsername'])){
        die('');
    }
    if (!($_POST['txtUsername'])){
        unset($_POST['txtUsername']);
        die('');
    }
    
    //Nhúng file kết nối với database
    include('connect.php');
          
    //Khai báo utf-8 để hiển thị được tiếng việt
    header('Content-Type: text/html; charset=UTF-8');
          
    //addslashes: chống lỗi cú pháp 
    $username   = mysqli_real_escape_string($con,addslashes($_POST['txtUsername']));
    $password   = mysqli_real_escape_string($con,addslashes($_POST['txtPassword']));
    $email      = mysqli_real_escape_string($con,addslashes($_POST['txtEmail']));
    $fullname   = mysqli_real_escape_string($con,addslashes($_POST['txtFullname']));
    $birthday   = mysqli_real_escape_string($con,addslashes($_POST['txtBirthday']));
    $gender     = mysqli_real_escape_string($con,addslashes($_POST['txtGender']));

    unset($_POST['txtUsername']);
    unset($_POST['txtPassword']);
    unset($_POST['txtEmail']);
    unset($_POST['txtFullname']);
    unset($_POST['txtBirthday']);
    unset($_POST['txtGender']);

    //Kiểm tra người dùng đã nhập liệu đầy đủ chưa
    if (!$username || !$password || !$email || !$fullname || !$birthday || !$gender)
    {
        echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    if(!ctype_alnum($username)||!ctype_alnum($password)||!ctype_alpha($fullname))
    {
        echo "Thông tin bạn nhập có chứa các kí tự không hợp lệ. Các kí tự được chấp nhận bao gồm chữ thường, chữ hoa, số.";
        echo "</br>Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    if( strlen($username)>50 || strlen($password)>50 || strlen($email)>50 || strlen($fullname)>50 || strlen($birthday)>10 )
    {
        echo "Một hoặc nhiều ô thông tin của bạn quá dài. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    // Mã khóa mật khẩu
    $password = md5($password);

    //Kiểm tra tên đăng nhập này đã có người dùng chưa
    $sql_check_username = "SELECT username,isDeleted FROM member WHERE username='$username'";
    $ans_check_username = mysqli_query($con,$sql_check_username);
    $row_check_username = mysqli_fetch_array($ans_check_username);
    if (mysqli_num_rows($ans_check_username) > 0){
        if ($row_check_username['isDeleted']==0)
        {
            echo "Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
            unset($row_check_username);
            unset($ans_check_username);
            exit;
        }
    }

    //Kiểm tra email có đúng định dạng hay không
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) )
    {
        echo "Email này không hợp lệ. Vui long nhập email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
          
    //Kiểm tra email đã có người dùng chưa
    $sql_check_email = "SELECT isDeleted FROM member WHERE email='$email'";
    $ans_check_email = mysqli_query($con,$sql_check_email);
    $row_check_email = mysqli_fetch_array($ans_check_email);
    if (mysqli_num_rows($ans_check_email) > 0){
        if ($row_check_email['isDeleted']==0)
        {
            echo "Email này đã có người dùng. Vui lòng chọn email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
            unset($row_check_email);
            unset($ans_check_email);
            exit;
        }
    }
    unset($row_check_email);
    unset($ans_check_email);

    //Kiểm tra dạng nhập vào của ngày sinh
    if (!preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{2,4}/", $birthday))
    {
            echo "Ngày tháng năm sinh không hợp lệ. Vui long nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit;
    }
    
    if (isset($row_check_username['username']))
    {
        $delete_hidden_data = mysqli_query($con,"DELETE FROM baidang WHERE username='$username'");
        $delete_hidden_user = mysqli_query($con,"DELETE FROM member WHERE username='$username'");
        unset($row_check_username['username']);
    }

    //Lưu thông tin thành viên vào bảng 
    @$addmember = mysqli_query($con,"
        INSERT INTO member (username,password,email,fullname,birthday,gender,isDeleted,level) VALUES (
            '{$username}',
            '{$password}',
            '{$email}',
            '{$fullname}',
            '{$birthday}',
            N'{$gender}',
            0,
            0
        )
    ");
    //Thông báo quá trình lưu
    if ($addmember)
        echo "Quá trình đăng ký thành công. <a href='page_main.php'>Về trang chủ</a>";
    else
        echo "Có lỗi xảy ra trong quá trình đăng ký. <a href='account_registration.php'>Thử lại</a>";
?>