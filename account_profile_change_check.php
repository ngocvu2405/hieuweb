<?php
    include 'account_login_check.php';
    if (!isset($_POST['txtNameC']) && !isset($_POST['txtBirthdayC']) && !isset($_POST['txtGenderC']))
    {
        echo "Không có thông tin mới nào được cập nhật thêm </br>";
        echo "Bấm vào đây để <a href='account_profile_change.php'>quay lại</a>";
        exit;
    }

    $username = mysqli_real_escape_string($con,addslashes($_SESSION['username']));
    $fullname = mysqli_real_escape_string($con,addslashes($_POST['txtNameC']));
    $birthday = mysqli_real_escape_string($con,addslashes($_POST['txtBirthdayC']));
    $gender = mysqli_real_escape_string($con,addslashes($_POST['txtGenderC']));
    $email = mysqli_real_escape_string($con,addslashes($_POST['txtEmailC']));
    $_POST=array();
    //echo $birthday;
    if ($fullname)
    {
        //echo $fullname;
        if (mysqli_query($con,"UPDATE member SET fullname='$fullname' WHERE username = '$username'"))
        {
            echo 'Cập nhật họ và tên <span style="color:red;">THÀNH CÔNG</span>!</br>';
        }
        else
        {
            echo 'Cập nhật họ và tên <span style="color:red;">THẤT BẠI</span>!</br>';
        }
    }
    if ($birthday)
    {
        if (!preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{2,4}/", $birthday))
        {
            echo "Ngày tháng năm sinh không hợp lệ. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        }
        elseif (mysqli_query($con,"UPDATE member SET birthday='$birthday' WHERE username = '$username'"))
        {
            echo "Cập nhật ngày sinh <span style='color:red;'>THÀNH CÔNG</span>!</br>";
        }
        else
        {
            echo "Cập nhật ngày sinh <span style='color:red;'>THẤT BẠI</span>!</br>";
        }

    }
    if ($gender)
    {
        if (mysqli_query($con,"UPDATE member SET gender=N'$gender' WHERE username = '$username'"))
        {
            echo "Cập nhật giới tính <span style='color:red;'>THÀNH CÔNG</span>!</br>";
        }
        else{
            echo "Cập nhật giới tính <span style='color:red;'>THẤT BẠI</span>!</br>";
        }
    }
    if ($email)
    {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) )
        {
            echo "Email không hợp lệ. Vui long nhập email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit;
        }  
        if (mysqli_num_rows(mysqli_query($con,"SELECT email FROM member WHERE email='$email'")) > 0)
        {
            echo "Email này đã có người dùng. Vui lòng chọn Email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit;
        }
        if (mysqli_query($con,"UPDATE member SET email='$email' WHERE username = '$username'"))
        {
            echo "Cập nhật Email <span style='color:red;'>THÀNH CÔNG</span>!</br>";
        }
        else{
            echo "Cập nhật Email <span style='color:red;'>THẤT BẠI</span>!</br>";
        }
    }
    echo "<a href='page_main.php'>Quay lại</a>"
?>
