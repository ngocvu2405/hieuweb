<?php
    include 'account_login_check.php'; 
?>

<html>
    <h3> Nhập vào các ô dưới đây để chỉnh sửa bài viết, nếu không chỉnh sửa gì thì để trống" <h3>
    <form method="post">
        <p>
        <label>Chỉnh sửa tiêu đề:</label>
        <input type="text" name="titleC" id="titleC" size="50"></input>
        </p>
        <p>
        <label> Chỉnh sửa nội dung: </label>
        <textarea name="contentC" id="contentC" rows="5" cols="50"></textarea>
        </p>
        <p>
            <label for='statusC'>Chỉnh sửa trạng thái bài viết:</label>
            <select name='statusC'>
                    <option value="private">Riêng tư</option>
                    <option value="public">Công khai</option>
                </select>
        </p>
        <p>
        <input type="submit" name="PostEditConfirmed" value="Xác nhận">
        </input>
        <input type="reset" value="Nhập lại"></input>
        </p>
        <br></br>
    </form>
</html>

<?php
    if (isset($_POST['PostEditConfirmed']))
    {
        $postID = $_GET['id'];
        $title = $_POST['titleC'];
        $content = $_POST['contentC'];
        if (!empty($title))
        {
            $sql = "UPDATE baidang SET title='$title' WHERE postID='$postID'";
            echo $sql."</br>";
            if (mysqli_query($con,$sql))
            {
                echo "Cập nhật tiêu đề thành công </br>";
            }
            else echo "Cập nhật tiêu đề thất bại </br>";
        }
        if (!empty($content))
        {
            $sql = "UPDATE baidang SET content='$content' WHERE postID='$postID'";
            if (mysqli_query($con,$sql))
            {
                echo "Cập nhật nội dung thành công </br>";
            }
            else echo "Cập nhật nội dung thất bại </br>";
        }
        if(isset($_POST['statusC']))
        {
            $isPublicC = $_POST['statusC'] == 'private' ? 0 : 1;
            $row = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM baidang WHERE postID='$postID'"));
            $status_now = $row['isPublic'];
            if ($isPublicC!=$status_now)
            {
                $sql = "UPDATE baidang SET isPublic='$isPublicC' WHERE postID='$postID'";
                if (mysqli_query($con,$sql))
                {
                    echo "Cập nhật trạng thái bài viết thành công </br>";
                }
                else echo "Cập nhật trạng thái bài viết thất bại </br>";
            }

        }
        unset($_POST['PostEditConfirmed']);
        unset($_POST['titleC']);
        unset($_POST['contentC']);
        unset($_POST['statusC']);
    }
?>

<?php
    echo "Quay lại <a href='post_all.php'>trang cá nhân của bạn</a>";
?>
