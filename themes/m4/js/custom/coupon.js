$(function () {

    var domForm = $("#coupon-form"), // form - html dom object.;
            btnSubmit = $("#btnSubmit");
    // 手机号码验证
    $.validator.addMethod("isMobile", function (value, element) {
        var length = value.length;
        var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
        return this.optional(element) || (length == 11 && mobile.test(value));
    }, "请填写正确的手机号码");

    btnSubmit.click(function () {
        domForm.submit();
    });
    //登陆页面表单验证模块
    var validator = domForm.validate({
        //focusInvalid: true,
        rules: {
            'WxCouponForm[mobile]': {
                required: true,
                isMobile: true
            },
            'WxCouponForm[verify_code]': {
                required: true,
                digits: true,
                maxlength: 6,
                minlength: 6
            },
            'WxCouponForm[coupon_code]': {
                required: true,
                max: 9999,
                min: 1000
            }
        },
        messages: {
            'WxCouponForm[mobile]': {
                required: "请输入手机号码",
                isMobile: '请输入正确的中国手机号码!'
            },
            'WxCouponForm[verify_code]': {
                required: "请输入短信验证码",
                digits: "请输入正确的短信验证码",
                maxlength: "请输入正确的短信验证码",
                minlength: "请输入正确的短信验证码"
            },
            'WxCouponForm[coupon_code]': {
                required: "请输入劵码",
                min: "请输入四位劵码",
                max: "请输入四位劵码"
            }
        },
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            element.parents('li').find("div.error").remove();
            element.parents('li').find("div.errorMessage").remove();
            error.appendTo(element.parents('li'));                        //这里的element是录入数据的对象  
        },
        submitHandler: function () {
            //disabledBtnAndriod(btnSubmit);
            //form插件的异步无刷新提交
            var actionUrl = domForm.attr('action');
            var formdata = domForm.serializeArray();
            console.log(formdata);
            domForm.ajaxSubmit({
                type: 'post',
                url: actionUrl,
                data: formdata,
                success: function (data) {
                    console.log(data);
                    if (data.status == 'ok') {
                        location.href = uploadReturnUrl;
                        enableBtn(btnSubmit);
                    } else {
                        domForm.find("div.error").remove();
                        //append errorMsg
                        isfocus = true;
                        for (error in data.errors) {
                            errerMsg = data.errors[error];
                            inputKey = '#booking_' + error;
                            $(inputKey).focus();
                            $(inputKey).parent().after("<div class='error'>" + errerMsg + "</div> ");
                        }
                        enableBtn(btnSubmit);
                    }
                },
                error: function (XmlHttpRequest, textStatus, errorThrown) {

                },
                complete: function () {

                }
            });
        }
    });

});

