<?php
//header("Content-type: text/html; charset=utf-8");
//$servername = "127.0.0.1";
//$username = "root";
//$password = "";
//$dbname = "student_info";
//?>
<?php
header("Content-type: text/html; charset=utf-8");
// Session需要先启动。
session_start();
//判断uname和pwd是否赋值
if(isset($_POST['gname']) && isset($_POST['gpwd'])){
    $gname = $_POST['gname'];
    $gpwd = $_POST['gpwd'];
    //连接数据库
    //  $conn = new mysqli($servername, $username, $password, $dbname);
    $conn=mysqli_connect('localhost','root','','bishe');
    $sql="SET NAMES UTF8";
    mysqli_query($conn,$sql);
    if (!$conn) {
        die("Connection failed: " .mysqli_connect_error());
    }
    //验证内容是否与数据库的记录吻合。
    $sql = "SELECT * FROM manager WHERE (username='$gname') AND (password='$gpwd')";
    //var_dump($sql);
    //执行上面的sql语句并将结果集赋给result。
    //$result = $conn->query($sql);
    $result = mysqli_query($conn,$sql);
   // var_dump($result);

    $num = mysqli_num_rows($result); //统计执行结果影响的行数
    //var_dump($result);
    //判断结果集的记录数是否大于0

    if ($num) {
        $_SESSION['manager_name'] = $name;
        // 输出每行数据
        $row = mysqli_fetch_assoc($result);
        $_SESSION['all_managers']=$row;
       // print_r($_SESSION['all_managers']);
       header("Location:../LZ/index.php");

    } else {
        //echo "没有您要的信息";
        header("location:noRecord.php");
    }
    $conn->close();
}

//注销登录
if($_GET['action'] == "logout"){
    unset($_SESSION['all_managers']['username']);
    session_unset();
    session_destroy();
    echo '注销登录成功！点击此处 <a href="../login_by_admin.html">登录</a>';
    exit;
}
?>



