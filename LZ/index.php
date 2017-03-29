<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
    <title>标注系统</title>
    <link rel="stylesheet" href="./layui/css/layui.css">
    <link rel="stylesheet" href="./css/global.css">
    <script type="text/javascript" src="./layui/layui.js"></script>
</head>
<body>
<?php
session_start();
?>
<div class="layui-layout layui-layout-admin">
    <div class="layui-header header">
      <div class="layui-main">
        <a class="logo" href='#' target="_blank">
          <span style="color:#009E94;font-size:20px ;line-height: 70px;">标注系统</span>
        </a>
        <ul class="layui-nav top-nav-container">
          <li class="layui-nav-item layui-this" id="mainpage">
            <a href="javascript:void(0)" >首页</a>
          </li>
            <?php
                if(isset($_SESSION['all_managers']['username'])){
                    echo '<li class="layui-nav-item">
                          <a href="javascript:void(0)">全部文件</a>
                          </li>';
                }
            ?>
            <?php
                if(isset($_SESSION['all']['username'])){
                    echo' <li class="layui-nav-item">
                          <a href="javascript:void(0)">我的文件</a>
                          </li>';
                }
            ?>
            <?php
                if(empty($_SESSION['all']['username'])&&empty($_SESSION['all_managers']['username'])){
                    echo' <li class="layui-nav-item">
                          <a href="javascript:void(0)">请登录后再尝试</a>
                          </li>';
                }
            ?>
        </ul>
        <div class="top_admin_user">
          <a class="update_cache" href="javascript:void(0)">更新缓存</a>|<a href="/" target="_blank">
                <?php
                if(isset($_SESSION['all']['username'])){
                    echo"欢迎,".$_SESSION['all']['username'];
                }else if(isset($_SESSION['all_managers']['username'])){
                    echo"欢迎管理员,".$_SESSION['all_managers']['username'];
                }
                else{
                    echo"游客";
                }
                ?>

            </a>  |
            <?php
            if(isset($_SESSION['all']['username'])){
                echo'
            <a class="navbar-brand" style="color: #3ab7ee; font-size: 14px; cursor: pointer;margin-top: -5px;" href="../php/logcheck.php?action=logout" id="logout"><button type="button" class="btn btn-default btn-sm"><span style="color: #3ab7ee" class="glyphicon glyphicon-user">登出</span></button></a>';
            }
            else if(isset($_SESSION['all_managers']['username'])){
                echo '  <a class="navbar-brand" style="color: #3ab7ee; font-size: 14px; cursor: pointer;margin-top: -5px;" href="../php/logcheckbyadmin.php?action=logout" id="logout"><button type="button" class="btn btn-default btn-sm"><span style="color: #3ab7ee;" class="glyphicon glyphicon-user">管理员登出</span></button></a>';
            } else{
                echo'  <a  href="../index.html" >注册</a>';
            }
            ?>

        </div>
      </div>
    </div>
    <div id="side" class="layui-side layui-bg-black" >
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree left_menu_ul">
              <li class="layui-nav-item layui-nav-title">
                <a>个人信息</a>
              </li>
              <li class="layui-nav-item first-item layui-this">
                <a href="./home.html" target="main">
                  <i class="layui-icon">&#xe638;</i>
                  <cite>首页面板</cite>
                </a>
              </li>
              <li class="layui-nav-item ">
                <a href="form.php" target="main">
                  <i class="layui-icon">&#xe642;</i>
                  <cite>标注</cite>
                </a>
              </li>
            </ul>

            <?php
                if(isset($_SESSION['all_managers']['username'])){
                    echo '<ul class="layui-nav layui-nav-tree left_menu_ul content_put_manage hide">
              <li class="layui-nav-item layui-nav-title">
                <a>全部文件</a>
              </li>
              <li class="layui-nav-item first-item">
                <a href="category_list.php" target="main">
                  <i class="layui-icon">&#xe609;</i>
                  <cite>文件管理</cite>
                </a>
              </li>
              <li class="layui-nav-item content_manage">
                <a href="./content_manage_search.html" target="main">
                  <i class="layui-icon">&#xe60a;</i>
                  <cite>内容管理</cite>
                </a>
              </li>
              <li class="layui-nav-item">
                <a href="feedback_list.php" target="main">
                  <i class="layui-icon">&#xe63a;</i>
                  <cite>文件详情管理</cite>
                </a>
              </li>
            </ul>';
                }
            ?>

            <?php
             if(isset($_SESSION['all']['username'])){
                echo '<ul class="layui-nav layui-nav-tree left_menu_ul content_put_manage hide">
            <li class="layui-nav-item layui-nav-title">
              <a>我的文件</a>
            </li>
            <li class="layui-nav-item first-item">
              <a href="category_list.php" target="main">
                <i class="layui-icon">&#xe609;</i>
                <cite>我的文件管理</cite>
              </a>
            </li>
            <li class="layui-nav-item content_manage">
              <a href="./content_manage_search.html" target="main">
                <i class="layui-icon">&#xe60a;</i>
                <cite>我的内容管理</cite>
              </a>
            </li>
            <li class="layui-nav-item">
              <a href="feedback_list.php" target="main">
                <i class="layui-icon">&#xe63a;</i>
                <cite>我的文件详情管理</cite>
              </a>
            </li>
          </ul>';
             }
            ?>
            <?php
                if(empty($_SESSION['all']['username'])&&empty($_SESSION['all_managers']['username'])){
                    echo "<script>alert('请登录后再试！'); history.go(-1);</script>";
                }
            ?>

    			<div class="content_manage_container left_menu_ul hide">
    				<div class="content_manage_title">内容管理</div>
        		<div id="content_manage_tree"></div>
        	</div>
        </div>



    </div>

    <div class="layui-body iframe-container">
        <div class="iframe-mask" id="iframe-mask"></div>
        <iframe class="admin-iframe" id="admin-iframe" name="main" src="./home.html"></iframe>
    </div>
    
    <div class="layui-footer footer">
      <div class="layui-main">
        <p>2017 © <a href="#">finalexercise</a></p>
      </div>
    </div>
</div>


<script type="text/javascript">
layui.use(['layer', 'element','jquery','tree'], function(){
  var layer = layui.layer
  ,element = layui.element() //导航的hover效果、二级菜单等功能，需要依赖element模块
  ,jq = layui.jquery

  //头部菜单切换
  jq('.top-nav-container .layui-nav-item').click(function(){

    var menu_index = jq(this).index('.top-nav-container .layui-nav-item');
    jq('.top-nav-container .layui-nav-item').removeClass('layui-this');
    jq(this).addClass('layui-this');
    jq('.left_menu_ul').addClass('hide');
    jq('.left_menu_ul:eq('+menu_index+')').removeClass('hide');
    jq('.left_menu_ul .layui-nav-item').removeClass('layui-this');
    jq('.left_menu_ul:eq('+menu_index+')').find('.first-item').addClass('layui-this');
    var url = jq('.left_menu_ul:eq('+menu_index+')').find('.first-item a').attr('href');
    jq('.admin-iframe').attr('src',url);
    //出现遮罩层
    jq("#iframe-mask").show();
    //遮罩层消失
    jq("#admin-iframe").load(function(){
      jq("#iframe-mask").fadeOut(100);
    });
  });
  //左边菜单点击
  jq('.left_menu_ul .layui-nav-item').click(function(){
    jq('.left_menu_ul .layui-nav-item').removeClass('layui-this');
    jq(this).addClass('layui-this');
    //出现遮罩层
    jq("#iframe-mask").show();
    //遮罩层消失
    jq("#admin-iframe").load(function(){
      jq("#iframe-mask").fadeOut(100);
    });
  });
   
  //点击回到内容页面
  jq('.content_manage_title').click(function(){
  	jq('.left_menu_ul .layui-nav-item').removeClass('layui-this');
  	jq(this).parent().addClass('hide');
  	jq('.content_put_manage').find('.first-item').addClass('layui-this');
  	var url = jq('.content_put_manage').find('.first-item a').attr('href');
    jq('.admin-iframe').attr('src',url);
  	jq('.content_put_manage').removeClass('hide');

  });
  //内容管理树
  jq('.content_manage').click(function(){
    loading = layer.load(2, {
      shade: [0.2,'#000'] //0.2透明度的白色背景
    });
      jq('#content_manage_tree').empty();
      layui.tree({
        elem: '#content_manage_tree' //传入元素选择器
        ,skin: 'white'
        ,target: 'main'
        ,nodes: [{"id":1,"name":"我的文件夹","children":[{"id":8,"name":"1","children":[],"href":"\/admin\/article\/index\/category_id\/8.html"},{"id":9,"name":"PHP","children":[],"href":"\/admin\/article\/index\/category_id\/9.html"},{"id":10,"name":"new","children":[],"href":"\/admin\/article\/index\/category_id\/10.html"},{"id":11,"name":"WEB前端","children":[],"href":"\/admin\/article\/index\/category_id\/11.html"}],"spread":true},{"id":2,"name":"共享文件夹","children":[{"id":13,"name":"1","children":[],"href":"\/admin\/download\/index\/category_id\/13.html"},{"id":14,"name":"3","children":[],"href":"\/admin\/download\/index\/category_id\/14.html"}],"spread":true},{"id":3,"name":"new","children":[],"spread":true,"href":"\/admin\/link\/index\/category_id\/3.html"},{"id":4,"name":"demo","children":[{"id":5,"name":"demo2","children":[],"href":"\/admin\/page\/edit\/category_id\/5.html"},{"id":6,"name":"demo1","children":[],"href":"\/admin\/page\/edit\/category_id\/6.html"}],"spread":true,"href":"\/admin\/link\/index\/category_id\/3.html"}]
      });
      jq('.left_menu_ul').addClass('hide');
      jq('.content_manage_container').removeClass('hide');
      layer.close(loading);
  });

  //更新缓存
  jq('.update_cache').click(function(){
    loading = layer.load(2, {
      shade: [0.2,'#000'] //0.2透明度的白色背景
    });
    jq.getJSON('',function(data){
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
  });

  //退出登陆
  jq('.logout_btn').click(function(){
    loading = layer.load(2, {
      shade: [0.2,'#000'] //0.2透明度的白色背景
    });
    jq.getJSON('',function(data){
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
  });

	
});


</script> 
</body>
</html>