/**
 * Created by saber on 16/9/22.
 */
// var flag1=0,flag2=0,flag3=0,flag4=0,flag5=0;
//TODO:用户名验证
var username=document.getElementById("username");
var usernameTip=document.getElementById("usernameTip");

username.onfocus=function () {
    usernameTip.className="tips show";
    usernameTip.innerHTML='请输入8~16位的字母或数字';
};
username.onblur=function () {

    if(username.validity.valid){
        usernameTip.className="tips show login_Success";
        usernameTip.innerHTML="格式正确";
        //flag1=1;
    }
    else if(username.validity.valueMissing){
        usernameTip.className="tips show login_Error";
        usernameTip.innerHTML='用户名不为空';
        //flag1=0;
    }
    else  if(username.validity.patternMismatch){
        usernameTip.className="tips show login_Error";
        usernameTip.innerHTML="用户名格式错误";
        //flag1=0;
    }
};
//TODO:密码验证
var password=document.getElementById("password");
var passwordTip=document.getElementById("passwordTip");
password.onfocus=function () {
    passwordTip.className="tips show";
    passwordTip.innerHTML="以字母开头请输入6~18位(包含字符,数字,下划线)";
};
password.onblur=function () {

    if(password.validity.valid){
        passwordTip.className='tips show login_Success';
        passwordTip.innerHTML='格式正确';
        //flag2=1;
    }else  if(password.validity.valueMissing){
        passwordTip.className="tips show login_Error";
        passwordTip.innerText='密码不为空';
        //flag2=0;
    }else  if(password.validity.patternMismatch){
        passwordTip.className='tips show login_Error';
        passwordTip.innerText='密码格式错误'
       // flag2=0;
    }
   // console.log(password.value);
};

//TODO:密码确认
var checkPassword=document.getElementById('checkPassword');
var checkPasswordTip=document.getElementById('checkPasswordTip');
checkPassword.onfocus=function () {
    checkPasswordTip.innerHTML="请再次输入密码";
    checkPasswordTip.className='tips show ';
};
checkPassword.onblur=function (){
    if(checkPassword.value===''){
        checkPasswordTip.className='tips show login_Error';
        checkPasswordTip.innerHTML="密码不为空";

    }else  if(checkPassword.validity.patternMismatch){
        checkPasswordTip.className='tips show login_Error';
        checkPasswordTip.innerHTML='密码格式错误';
    }
    else  if(password.value != checkPassword.value){
        checkPasswordTip.className='tips show login_Error';
        checkPasswordTip.innerHTML="两次输入密码不一样";
    }
    else{
        checkPasswordTip.className='tips show login_Success';
        checkPasswordTip.innerHTML='两次一样';
        //flag3=1;
    }
};
//TODO:邮箱验证
var email=document.getElementById("email");
var emailTip=document.getElementById('emailTip');
email.onfocus=function () {
    emailTip.innerHTML='请输入正确的Email格式';
    emailTip.className='tips show';
};
email.onblur=function () {
    if(email.validity.valid){
        emailTip.className='tips show login_Success';
        emailTip.innerHTML='格式正确';
        //flag4=1;
    }
    else  if(email.validity.valueMissing){
        emailTip.className='tips show login_Error';
        emailTip.innerHTML='邮箱不能为空';
    }else  if(email.validity.typeMismatch){
        emailTip.className='tips show login_Error';
        emailTip.innerHTML='邮箱格式错误';
    }
};
//TODO:QQ验证

var qq=document.getElementById("qq");
var qqTip=document.getElementById('qqTip');
qq.onfocus=function () {
    qqTip.innerHTML='请输入正确的qq格式';
    qqTip.className='tips show';
};
qq.onblur=function () {
    if(qq.validity.valid){
        qqTip.className='tips show login_Success';
        qqTip.innerHTML='格式正确';

    }
    else  if(qq.validity.valueMissing){
        qqTip.className='tips show login_Error';
        qqTip.innerHTML='qq不能为空';
    }else  if(qq.validity.typeMismatch){
        qqTip.className='tips show login_Error';
        qqTip.innerHTML='qq格式错误';
    }
};

//TODO:验证码(不在前端验证了)
// var aft_Chk=document.getElementById('aft_Chk');
// $.idcode.setCode();   //加载生成验证码方法
// $("#chkCode").blur(function(){
//     var IsBy = $.idcode.validateCode() ; //调用返回值，返回值结果为true或者false
//     if(IsBy){
//         aft_Chk.innerHTML='输入验证码正确';
//         aft_Chk.className='login_Success_Code';
//         console.log("验证码输入正确");
//
//         $('#tip_img').removeClass('wrong');
//         $('#tip_img').addClass("right");
//     }else {
//         aft_Chk.innerHTML='请重新输入';
//         aft_Chk.className='login_Error_Code';
//         console.log("请重新输入");
//         $('#tip_img').removeClass('right');
//         $('#tip_img').addClass('wrong');
//     }
// });
//
// $('a').click(function (e) {
//     e.preventDefault();
// });
