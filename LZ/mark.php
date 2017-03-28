<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/27
 * Time: 0:04
 */
$name = $_POST["title"];
$method=$_POST['model_id'];
$description=$_POST['description'];
$create_time=$_POST['create_time'];



$conn=mysqli_connect('localhost','root','','bishe');
$sql="SET NAMES UTF8";
if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
}
mysqli_query($conn,$sql);
//验证内容是否与数据库的记录吻合。
$sql = "insert into mark (mid,name,method,description,create_time,mcontent,msize,front,behind) values('','$name','$method','$description','$create_time','','','','')";
//var_dump($sql);
//执行上面的sql语句并将结果集赋给result。
//$result = $conn->query($sql);
$result = mysqli_query($conn,$sql);
if($result)    //如果已经存在该用户
{
    echo "<script>alert('保存成功'); history.go(-1);</script>";
}   //判断验证码是否正确
else {
    echo "<script>alert('保存失败'); history.go(-1);</script>";
}