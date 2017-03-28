<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/4
 * Time: 16:04
 */
session_start();
//上传到本地

if(is_uploaded_file($_FILES['file']['tmp_name']))
{
    //上传到DB
    $conn = mysqli_connect('127.0.0.1','root','','bishe');

    $sql="SET NAMES UTF-8";
    if (!$conn) {
        die("Connection failed: " .mysqli_connect_error());
    }

    mysqli_query($conn,$sql);
    $uploadtime=$_SESSION['file']['uploadtime'];
    $uername=$_SESSION['all']['username'];
    $txtid='';
    $error = $_FILES['file']['error'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];
    $name = $_FILES['file']['name'];
    $_SESSION['files']['filename']=$name;
    $type = $_FILES['file']['type'];
    $temp = explode(".", $name);
    $extension = end($temp);        // 获取文件后缀名
    //print_r($name);
//    $_SESSION['filename']=$name;
//    $_SESSION['tmpname']=$tmp_name;
//    $_SESSION['filesize']=$size;
    //限制文本后缀
    $allowedExts = array("txt", "doc", "docx");

    if ((($_FILES["file"]["type"] == "text/plain")//txt
            || ($_FILES["file"]["type"] == "application/msword")//doc
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"))//docx
        && in_array($extension, $allowedExts)){

        ("\n");
        if ($error == UPLOAD_ERR_OK && $size > 0) {
            $fp = fopen($tmp_name, 'r');
            $content = fread($fp, $size);
            fclose($fp);
            $content = addslashes($content);
            $uploadtime=time();

            $sql = "INSERT INTO text(tid,uername,filename,rank,uploadtime,txtid,name,type,size,content) VALUES ('','$uername','','','$uploadtime','$txtid','$name', '$type', $size,'$content')";
            $result = mysqli_query($conn,$sql);
            //print_r($result);
//            echo("文件在数据库已被保存.\n");
            echo"<script>alert('文件在数据库已被保存');</script>";

        } else {
//            echo("保存失败.\n");
            echo"<script>alert('文件在数据库保存失败');</script>";
        }
        print("\n");

    }

    $error=$_FILES['file']['error'];

    $path='../txt';
//    print_r($path);
    $name=$_FILES['file']['name'];
    if($error==0){

        move_uploaded_file($_FILES['file']['tmp_name'],"$path./$name");

        echo ("<script>alert('上传本地成功');</script>");

    }
    else
    {
        echo ("<script>alert('上传本地失败');</script>");
    }

}








?>
