$(function () {
    var domForm = $("#changePwd-form"), // form - html dom object.;
            btnSubmit = $("#btnSubmit"),
            returnUrl = domForm.attr("data-returnUrl");
    // 手机号码验证
    jQuery.validator.addMethod("isMobile", function (value, element) {
        var length = value.length;
        var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
        return this.optional(element) || (length == 11 && mobile.test(value));
    }, "请填写正确的手机号码");

    $("#changePwd-form input").focus(function () {
        inputId = $(this).attr('id');
        error = $(this).parents(".ui-field-contain").find("div.error").text();
        if (error) {
            $(this).parents(".ui-field-contain").find("div.error").remove();
            validator.element("#" + inputId);
        }

    });
    //注册页面表单验证模块
    var validator = domForm.validate({
        //focusInvalid: true,
        rules: {
            'UserPasswordForm[password]': {
                required: true,
                maxlength: 40,
                minlength: 4
            },
            'UserPasswordForm[password_new]': {
                required: true,
                maxlength: 40,
                minlength: 4
            },
            'UserPasswordForm[password_repeat]': {
                required: "请输入登录密码",
                equalTo: "#UserPasswordForm_password_new",
                minlength: 4
            }
        },
        messages: {
            'UserPasswordForm[password]': {
                required: "请输入原密码",
                maxlength: "最长为40个字母或数字",
                minlength: "最短为4个字母或数字"
            },
            'UserPasswordForm[password_new]': {
                required: "请输入新密码",
                maxlength: "最长为40个字母或数字",
                minlength: "最短为4个字母或数字"
            },
            'UserPasswordForm[password_repeat]': {
                required: "请重复新密码",
                equalTo: "密码不一致",
                minlength: "最短为4个字母或数字"
            }
        },
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            element.parents(".ui-field-contain").find("div.error").remove(); //清除错误信息
            error.appendTo(element.parent().next());                        //这里的element是录入数据的对象  
        },
        submitHandler: function () {
            //form插件的异步无刷新提交
            disabledBtn(btnSubmit);
            requestUrl = domForm.attr('action');
            domForm.ajaxSubmit({
                type: 'post',
                url: requestUrl,
                success: function (data) {
                    //success.
                    dataJson = JSON.parse(data);
                    if (dataJson.status == 'true') {
                        window.location.href = returnUrl;
                    } else {
                        //error.
                        enableBtn(btnSubmit);
                        domForm.find("div.error").remove();
                        for (key in dataJson) {
                            emid = "#" + key;
                            errerMsg = dataJson[key];
                            $(emid).parent().after("<div class='error'>" + errerMsg + "</div> ");
                        }
                    }
                },
                error: function () {
                },
                complete: function () {
                    enableBtn(btnSubmit);
                }
            });
        }
    });
});

