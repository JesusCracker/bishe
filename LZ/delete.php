<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/27
 * Time: 0:04
 */
$tid=$_REQUEST['tid'];
if(empty($tid))
{
    echo '[]';
    return;
}

print_r('111');
$conn=mysqli_connect('localhost','root','','bishe');
$sql="SET NAMES UTF8";
if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
}
mysqli_query($conn,$sql);
//验证内容是否与数据库的记录吻合。
$sql = "DELETE FROM text WHERE tid = $tid ";
//var_dump($sql);
//执行上面的sql语句并将结果集赋给result。
//$result = $conn->query($sql);
print_r($sql);
$result = mysqli_query($conn,$sql);
if($result){
    echo "<script>alert('删除成功！');</script>";
}
else{
    echo "<script>alert('删除失败！');</script>";
}
