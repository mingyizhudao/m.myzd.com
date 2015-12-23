$(function () {
    // 手机号码验证
    jQuery.validator.addMethod("isMobile", function (value, element) {
        var length = value.length;
        var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
        return this.optional(element) || (length == 11 && mobile.test(value));
    }, "请正确填写您的手机号码");

    //医生认证表单验证板块
    var validator_docform = $("#doctor-form").validate({
        //focusInvalid: true,
        rules: {
            'DoctorForm[fullname]': {
                required: true,
                maxlength: 45
            },
            'DoctorForm[state_id]': {
                required: true
            },
            'DoctorForm[city_id]': {
                required: true
            },
            'DoctorForm[hospital_name]': {
                required: true
            },
            'DoctorForm[faculty]': {
                required: true
            },
            'DoctorForm[medical_title]': {
                required: true
            },
            'DoctorForm[academic_title]': {
                required: true
            },
            'DoctorForm[mobile]': {
                required: true,
                isMobile: true
            },
            'DoctorForm[verify_code]': {
                required: true,
                digits: true,
                maxlength: 6,
                minlength: 6
            },
            'DoctorForm[password]': {
                required: true,
                minlength: 4
            },
            'DoctorForm[password_repeat]': {
                required: true,
                equalTo: "#DoctorForm_password"
            }
        },
        messages: {
            'DoctorForm[fullname]': {
                required: "请填写称呼!",
                maxlength: "请将字数控制在45以内!"
            },
            'DoctorForm[state_id]': {
                required: "请选择省份!"
            },
            'DoctorForm[city_id]': {
                required: "请选择城市!"
            },
            'DoctorForm[hospital_name]': {
                required: "请填写您所在的医院名称!"
            },
            'DoctorForm[faculty]': {
                required: "请填写您所在的科室名称!"
            },
            'DoctorForm[medical_title]': {
                required: "请选择医学职称!"
            },
            'DoctorForm[academic_title]': {
                required: "请选择学术职称!"
            },
            'DoctorForm[mobile]': {
                required: "请填写手机号码!",
                isMobile: '请输入正确的中国手机号码!'
            },
            'DoctorForm[verify_code]': {
                required: '请填写验证码!',
                digits: '验证码只能为6位数字!',
                maxlength: '验证码只能为6位数字!',
                minlength: '验证码只能为6位数字!'
            },
            'DoctorForm[password]': {
                required: '请填写密码!',
                minlength: '密码长度不得小于4!'
            },
            'DoctorForm[password_repeat]': {
                required: '请确认密码!',
                equalTo: '密码不一致!'
            }
        },
//        errorContainer: "div.error",
//        errorLabelContainer: $("#DoctorForm-form div .error"),
//        wrapper: "div",
        errorElement: "span",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            if (error[0].id == 'DoctorForm_state_id-error' || error[0].id == 'DoctorForm_city_id-error' || error[0].id == 'DoctorForm_medical_title-error' || error[0].id == 'DoctorForm_academic_title-error') {
                error.appendTo(element.parent().parent().next());
            } else {
                error.appendTo(element.parent().next());                        //这里的element是录入数据的对象  
            }
        },
        submitHandler: function () {
            //form插件的异步无刷新提交
            actionUrl = $("#doctor-form").attr('data-actionurl');
            $("#doctor-form").ajaxSubmit({
                type: 'post',
                url: actionUrl,
                success: function (data) {
                    fileParam.id = data.DoctorForm.id;
                    console.log(data);
                    //返回正确的跳转页面
                    returnUrl = data.redirectUrl;
                    //图片上传
                    if (data.status == 'ok') {
                        //基本数据插入成功  判断是否有图片
                        if (state == 'ready') {
                            //文件上传 自动跳转
                            uploader.upload();
                        } else {
                            //没有上传文件 表单数据添加成功 页面跳转
                            location.href = returnUrl;
                        }
                    }
                },
                error: function (XmlHttpRequest, textStatus, errorThrown) {
                    console.log(XmlHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }
    });
//点击获取验证码时 启动手机验证
    $("#doctor-form #btn-sendSmsCode").click(function () {
        //单个元素验证 返回boolean值
        var bool = validator_docform.element("#DoctorForm_mobile");
        if (!bool) {
            //验证失败 光标定位
            $("#DoctorForm_mobile").focus();
        }
    });
    //登陆页面表单验证模块
    var validator = $("#login-form").validate({
        //focusInvalid: true,
        rules: {
            'DoctorForm[mobile]': {
                required: true,
                isMobile: true
            },
            'DoctorForm[password]': {
                required: true,
                minlength: 4
            }
        },
        messages: {
            'DoctorForm[mobile]': {
                required: "请填写手机号码!",
                isMobile: '请输入正确的中国手机号码!'},
            'DoctorForm[password]': {
                required: "请填写密码!",
                minlength: '密码最少为4位!'
            }
        },
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            error.appendTo(element.parent().next());                        //这里的element是录入数据的对象  
        }
    });
    //创建患者表单验证板块
    var validator_patientForm = $("#patientForm").validate({
        //focusInvalid: true,
        rules: {
            'PatientForm[fullname]': {
                required: true,
                maxlength: 45
            },
            'PatientForm[state_id]': {
                required: true
            },
            'PatientForm[city_id]': {
                required: true
            },
            'PatientForm[age]': {
                required: true
            },
            'PatientForm[gender]': {
                required: true,
            }
        },
        messages: {
            'PatientForm[fullname]': {
                required: "请填写称呼!",
                maxlength: "请将字数控制在45以内!"
            },
            'PatientForm[state_id]': {
                required: "请选择省份!"
            },
            'PatientForm[city_id]': {
                required: "请选择城市!"
            },
            'PatientForm[age]': {
                required: "请输入患者年龄!"
            },
            'PatientForm[gender]': {
                required: "请选择患者性别!"
            }
        },
//        errorContainer: "div.error",
//        errorLabelContainer: $("#PatientForm-form div .error"),
//        wrapper: "div",
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            if (error[0].id == 'PatientForm_state_id-error' || error[0].id == 'PatientForm_city_id-error') {
                error.appendTo(element.parent().parent().next());
            }
            if (error[0].id == 'PatientForm[gender]-error') {
                error.appendTo(element.parents(".ui-controlgroup-controls").next());
            } else {
                error.appendTo(element.parent().next());                        //这里的element是录入数据的对象  
            }
        }
    });
    //快速预约表单验证板块
    var validator_ContactEnquiryForm = $("#contact-enquiry-form").validate({
        //focusInvalid: true,
        rules: {
            'ContactEnquiryForm[hopital]': {
                required: true,
                maxlength: 45
            },
            'ContactEnquiryForm[faculty]': {
                required: true
            },
            'ContactEnquiryForm[doctor]': {
                required: true
            },
            'ContactEnquiryForm[patientname]': {
                required: true
            },
            'ContactEnquiryForm[mobile]': {
                required: true,
                isMobile: true
            },
            'ContactEnquiryForm[verify_code]': {
                required: true,
                minlength: 6,
                maxlength: 6
            },
            'ContactEnquiryForm[patient_condition]': {
                required: true,
                minlength: 10
            }
        },
        messages: {
            'ContactEnquiryForm[hopital]': {
                required: "请输入医院!",
                maxlength: "请将字数控制在45以内!"
            },
            'ContactEnquiryForm[faculty]': {
                required: "请输入科室!"
            },
            'ContactEnquiryForm[doctor]': {
                required: "请输入医生!"
            },
            'ContactEnquiryForm[patientname]': {
                required: "请输入患者姓名!"
            },
            'ContactEnquiryForm[mobile]': {
                required: "请填写手机号码!",
                isMobile: '请输入正确的中国手机号码!'
            },
            'ContactEnquiryForm[verify_code]': {
                required: "请输入验证码!",
                minlength: "验证码错误!",
                maxlength: "验证码错误!"
            },
            'ContactEnquiryForm[patient_condition]': {
                required: "请输入病情描述!",
                minlength: "病情描述最少10个字!"
            }
        },
//        errorContainer: "div.error",
//        errorLabelContainer: $("#ContactEnquiryForm-form div .error"),
//        wrapper: "div",
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  

            error.appendTo(element.parent().next());                        //这里的element是录入数据的对象  
        }
    });
    //点击获取验证码时 启动手机验证
    $("#contact-enquiry-form #btn-sendSmsCode").click(function () {
        //单个元素验证 返回boolean值
        var bool = validator_ContactEnquiryForm.element("#ContactEnquiryForm_mobile");
        if (!bool) {
            //验证失败 光标定位
            $("#ContactEnquiryForm_mobile").focus();
        }
    });
});

