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
      <div class="main-tab-item">文件详情管理</div>
    </ul>
    <div class="layui-tab-content">
      <div class="layui-tab-item layui-show">

      <!-- 搜索 -->
      <form class="layui-form layui-form-pane search-form">
        <div class="layui-form-item">
          <label class="layui-form-label">文件名</label>
          <div class="layui-input-inline">
            <input type="text" name="search" value="" lay-verify="" placeholder="请输入标题搜索" autocomplete="off" class="layui-input " id="search">
          </div>
          <button class="layui-btn search_btn" lay-submit="" lay-filter="">搜索</button>
        </div>
        <!-- 每页数据量 -->
        <div class="layui-form-item page-size">
          <label class="layui-form-label total">共计 3 条</label>
          <label class="layui-form-label">每页数据条</label>
          <div class="layui-input-inline">
            <input type="text" name="page_size" value="20" lay-verify="number" placeholder="" autocomplete="off" class="layui-input">
          </div>
          <button class="layui-btn" lay-submit="" lay-filter="">确定</button>
        </div>
      </form>


      <form class="layui-form">
        <table class="list-table">
          <thead>
            <tr>
              <th style="width:40px"><input type="checkbox" name="checkAll" lay-filter="checkAll" title=" "></th>
              <th style="text-align: center;width: ;">ID</th>
              <th style="text-align: center;width: ;">标题</th>
              <th class="can_click" style="text-align: center;width: ;">
                <a href="">创建时间 ▼</a>
              </th>
              <th class="can_click" style="text-align: center;width: ;">
                <a href="">最后修改时间 ▼</a>
              </th>
              <th style="text-align: center;width: ;">操作</th>
            </tr>
          </thead>
          <tbody>
          <?php
          session_start();
          if(isset($_SESSION['all']['username'])||isset($_SESSION['all_managers']['username'])){
              if(isset($_SESSION['all']['username'])){
                  $username=$_SESSION['all']['username'];
              }
              if(isset($_SESSION['all_managers']['username'])){
                  $managename=$_SESSION['all_managers']['username'];
              }
              $conn=mysqli_connect('localhost','root','','bishe');
              $sql="SET NAMES UTF8";
              if (!$conn) {
                  die("Connection failed: " .mysqli_connect_error());
              }
              mysqli_query($conn,$sql);
              //权限判断
              if(isset($username)){
                  $sql = "SELECT * FROM text WHERE uername='$username'";
              }
              if(isset($managename)){
                  $sql="SELECT * FROM text WHERE 1";
              }

              $result = mysqli_query($conn,$sql);
              $num = mysqli_num_rows($result);
              if($num){
                  while( $row = mysqli_fetch_assoc($result) ) {
                      //$uploadtime=date($row['uploadtime']);
                      $uploadtime= date("Y-m-d H:i:s", $row['uploadtime']);
                      $edittime=date("Y-m-d H:i:s", $row['edittime']);
                      echo " <tr>
              <td style=\"text-align: center;width: ;\"><input type=\"checkbox\" name=\"ids[8]\" lay-filter=\"checkOne\" value=\"8\" title=\" \"><div class=\"layui-unselect layui-form-checkbox\"><span> </span><i class=\"layui-icon\"></i></div></td>
              <td style=\"text-align: center;width: ;\">$row[tid]</td>
              <td style=\"text-align: center;width: ;\"><a class=\"list-title\" href=\"javascript:void(0)\" feedback-id=\"8\">$row[name]</a></td>
              <td style=\"text-align: center;width: ;\">$uploadtime</td>
              <td style=\"text-align: center;width: ;\">$edittime</td>
              <td style=\"text-align: center;\">
                <a href=\"feedback_edit.php\" class=\"layui-btn layui-btn-small\" title=\"编辑\"><i class=\"layui-icon\"></i>编辑</a>
                <a class=\"layui-btn layui-btn-small layui-btn-danger del_btn\" feedback-id=\"8\" title=\"删除\" feedback-name=\"$row[name]\" id='$row[tid]'><i class=\"layui-icon\"></i>删除</a>
              </td>
            </tr>";
                  }
              }


          }
          ?>

          </tbody>
          <thead>
            <tr>
               <th><button class="layui-btn layui-btn-small" lay-submit lay-filter="delete">删除</button></th>
              <th colspan="6"><div id="page"></div></th>
            </tr>
          </thead>
        </table>
      </form>
      </div>
    </div>
</div>
<script type="text/javascript">
layui.use(['element', 'laypage', 'layer', 'form'], function(){
  var element = layui.element()
  ,jq = layui.jquery
  ,form = layui.form()
  ,laypage = layui.laypage;




  //ajax删除
  jq('.del_btn').click(function(){
    var name = jq(this).attr('feedback-name');
    var id = jq(this).attr('feedback-id');
    var idd=jq(this).attr("id");
    layer.confirm('确定删除【'+name+'】?', function(index){
      loading = layer.load(2, {
        shade: [0.2,'#000'] //0.2透明度的白色背景
      });
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



    //ajax查询
    jq('.search_btn').click(function(){
        var inp=jq('#search').value();
        alert('1111');
    });



    //全选
  form.on('checkbox(checkAll)', function(data){
    if(data.elem.checked){
      jq("input[type='checkbox']").prop('checked',true);
    }else{
      jq("input[type='checkbox']").prop('checked',false);
    }
    form.render('checkbox');
  });

  form.on('checkbox(checkOne)', function(data){
    var is_check = true;
    if(data.elem.checked){
      jq("input[lay-filter='checkOne']").each(function(){
        if(!jq(this).prop('checked')){ is_check = false; }
      });
      if(is_check){
        jq("input[lay-filter='checkAll']").prop('checked',true);
      }
    }else{
      jq("input[lay-filter='checkAll']").prop('checked',false);
    }
    form.render('checkbox');
  });

  //监听提交
  form.on('submit(delete)', function(data){
    //判断是否有选项
    var is_check = false;
    jq("input[lay-filter='checkOne']").each(function(){
      if(jq(this).prop('checked')){ is_check = true; }
    });
    if(!is_check){
      layer.msg('请选择数据', {icon: 2,anim: 6,time: 1000});
      return false;
    }
    //确认删除
    layer.confirm('确定批量删除?', function(index){
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
          layer.msg(data.msg, {icon: 2,anim: 6, time: 1000});
        }
      });
    });
    return false;
  });



  laypage({
    cont: 'page'
    ,skip: true
    ,pages: 100 //总页数
    ,groups: 5 //连续显示分页数
    ,curr: 2
    ,jump: function(e, first){ //触发分页后的回调
      if(!first){ //一定要加此判断，否则初始时会无限刷新
        loading = layer.load(2, {
          shade: [0.2,'#000'] //0.2透明度的白色背景
        });
        location.href = '?&page='+e.curr;
      }
    }
  });
})
</script>

</body>
</html>