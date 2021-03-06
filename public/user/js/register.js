/**
 * 注册表单验证
 * Created by Administrator on 2017/5/18.
 */
var $phone = $("#phone");//手机号
var $code = $("#register_code_ipt");//验证码
var $registerGetCode = $("#test");//获取验证码按钮
var $password = $("#password");//密码
var $inviteCode = $("#invite_Code");//邀请码
var url_send = "http://business.api.shahaizi.shop";
var $submit = $("#reg_sub");//注册
var countdown = 60;
var codeParams = {mobile: '',opt:'reg2',"country_code":""};
var postCodeParams={username: '',type:'reg',code:''};
var registerParams = {
    user_name : '',
    code: '',
    password : '',
    type:1
};
$(function(){
    $registerGetCode.click(checkCodeForm);//点击获取验证码
    $submit.click(checkCodeForm1);//点击注册
});


/**
 * 验证码 表单验证
 */
function checkCodeForm(e) {
    var tel = $phone.val();
    var code_select = $(".code_select").val();
    var reg = /^1(3|4|5|7|8)\d{9}$/;
    if(!reg.test(tel)){
        layer.msg("请输入正确手机号",{"icon":1,time:1000});
        return false;
    }else{
        $phone.attr("readonly","readonly");
        codeParams.mobile = tel;
        codeParams.country_code = code_select;
        console.log(codeParams);
        toCode(e.target)
    }
}
/**
 * 获取验证码
 */
function toCode(eve) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: url_send + "/index.php?m=Api&c=Sms&a=send",
        data: codeParams
    }).done(function (res) {
        if (res.status == 1) {
            settime(eve);
            layer.msg("发送成功",{"icon":1,time:1000});
            return false;
        }else{
            layer.msg(res.msg,{"icon":2,time:1000});
            $phone.removeAttr("readonly");
            return false;
        }
    })

}

/**
 * 表单验证注册
 */
function checkCodeForm1() {
    var user_name = $phone.val();
    var reg = /^1(3|4|5|7|8)\d{9}$/;
    if(!reg.test(user_name)){
        layer.msg("请输入正确的手机号",{"icon":1,time:1000});
        return false;
    }
    var code = $code.val();
    if (code.length=="0") {
        layer.msg("请输入验证码",{"icon":1,time:1000});
        return false;
    }
    var password = $password.val();
    if (password.length == 0) {
        layer.msg("请输入密码",{"icon":1,time:1000});
        return false;
    }
    if (password.length < 6 || password.length > 16) {
        layer.msg("密码长度应为6-16位",{"icon":1,time:1000});
        return false;
    }

    registerParams.user_name=user_name;
    registerParams.code=code;
    registerParams.password=password;
    postCode();
    // toRegister();
    return true;
}
/**
 * 注册
 */
function toRegister() {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: API_Register,
        data: registerParams
    }).done(function (res) {
        if (res.status == 1) {
            $(".bomb_box").show();
            location.href="index.html";//待修改
            return false;
        }
        alert(res.msg);
        return false;
    });
    return false;
}
/**
 * 验证验证码
 */
function postCode() {
    var mobile = $phone.val();
    var code = $code.val();
    var code_select = $(".code_select").val();
    var apply_code = $("#apply_code").val();
    var password = $password.val();
    postCodeParams.country_code = code_select;
    postCodeParams.username=mobile;
    postCodeParams.code=code;
    postCodeParams.apply_code=apply_code;
    postCodeParams.password=password;
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/index.php?m=Api&c=User&a=reg2',
        data: postCodeParams
    }).done(function (res) {
        if (res.status == 1) {
            $(".bomb_box").show();
            // toRegister();
            // location.href = url_send + "/index.php/api/user/reg_success"
            return false;
        }else{
            layer.msg("验证码错误",{"icon":2,time:1000});
            return false;
        }

    });
}
/**
 * 倒计时
 */
function settime(val) {
    var tel =$("#phone").val();
    var reg = /^1(3|4|5|7|8)\d{9}$/;
    if(!reg.test(tel)){
        return;
    }else{
        if (countdown == 0) {
            $phone.removeAttr("readonly");
            val.removeAttribute("disabled");
            val.value="获取验证码";
            countdown = 60;
            return;
        } else {
            val.setAttribute("disabled", true);
            val.value="重新发送(" + countdown + ")";
            countdown--;
        }
        setTimeout(function() {
            settime(val);
        },1000)
    }
}
