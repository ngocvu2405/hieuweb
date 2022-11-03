<?php
    include 'account_login_check.php';
    include 'account_admin_check.php';
    $sql = "SELECT * FROM baidang WHERE username!='admin'";
    $my_query = mysqli_query($con, $sql);
    if (mysqli_num_rows($my_query)>0)
    {
        echo "Danh sách gồm ".mysqli_num_rows($my_query)." bài đăng:</br>";
    }
    else 
    {
        echo "Không có bài đăng nào.";
        echo "<a href='page_main.php'>Quay lại trang chủ</a>";
    }
    while($ans = mysqli_fetch_array($my_query))
    {
        if ($_SESSION['level']==0)
        {
            if (($ans['isDeleted'])==0)
            {
                echo "<b>".$ans['username']."</b> đã đăng một bài viết </br>";
                echo "Hiển thị: ".(empty($ans['isPublic'])?"riêng tư":"công khai")."</br>";
                echo "Tiêu đề: </br></br>".$ans['title']."</br></br>";
                echo "Nội dung: <pre>".$ans['content']."</pre>";
                echo "<a href=post_edit.php?id=".$ans['postID'].">Chỉnh sửa bài viết</a> </br>";
                echo "<a href=post_delete.php?id=".$ans['postID'].">Xóa bài viết</a> </br>";
                echo "</br>____________________________________________________</br></br>";
            }
        }
        else
        {
            echo "<b>".$ans['username']."</b> đã đăng một bài viết </br>";
            echo "Hiển thị: ".(empty($ans['isPublic'])?"riêng tư":"công khai")."</br>";
            if ($_SESSION['level']==1)
            {
                if ($ans['isDeleted']==1)
                {
                    echo "Bài viết <b>đã bị xóa</b>.</br>";
                }
            }
            echo "Tiêu đề: </br></br>".$ans['title']."</br></br>";
            echo "Nội dung: <pre>".$ans['content']."</pre>";
            echo "<a href=post_edit.php?id=".$ans['postID'].">Chỉnh sửa bài viết</a> </br>";
            echo "<a href=post_delete.php?id=".$ans['postID'].">Xóa bài viết</a> </br>";
            echo "</br>____________________________________________________</br></br>";
        }
    }
    echo "Quay lại <a href='page_main.php'>trang chủ</a>;"

?>