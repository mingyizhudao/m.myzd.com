$(function () {

    var domForm = $("#login-form") // form - html dom object.;
    // 手机号码验证
    jQuery.validator.addMethod("isMobile", function (value, element) {
        var length = value.length;
        var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
        return this.optional(element) || (length == 11 && mobile.test(value));
    }, "请填写正确的手机号码");
    
    $("#login-form input").focus(function () {
        inputId = $(this).attr('id');
        error = $(this).parents(".ui-field-contain").find("div.errorMessage").text();
        if (error) {
            $(this).parents(".ui-field-contain").find("div.errorMessage").remove();
            validator.element("#" + inputId);
        }

    });
    //登陆页面表单验证模块
    var validator = $("#login-form").validate({
        //focusInvalid: true,
        rules: {
            'UserLoginForm[username]': {
                required: true,
                isMobile: true
            },
            'UserLoginForm[password]': {
                required: true,
                maxlength: 40,
                minlength: 4
            }
        },
        messages: {
            'UserLoginForm[username]': {
                required: "请输入手机号码",
                isMobile: '请输入正确的中国手机号码!'
            },
            'UserLoginForm[password]': {
                required: "请输入登录密码",
                maxlength: "最长为40个字母或数字",
                minlength: "最短为4个字母或数字"
            }
        },
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            element.parents(".ui-field-contain").find("div.error").remove();//清除错误信息
            element.parents(".ui-field-contain").find("div.errorMessage").text("");//清除错误信息
            error.appendTo(element.parent().next());                        //这里的element是录入数据的对象  
        }
    });
    
});

