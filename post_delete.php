<?php
    include 'account_login_check.php';
?>

<html>
    <h3> Bạn chắc chắn muốn xóa bài viết chứ? </h3>
    <form method="post">
        <input type="submit" name="PostDeleleConfirmed" value="Xác nhận">
        </input>
    </form>
</html>

<?php
    if (isset($_POST['PostDeleleConfirmed']))
    {
        $postID = $_GET['id'];
        $sql = "UPDATE baidang SET isDeleted='1' WHERE postID='$postID'";
        if (mysqli_query($con,$sql))
        {
            echo "Xóa bài thành công. </br>";
        }
        else echo "Xóa bài thất bại. </br>";
        unset($_POST['PostDeleleConfirmed']);
    }
?>

<?php
    echo "Quay lại <a href='post_all.php'>trang cá nhân của bạn</a>";
?>
