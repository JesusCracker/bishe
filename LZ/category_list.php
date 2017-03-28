<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
    <title>标记系统</title>
    <link rel="stylesheet" href="./layui/css/layui.css">
    <link rel="stylesheet" href="./css/global.css">
    <script type="text/javascript" src="./layui/layui.js"></script>
</head>
<body>

<div class="layui-tab layui-tab-brief main-tab-container">
    <ul class="layui-tab-title main-tab-title">
      <a href="category_list.php"><li class="layui-this">文件列表</li></a>
      <a href="category_add.php"><li>编辑文件</li></a>
      <div class="main-tab-item">文件管理</div>
    </ul>
    <div class="layui-tab-content">
      <div class="layui-tab-item layui-show">
      <form class="layui-form">

            <table class="list-table">
              <thead>
                <tr>
                  <th style="text-align: center;width:40px;">排序</th>
                  <th style="text-align: center;width: ;">ID</th>
                  <th style="text-align: center;width: ;">文件名称</th>
                  <th style="text-align: center;width: ;">所属编辑者</th>
                  <th style="text-align: center;width: ;">上传时间</th>
                  <th style="text-align: center;width: ;">操作</th>
                </tr>
              </thead>
              <tbody>
              <?php
              header("Content-type: text/html; charset=utf-8");
              // Session需要先启动。
              session_start();
              if(isset($_SESSION['all']['username'])||isset($_SESSION['all_managers']['username'])){
              $username=$_SESSION['all']['username'];
              //连接数据库
              //  $conn = new mysqli($servername, $username, $password, $dbname);
              $conn=mysqli_connect('localhost','root','','bishe');
              $sql="SET NAMES UTF8";
              if (!$conn) {
                  die("Connection failed: " .mysqli_connect_error());
              }
              mysqli_query($conn,$sql);
              //权限判断还没做
              $sql = "SELECT * FROM text WHERE username=$username ";
              $result = mysqli_query($conn,$sql);
              $num = mysqli_num_rows($result);

              if($num){
                  while( $row = mysqli_fetch_assoc($result) ) {
                      //$uploadtime=date($row['uploadtime']);
                    $uploadtime= date("Y-m-d H:i:s", $row['uploadtime']);
                     echo " <tr class='userList'>
                  <td><input name=\"sorts[1]\" type=\"text\" value=\"20\" lay-verify=\"number\" class=\"layui-input\"></td>
                  <td style='text-align: center;'>$row[tid]</td>
                  <td style='text-align: center;'>
                    $row[name]
                  </td>
                  <td style='text-align: center;'>$row[uername]</td>
                  <td style='text-align:center'>$uploadtime</td>
                  <td style=\"text-align: center;\">
                    <a href=\"./category_add.php\" class=\"layui-btn layui-btn-small\" title=\"编辑\"><i class=\"layui-icon\"></i>编辑</a>
                    <a class=\"layui-btn layui-btn-small layui-btn-danger del_btn\" category-id=\"1\" title=\"删除\" category-name=\"$row[name]\"  id='$row[tid]'><i class=\"layui-icon\"></i>删除</a>
                  </td>
                </tr>";
                  }
                }
              }
              ?>

              </tbody>
              <thead>
                <tr>
                  <th colspan="6"><button class="layui-btn layui-btn-small" lay-submit="" lay-filter="sort">排序</button></th>
                </tr>
              </thead>
            </table>

      </form>
      </div>
    </div>
</div>

<script type="text/javascript">
layui.use(['element', 'layer', 'form'], function(){
  var element = layui.element()
  ,jq = layui.jquery
  ,form = layui.form()
  ,laypage = layui.laypage;

  //图片预览
  jq('.list-table td .thumb').hover(function(){
    jq(this).append('<img class="thumb-show" src="'+jq(this).attr('thumb')+'" >');
  },function(){
    jq(this).find('img').remove();
  });
  //链接预览
  jq('.list-table td .link').hover(function(){
    var link = jq(this).attr('href');
    layer.tips( link, this, {
    tips: [2, '#009688'],
    time: false
  });
  },function(){
    layer.closeAll('tips');
  });

  //监听提交
  form.on('submit(sort)', function(data){
    loading = layer.load(2, {
      shade: [0.2,'#000'] //0.2透明度的白色背景
    });
    var param = data.field;
    jq.post('',param,function(data){
      if(data.code == 200){
        layer.close(loading);
        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
          location.reload();//do something
        });
      }else{
        layer.close(loading);
        layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
      }
    });
    return false;
  });

  //ajax删除
  jq('.del_btn').click(function(){
//     alert(jq(this).attr("id"));
    var idd=jq(this).attr("id");
    var name = jq(this).attr('category-name');
    var id = jq(this).attr('category-id');
    layer.confirm('确定删除【'+name+'】?', function(index){
        jq.ajax({
            type: "GET",
            url:"delete.php?tid="+idd,//我要执行删除的url地址
            data:jq(".userList").serialize(),
            success: function (data) {
                layer.msg('删除成功', {icon: 1 , time: 1000}, function(){
                    location.reload();//do something
                });

            },
            error: function (data) {
                layer.msg('删除失败', {icon: 2, anim: 6, time: 1000},function () {
                    location.reload();
                });
            }

        });
        layer.close(index);
    });
  });

})
</script>
</body>
</html>