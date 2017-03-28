<?php
header("Content-type: text/html; charset=utf-8");
if(isset($_POST["Submit"]) && $_POST["Submit"] == "注册")
{
    $user = $_POST["username"];
    $psw = $_POST["password"];
    $psw_confirm = $_POST["confirm"];
    $email=$_POST['email'];
    $qq=$_POST['qq'];
    $gender=$_POST['gender'];
    $checkcode=$_POST['chkcode'];
    session_start();

    $image = mysql_escape_string(file_get_contents($_FILES['file']['tmp_name']));

    $type = $_FILES['file']['type'];

    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $image);
    $extension = end($temp);        // 获取文件后缀名
    if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/ico")
            || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 102400)    // 小于 100 kb
        && in_array($extension, $allowedExts))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "<script>alert('错误');history.go(-1);</script>";
        }
    }

    if($user == "" || $psw == "" || $psw_confirm == "" ||$email=='' )
    {
        echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";
    }
    else
    {
        if($psw == $psw_confirm)
        {
            $conn = mysqli_connect('127.0.0.1','root','','bishe');
            $sql = "SET NAMES UTF8";
            if (!$conn) {
                die("Connection failed: " .mysqli_connect_error());
            }
            mysqli_query($conn,$sql);
            $sql = "select username from information where username = '$_POST[username]'"; //SQL语句
            $result = mysqli_query($conn,$sql);    //执行SQL语句
            $num = mysqli_num_rows($result); //统计执行结果影响的行数
            if($num)    //如果已经存在该用户
            {
                echo "<script>alert('用户名已存在'); history.go(-1);</script>";
            }   //判断验证码是否正确
            else if($checkcode!=$_SESSION['originalcheckcode']){
                echo "<script>alert('验证码错误'); history.go(-1);</script>";
            }
            else    //不存在当前注册用户名称
            {

                $sql_insert = "insert into information (username,password,email,qq,gender,type,binarydata,chkcode) values('$_POST[username]','$_POST[password]','$_POST[email]','$_POST[qq]','$_POST[gender]','$type','$image','$checkcode')";
                $res_insert = mysqli_query($conn,$sql_insert);

                //$num_insert = mysql_num_rows($res_insert);
                if($res_insert)
                {
                    echo "<script>alert('注册成功！'); window.location='../login.html'</script>";
                }
                else
                {
                    echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
                }
            }
        }
        else
        {
            echo "<script>alert('密码不一致！'); history.go(-1);</script>";
        }
    }
}
else
{
    echo "<script>alert('提交未成功！'); history.go(-1);</script>";
}
?>