jQuery(function () {
    jQuery.validator.addMethod("isMobile", function (value, element) {
        var length = value.length;
        var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
        return this.optional(element) || (length == 11 && mobile.test(value));
    }, "请填写正确的手机号码");
    var domForm = $("#booking-form"),
            urlUploadFile = domForm.attr("data-url-uploadFile"),
            urlReturn = domForm.attr("data-url-return"),
            btnSubmit = $("#btnSubmit");
    btnSubmit.click(function () {
        var urlCheckCode = domForm.attr('data-checkCode');
        var formdata = domForm.serializeArray();
        var bool = validator.form();
        if (bool) {
            if ($('#checkUser').attr('value') == 1) {
                formAjaxSubmit();
            } else {
                var captchaCode = $('#booking_captcha_code').val();
                $.ajax({
                    type: 'post',
                    url: urlCheckCode + '?co_code=' + captchaCode,
                    data: formdata,
                    success: function (data) {
                        //console.log(data);
                        if (data.status == 'ok') {
                            formAjaxSubmit();
                        } else {
                            $('#booking_captcha_code-error').remove();
                            $('#captchaCode').after('<div id="booking_captcha_code-error" class="error">' + data.error + '</div>');
                            $('#booking_captcha_code').focus();
                        }
                    }
                });
            }
        }
    });
    var validator = domForm.validate({
        rules: {
            'booking[doctor_name]': {
                //  required: true,
                maxlength: 50
            },
            'booking[hospital_name]': {
                //  required: true,
                maxlength: 50
            },
            'booking[hp_dept_name]': {
                //  required: true,
                maxlength: 50
            },
            'booking[contact_name]': {
                required: true,
                maxlength: 50
            },
            'booking[captcha_code]': {
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
            },
            'booking[disease_name]': {
                required: true,
                maxlength: 50
            },
            'booking[disease_detail]': {
                required: true,
                minlength: 10,
                maxlength: 1000
            },
            'booking[remark]': {
                required: true,
                maxlength: 500
            }
        },
        messages: {
            'booking[doctor_name]': {
                //    required: '请填写医生姓名',
                maxlength: '姓名太长'
            },
            'booking[hospital_name]': {
                //    required: '请填写医院名称',
                maxlength: '医院名称太长'
            },
            'booking[hp_dept_name]': {
                //    required: '请填写科室名称',
                maxlength: '科室名称太长'
            },
            'booking[contact_name]': {
                required: '请填写患者姓名',
                maxlength: '患者姓名太长'
            },
            'booking[captcha_code]': {
                required: "请填写图形验证码"
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
            },
            'booking[disease_name]': {
                required: '请填写疾病诊断',
                maxlength: '请将字数控制在50以内'
            },
            'booking[disease_detail]': {
                required: '请填写病情',
                minlength: '请至少填写10个字',
                maxlength: '请将字数控制在1000以内'
            }
        },
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法 
            element.parents(".ui-field-contain").find("div.error").remove();
            error.appendTo(element.parents(".ui-field-contain")); //这里的element是录入数据的对象  
        },
    });
    function formAjaxSubmit() {
        disabledBtnAndriod(btnSubmit);
        //form插件的异步无刷新提交
        actionUrl = domForm.attr('data-actionurl');
        //returnUrl = domForm.attr("data-url-return");
        domForm.ajaxSubmit({
            type: 'post',
            url: actionUrl,
            success: function (data) {
                if (data.status == 'ok') {
                    var inputCount = $(".MultiFile-applied").length - 1;
                    if (inputCount == 0) {
                        location.href = urlReturn + '?refNo=' + data.salesOrderRefNo;
                        enableBtnAndriod(btnSubmit);
                        //$('#success').removeClass('hide');
                    } else {
                        ajaxFileupload(data);
                    }
                } else {
                    domForm.find("div.error").remove();
                    //append errorMsg
                    isfocus = true;
                    for (error in data.errors) {
                        errerMsg = data.errors[error];
                        inputKey = '#booking_' + error;
                        $(inputKey).focus();
                        $(inputKey).after("<div class='error'>" + errerMsg + "</div> ");
                    }
                    enableBtnAndriod(btnSubmit);
                }
            },
            error: function (XmlHttpRequest, textStatus, errorThrown) {
                enableBtnAndriod(btnSubmit);
                console.log(XmlHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            },
            complete: function () {
                //    btnSubmit.button("enable");
            }
        });
    }

    function ajaxFileupload(data) {
        disabledBtnAndriod(btnSubmit);
        $(".MultiFile-applied").attr("name", 'file');
        var successCount = 0, inputCount = 0, backCount = 0;
        inputCount = $(".MultiFile-applied").length - 1;
        var fileParam = {"booking[id]": data.booking.id, 'plugin': 'ajaxFileUpload'};
        $(".MultiFile-applied").each(function () {
            if ($(this).val()) {
                var fileId = $(this).attr("id");
                $.ajaxFileUpload({
                    url: urlUploadFile,
                    secureuri: false, //是否安全提交
                    data: fileParam, //提交时带上的参数
                    fileElementId: fileId, //input file 的id
                    type: 'post',
                    dataType: 'json',
                    success: function (fdata, status) {
                        if (fdata.status == 'ok') {
                            successCount++;
                        }
                    },
                    error: function (fdata, status, e) {
                        //错误处理
                        console.log(fdata);
                        alert('文件过大,上传失败');
                    },
                    complete: function () {
                        backCount++;
                        if (inputCount == backCount) {
                            if (successCount == inputCount) {
                                //alert("恭喜 上传成功!");
                                location.href = urlReturn + '?refNo=' + data.salesOrderRefNo;
                                //$('#success').removeClass('hide');
                            } else {
                                //$失败操作
                            }
                            enableBtnAndriod(btnSubmit);
                        }
                    }
                });
            }
        });
    }
});
