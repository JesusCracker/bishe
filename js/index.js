/**
 * Created by saber on 16/9/25.
 */
//阻止了'我的订单'中a的单击默认事件

$('#list_eight>ul>li:eq(3)').hover(function () {
    $(this).addClass('special');
    $('.my_Order').show();
},function () {
    $(this).removeClass('special');
    $('.my_Order').hide();
});

$(".phone").hover(function(){
    $(".jielun").show();
},function(){
   // setTimeout(function(){ $("#ads_1").slideToggle(400); },1000);
   //var timer=setTimeout(function () {
       $(".jielun").hide();
  // },3000);
});

$('#list_eight>ul>li:eq(7)').hover(function () {
    console.log('111');
    $(".weixin>a>img").show();
},function () {
    $(".weixin>a>img").hide();
});

$('.my_Order>li>a').hover(function () {
    $(this).addClass('hover_Color');
},function () {
    $(this).removeClass('hover_Color');
});

$('.t_List').find('a').each(function () {
    $(this).addClass('font1');
});

$('.t_List').find('li').hover(function () {
    $(this).addClass('bg_grey');
    $(this).children('a').addClass('font2');
},function () {
  $(this).removeClass('bg_grey');
    $(this).children('a').removeClass('font2');
});

$('.btn2').click(function () {
    $('.t_List>ul').show();
});
$('.btn2').mouseover(function () {
    $('.t_List>ul').hide();
});
$('.index>li>a').addClass('a1');

$('.index>li').hover(function () {
    $(this).addClass('bg1');
},function () {
    $(this).removeClass('bg1');
});

$('.index>li').click(function () {
    $(this).addClass('active1');
    $(this).context.firstChild.className='a2';
});
$('.followGroup>li>a').addClass('a3');
$('.followGroup>li:nth-child(1)>a').addClass('a4');
$('.followGroup>li:nth-child(3)>a').addClass('a4');

$('.followGroup>li').hover(function () {
    $(this).addClass('active1');
    $(this).children(0).attr("class", "") .addClass('a2');
},function () {
        $(this).removeClass('active1');
        $(this).children(0).attr("class", "") .addClass('a3')
});

$('.index>li:nth-child(2)').hover(function () {
    $('.followGroup').show();
},function () {
    $('.followGroup').hide();
});
//广告轮播

$(function(){
    var i=0;
    var clone=$(".mid_Ads.img li").first().clone(true);
    $(".mid_Ads .img").append(clone);
    var size=$(".mid_Ads .img li").size();
    for(var j=0;j<size-1;j++){
        $(".mid_Ads .num").append("<li></li>");
    }

    //向左
    $(".mid_Ads .btn_l").click(function(){
        moveL();
    });
    function moveL(){
        i++;
        if(i==size){
            $(".mid_Ads  .img").css({left:0});
            i=1;
        }
        $(".mid_Ads .img").stop().animate({left:-i*1280},440);
        /*指数器的BUG*/
        if(i==size-1){
            $(".mid_Ads .num li").eq(0).addClass("on").siblings().removeClass();
        }
        $(".mid_Ads .num li").eq(i).addClass("on").siblings().removeClass();

    }
    //向右
    $(".mid_Ads .btn_r").click(
        function(){
            console.log('111');
            moveR();
        });

    function moveR(){
        i--;
        if(i==-1){
            $(".mid_Ads .img").css({left:-(size-1)*440})
            i=size-2;

        }
        $(".mid_Ads .img").stop().animate({left:-i*1280},440);
        $(".mid_Ads.num li").eq(i).addClass("on").siblings().removeClass();

    }
    //按钮
    /*鼠标划入圆点*/
    /*
     $(".mid_Ads .num li").first().addClass("on");
    $(".mid_Ads .num li").hover(function(){
        var index=$(this).index();
        i=index;
        $(".mid_Ads .img").stop().animate({left:-index*1280},440);
        $(this).addClass("on").siblings().removeClass("on");

    });
    */
    //自动轮播
    var t=setInterval(function(){
        moveL();
    },3000);
    /*对mid_Ads定时器的操作*/
    $(".mid_Ads").hover(
        function(){
            clearInterval(t);
        },
        function(){
            t=setInterval(moveL,3000);
        })
});
//中间的左右按钮的出现与消失

$('.hide_Area').mouseover(function () {
    $('.btn').show();

});
/*
$('.hide_Area').mouseout(function () {
    $('.btn').hide();
});
*/


