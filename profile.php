<html>
    <meta charset="UTF-8" />
<?php
    include 'account_login_check.php';
    $username = $_GET['username'];
    $sql_for_profile = "SELECT * FROM member WHERE username = '$username'";
    $sql_for_post = "SELECT * FROM baidang WHERE username = '$username'";
    
    $query_user_profile = mysqli_query($con,$sql_for_profile);
    $query_user_post = mysqli_query($con,$sql_for_post);

    $user_profile = mysqli_fetch_array($query_user_profile);

    echo "Thông tin cá nhân: </br>";
    echo "</br>Họ và tên: ".$user_profile['fullname'];
    echo "</br>Ngày sinh: ".$user_profile['birthday'];
    echo "</br>Địa chỉ Email: ".$user_profile['email'];
    echo "</br>Giới tính: ".$user_profile['gender'];
    echo "</br>---------------------------------------------</br></br>";

    echo "Danh sách bài đăng: </br>";
    while($user_post = mysqli_fetch_array($query_user_post))
    {
        if (!empty($user_post['isPublic']))
        {
            echo "Hiển thị: ".(empty($user_post['isPublic'])?"riêng tư":"công khai")."</br>";
            echo "Tiêu đề: </br></br>".$user_post['title']."</br></br>";
            echo "Nội dung: <pre>".$user_post['content']."</pre>";
            echo "<a href=post_edit.php?id=".$user_post['postID'].">Chỉnh sửa bài viết</a> </br>";
            echo "<a href=post_delete.php?id=".$user_post['postID'].">Xóa bài viết</a> </br>";
            echo "</br></br></br>____________________________________________________</br></br>";    
        }
    }
?>
</html>
