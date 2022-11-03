<?php
    include 'account_login_check.php';
    mysqli_set_charset($con, 'UTF8');
    if(isset($_GET['username_search']))
    {
        $search_content = mysqli_real_escape_string($con,addslashes(trim($_GET['search_content'])));
        $sql = "SELECT * FROM member WHERE isDeleted='0' AND username like '%$search_content%'";
        if ($query = mysqli_query($con,$sql))
        {
            if (mysqli_num_rows($query)==0)
                echo "<p>Không tìm thấy người dùng nào.</br></p>";
            else
            {
                echo "<p>Tìm thấy ".mysqli_num_rows($query)." người dùng:</br>";
                while($ans=mysqli_fetch_array($query))
                {
                    echo "<a href='profile.php?username=".$ans['username']."'>".$ans['username']."</a></br>";
                }
                echo "</p>";
            }
        }
        echo "</br>------------------------------------------------</br>";
    }
    if(isset($_GET['post_search']))
    {
        $search_content = addslashes(trim($_GET['search_content']));
        if ($_SESSION['level']==0)
            $sql = "SELECT * FROM baidang WHERE isPublic=1 AND isDeleted=0 AND (content like N'%$search_content%' OR title like N'%$search_content%')";
        else
            $sql = "SELECT * FROM baidang WHERE (content like N'%$search_content%' OR title like N'%$search_content%')";
        if ($query = mysqli_query($con,$sql))
        {
            echo "<p>Tìm thấy ".mysqli_num_rows($query)." bài viết:</br>";
            while($ans=mysqli_fetch_array($query))
            {
                echo "Bài đăng của <b>".$ans['username']."</b></br>";
                echo "Hiển thị: ".(empty($ans['isPublic'])?"riêng tư":"công khai")."</br>";
                if ($_SESSION['level']==1)
                {
                    if ($ans['isDeleted']==1)
                    {
                        echo "Bài viết <b>đã bị xóa</b>.</br>";
                    }
                }
                echo "Tiêu đề: ".$ans['title']."</br>"; 
                echo "Nội dung: </br><pre>".$ans['content']."</pre></br>";
                echo "</br>____________________________________________________</br></br>";
            }
            echo "</p>";
        }
        else
            echo "<p>Không tìm thấy bài viết nào.</br></p>";
    }
    $_GET=array();
    echo "<a href='page_main'>Trở lại</a>";
?>