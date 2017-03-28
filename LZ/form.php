<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
    <title>标记系统</title>
    <link rel="stylesheet" href="./layui/css/layui.css">
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/signStyle.css">
    <script src="js/jquery-1.11.3.js"></script>
    <script src="js/jquery-sign.js"></script>
    <script type="text/javascript" src="./layui/layui.js"></script>
</head>
<style type="text/css">
    body,html,div,ul,li,a{
        margin:0;
        padding:0;
    }
    body,html{
        margin:0; padding:0;
        height:100%;
        width:100%;
        font-family:"微软雅黑"
    }

    .txtbox{
        height:200px;
        margin:0 auto;
        position:relative;
        border: 1px solid #e43;
    }
</style>

<body>
<div class="layui-tab layui-tab-brief main-tab-container">
    <ul class="layui-tab-title main-tab-title">
      <li class="layui-this">标注</li>
      <div class="main-tab-item">标注</div>
    </ul>
    <div class="layui-tab-content">
       <form class="layui-form" action="mark.php" method="post">
        <div class="layui-tab-item layui-show">
          <input type="hidden" name="name" value="">
          <div class="layui-form-item">
            <label class="layui-form-label">文件名</label>
            <div class="layui-input-inline input-custom-width">
                <?php
                session_start();
                ?>
              <input type="text" name="title" value=<?php echo  $_SESSION['files']['filename']?> lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">选择标注方法</label>
            <div class="layui-input-inline input-custom-width">
              <select name="model_id" lay-verify="required"><option value="">请选择</option><option value="1">手动标注</option><option value="2">半自动标注</option><option value="3">自动标注</option></select>
            </div>
            <div class="layui-form-mid layui-word-aux"></div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">文件描述</label>
            <div class="layui-input-inline input-custom-width">
              <textarea name="description" lay-verify="" autocomplete="off" placeholder="请输入标注描述" class="layui-textarea"></textarea>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">时间</label>
            <div class="layui-input-inline input-custom-width">
              <input type="text" name="create_time" value="2017-03-27 21:47:42" id="date" lay-verify="datetime" placeholder="YYYY-MM-DD hh:mm:ss" autocomplete="off" class="layui-input" onclick="layui.laydate({elem: this,istime: 1, format: 'YYYY-MM-DD hh:mm:ss' })">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">标注文本框</label>
              <div class="layui-input-inline input-custom-width">
              <p id="signx" class="txtbox">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aspernatur dolores earum, libero possimus praesentium unde vero? Aut dolorem est harum, odit perspiciatis quaerat, quibusdam temporibus tenetur totam ut vel.</p>
              </div>
          </div>
         
          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit="" lay-filter="feedback_edit" >立即提交</button>
            </div>
          </div>
        </div>   
      </form>
    </div>
</div>
<script type="text/javascript">
layui.use(['element', 'form', 'upload', 'layedit', 'laydate'], function(){
  var element = layui.element()
  ,form = layui.form()
  ,layedit = layui.layedit
  ,laydate = layui.laydate
  ,jq = layui.jquery;

  form.verify({
    //编辑器数据同步
    layedit: function(value){
      layedit.sync(content);
      layedit.sync(reply);
    }
  });


    //获取左键抹黑的字符
    //获取左键抹黑的字符
    var txt = '';
    var start_location;//抹黑的第一个字符的位置
    var end_location;//抹黑最后一个字符的位置

    var funGetSelectTxt = function() {

        if(document.selection) {
            txt = document.selection.createRange().text;
        } else {
            txt = document.getSelection();
        }
        return txt.toString();
        //console.log(txt.toString()) ;

    };
    $('#signx').mouseup(function () {
        funGetSelectTxt();
        var long=(txt.toString()).length;
        start_location=this.innerHTML.indexOf(txt.toString());
        end_location=this.innerHTML.indexOf(txt.toString())+txt.toString().length;
        console.log(txt.toString());
        console.log(start_location);
        console.log(end_location);

    });

    //设置 .signIndex的宽度
//  $('.singnIndex').attr('width','400px');

    <!---->
    $.sign.bindSign('#signx');//初始化
    //$.sign.setSignColor('#3498DB'); 设置标记框颜色
    //$.sign.setBodyColor('rgba(255,255,255,0.5)'); 设置提示背景颜色
    //$.sign.setFontColor('#000');//设置字体颜色
    //var m=$.sign.getSignMessage();//获取所有标记数据，返回为数组
//    var data=[{left:100,top:20,message:"测试"},{left:300,top:100,message:"测试2"}];
//    $.sign.loadingSign(data);//载入标记数据
  
})
</script>
</body>
</html>