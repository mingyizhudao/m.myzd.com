$(function () {
    //手机号码验证
    $.validator.addMethod("isMobile", function (value, element) {
        var length = value.length;
        var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
        return this.optional(element) || (length == 11 && mobile.test(value));
    }, "请填写正确的手机号码");

    var domForm = $('#booking-form'),
            btnSubmit = $("#btnSubmit");

    $('#submitBtn').click(function () {
        var bool = validator.form();
        if (bool) {
            formAjaxSubmit();
        }
    });

    //表单验证板块
    var validator = domForm.validate({
        rules: {
            'booking[id]': {
            },
            'booking[doctor_name]': {
            },
            'booking[hp_dept_name]': {
            },
            'booking[hospital_name]': {
            },
            'booking[contact_name]': {
                required: true
            },
            'booking[mobile]': {
                required: true,
                isMobile: true
            },
            'booking[verify_code]': {
                required: true,
                digits: true,
                maxlength: 6,
                minlength: 6
            }
        },
        messages: {
            'booking[id]': {
            },
            'booking[doctor_name]': {
            },
            'booking[hp_dept_name]': {
            },
            'booking[hospital_name]': {
            },
            'booking[contact_name]': {
                required: '请填写患者姓名',
            },
            'booking[mobile]': {
                required: "请填写手机号码",
                isMobile: '请输入正确的中国手机号码'
            },
            'booking[verify_code]': {
                required: '请输入验证码',
                digits: '验证码不正确',
                maxlength: '验证码不正确',
                minlength: '验证码不正确'
            }
        },
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            element.parents(".ui-field-contain").find("div.error").remove();
            error.appendTo(element.parents(".ui-field-contain"));     //这里的element是录入数据的对象  
        }
    });

    function formAjaxSubmit() {
        disabledBtn(btnSubmit);
        var actionUrl = domForm.attr('data-action-url');
        var returnUrl = domForm.attr('data-return-url');
        var formdata = domForm.serializeArray();
        var dataArray = structure_formdata('booking', formdata);
        var encryptContext = do_encrypt(dataArray, pubkey);
        var param = {param: encryptContext};
        $.ajax({
            type: 'post',
            url: actionUrl,
            data: param,
            success: function (data) {
                console.log(data);
                //图片上传
                if (data.status == 'ok') {

                }
            },
            error: function (XmlHttpRequest, textStatus, errorThrown) {
                enableBtn(btnSubmit);
                console.log(XmlHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }
});