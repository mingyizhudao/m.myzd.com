$(function () {

    var domForm = $("#forgetPassword-form"), // form - html dom object.;
            urlCheckCode = domForm.attr('data-checkCode'),
            btnSubmit = $("#btnSubmit");
    // 手机号码验证
    $.validator.addMethod("isMobile", function (value, element) {
        var length = value.length;
        var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
        return this.optional(element) || (length == 11 && mobile.test(value));
    }, "请填写正确的手机号码");
    //密码验证
    $.validator.addMethod("isPassword", function (value, element) {
        var length = value.length;
        var mobile = /^[a-zA-Z0-9_]+$/;
        return this.optional(element) || (mobile.test(value));
    }, "请填写字母、数字或下划线");

    btnSubmit.click(function () {
        var bool = validator.form();
        //check验证码
        if (bool) {
            var captchaCode = $('#ForgetPasswordForm_captcha_code').val();
            domForm.ajaxSubmit({
                url: urlCheckCode + '?co_code=' + captchaCode,
                success: function (data) {
                    //console.log(data);
                    if (data.status == 'ok') {
                        formAjaxSubmit();
                    } else {
                        $('#ForgetPasswordForm_captcha_code-error').remove();
                        $('#captchaCode').parents('div.input').append('<div id="ForgetPasswordForm_captcha_code-error" class="error">' + data.error + '</div>');
                        $('#ForgetPasswordForm_captcha_code').focus();
                    }
                }
            });
        }

    });
    //登陆页面表单验证模块
    var validator = domForm.validate({
        //focusInvalid: true,
        rules: {
            'ForgetPasswordForm[username]': {
                required: true,
                isMobile: true
            },
            'ForgetPasswordForm[captcha_code]': {
                required: true
            },
            'ForgetPasswordForm[verify_code]': {
                required: true,
                digits: true,
                maxlength: 6,
                minlength: 6
            },
            'ForgetPasswordForm[password_new]': {
                required: true,
                isPassword: true,
                minlength: 4
            }
        },
        messages: {
            'ForgetPasswordForm[username]': {
                required: "请输入手机号码",
                isMobile: '请输入正确的中国手机号码!'
            },
            'ForgetPasswordForm[captcha_code]': {
                required: "请输入图形验证码"
            },
            'ForgetPasswordForm[verify_code]': {
                required: "请输入短信验证码",
                digits: "请输入正确的短信验证码",
                maxlength: "请输入正确的短信验证码",
                minlength: "请输入正确的短信验证码"
            },
            'ForgetPasswordForm[password_new]': {
                required: "请输入新密码",
                minlength: "新密码至少4位"
            }
        },
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            element.parents('div.input').find("div.error").remove();
            element.parents('div.input').find("div.errorMessage").remove();
            error.appendTo(element.parents('div.input'));                        //这里的element是录入数据的对象  
        }
    });

    function formAjaxSubmit() {
        disabledBtn(btnSubmit);
        //form插件的异步无刷新提交
        var actionUrl = domForm.attr('data-actionurl');
        var returnUrl = domForm.attr("data-returnUrl");
        var formdata = domForm.serializeArray();
        var dataArray = structure_formdata('ForgetPasswordForm', formdata);
        var encryptContext = do_encrypt(dataArray, pubkey);
        var param = {param: encryptContext};
        $.ajax({
            type: 'post',
            url: actionUrl,
            data: param,
            success: function (data) {
                //console.log(data);
                //图片上传
                if (data.status == 'ok') {
                    enableBtn(btnSubmit);
                    location.href = returnUrl;
                } else {
                    domForm.find("div.error").remove();
                    //append errorMsg
                    isfocus = true;
                    for (error in data.errors) {
                        errerMsg = data.errors[error];
                        inputKey = '#ForgetPasswordForm_' + error;
                        $(inputKey).focus();
                        $(inputKey).parents('div.input').append("<div class='error'>" + errerMsg + "</div> ");
                    }
                    enableBtn(btnSubmit);
                }
            },
            error: function (XmlHttpRequest, textStatus, errorThrown) {
                enableBtn(btnSubmit);
                console.log(XmlHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            },
            complete: function () {
            }
        });
    }

});

