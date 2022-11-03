<?php
    include 'account_login_check.php';
    mysqli_set_charset($con, 'UTF8');
    $username = mysqli_real_escape_string($con,$_SESSION['username']);
    $tieude = mysqli_real_escape_string($con,addslashes(trim($_POST['tieude'])));
    $noidung = mysqli_real_escape_string($con,$_POST['noidung']);
    $isPublic = $_POST['status']=='private' ? 0 : 1;
    $_POST = array();
    if(empty($tieude)&&empty($noidung))
    {
        echo "Đăng bài thất bại, vui lòng <a href='javascript: history.go(-1)'>nhập lại</a> nội dung.</br>";
    }
    else
    {
        $sql = "INSERT INTO baidang (username,title,content,isDeleted,isPublic) VALUES (
        '{$username}',
        N'{$tieude}',
        N'{$noidung}',
        0,
        $isPublic
        )";
        //echo $sql."</br>";
        if(mysqli_query($con,$sql))
        {
            echo "Đăng bài thành công.</br>";
        }
        else
            echo "Thất bại.";
        echo "<a href ='post_upload.php'>Quay lại</a>";
    }
?>