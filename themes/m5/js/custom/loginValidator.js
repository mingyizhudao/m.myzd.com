$(function () {

    var domSmsForm = $("#smsLogin-form"), // form - html dom object.;
            urlCheckCode = domSmsForm.attr('data-checkCode'),
            btnSmsSubmit = $("#btnSmsSubmit");
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

    btnSmsSubmit.click(function () {
        var bool = validatorSms.form();
        //check验证码
        if (bool) {
            var captchaCode = $('#UserDoctorMobileLoginForm_captcha_code').val();
            domSmsForm.ajaxSubmit({
                url: urlCheckCode + '?co_code=' + captchaCode,
                success: function (data) {
                    //console.log(data);
                    if (data.status == 'ok') {
                        formAjaxSmsSubmit();
                    } else {
                        $('#UserDoctorMobileLoginForm_captcha_code-error').remove();
                        $('#captchaCode').parents('div.input').append('<div id="UserDoctorMobileLoginForm_captcha_code-error" class="error">' + data.error + '</div>');
                        $('#UserDoctorMobileLoginForm_captcha_code').focus();
                    }
                }
            });
        }

    });
    //登陆页面表单验证模块
    var validatorSms = domSmsForm.validate({
        //focusInvalid: true,
        rules: {
            'UserDoctorMobileLoginForm[username]': {
                required: true,
                isMobile: true
            },
            'UserDoctorMobileLoginForm[captcha_code]': {
                required: true
            },
            'UserDoctorMobileLoginForm[verify_code]': {
                required: true,
                digits: true,
                maxlength: 6,
                minlength: 6
            }
        },
        messages: {
            'UserDoctorMobileLoginForm[username]': {
                required: "请输入手机号码",
                isMobile: '请输入正确的中国手机号码!'
            },
            'UserDoctorMobileLoginForm[captcha_code]': {
                required: "请输入图形验证码"
            },
            'UserDoctorMobileLoginForm[verify_code]': {
                required: "请输入短信验证码",
                digits: "请输入正确的短信验证码",
                maxlength: "请输入正确的短信验证码",
                minlength: "请输入正确的短信验证码"
            }
        },
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            element.parents('div.input').find("div.error").remove();
            element.parents('div.input').find("div.errorMessage").remove();
            error.appendTo(element.parents('div.input'));                        //这里的element是录入数据的对象  
        }
    });

    function formAjaxSmsSubmit() {
        disabledBtn(btnSmsSubmit);
        //form插件的异步无刷新提交
        var actionUrl = domSmsForm.attr('data-actionUrl');
        var returnUrl = domSmsForm.attr("data-returnUrl");
        var formdata = domSmsForm.serializeArray();
        var dataArray = structure_formdata('UserDoctorMobileLoginForm', formdata);
        var encryptContext = do_encrypt(dataArray, pubkey);
        var param = {param: encryptContext};
        $.ajax({
            type: 'post',
            url: actionUrl,
            data: param,
            success: function (data) {
                console.log(data);
                if (data.status == 'ok') {
                    enableBtn(btnSmsSubmit);
                    location.href = returnUrl;
                } else {
                    domSmsForm.find("div.error").remove();
                    //append errorMsg
                    for (error in data.errors) {
                        errerMsg = data.errors[error];
                        inputKey = '#UserDoctorMobileLoginForm_' + error;
                        console.log(inputKey);
                        $(inputKey).focus();
                        $(inputKey).parents('div.input').append("<div class='error'>" + errerMsg + "</div> ");
                    }
                    enableBtn(btnSmsSubmit);
                }
            },
            error: function (XmlHttpRequest, textStatus, errorThrown) {
                enableBtn(btnSmsSubmit);
                console.log(XmlHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            },
            complete: function () {
            }
        });
    }

    var domPawForm = $("#pawLogin-form"),
            btnPawSubmit = $("#btnPawSubmit");
    btnPawSubmit.click(function () {
        var bool = validatorPaw.form();
        //check验证码
        if (bool) {
            formAjaxPawSubmit();
        }

    });
    //登陆页面表单验证模块
    var validatorPaw = domPawForm.validate({
        //focusInvalid: true,
        rules: {
            'UserLoginForm[username]': {
                required: true,
                isMobile: true
            },
            'UserLoginForm[password]': {
                required: true,
                isPassword: true,
                minlength: 4
            }
        },
        messages: {
            'UserLoginForm[username]': {
                required: "请输入手机号码",
                isMobile: '请输入正确的中国手机号码!'
            },
            'UserLoginForm[password]': {
                required: "请输入密码",
                minlength: "密码至少4位"
            }
        },
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            element.parents('div.input').find("div.error").remove();
            element.parents('div.input').find("div.errorMessage").remove();
            error.appendTo(element.parents('div.input'));                        //这里的element是录入数据的对象  
        }
    });

    function formAjaxPawSubmit() {
        disabledBtn(btnPawSubmit);
        //form插件的异步无刷新提交
        var actionUrl = domPawForm.attr('data-actionUrl');
        var returnUrl = domPawForm.attr("data-returnUrl");
        var formdata = domPawForm.serializeArray();
        var dataArray = structure_formdata('UserLoginForm', formdata);
        var encryptContext = do_encrypt(dataArray, pubkey);
        var param = {param: encryptContext};
        $.ajax({
            type: 'post',
            url: actionUrl,
            data: param,
            success: function (data) {
                console.log(data);
                if (data.status == 'ok') {
                    enableBtn(btnPawSubmit);
                    location.href = returnUrl;
                } else {
                    domPawForm.find("div.error").remove();
                    //append errorMsg
                    for (error in data.errors) {
                        errerMsg = data.errors[error];
                        inputKey = '#UserLoginForm_' + error;
                        $(inputKey).focus();
                        $(inputKey).parents('div.input').append("<div class='error'>" + errerMsg + "</div> ");
                    }
                    enableBtn(btnPawSubmit);
                }
            },
            error: function (XmlHttpRequest, textStatus, errorThrown) {
                enableBtn(btnPawSubmit);
                console.log(XmlHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            },
            complete: function () {
            }
        });
    }


});