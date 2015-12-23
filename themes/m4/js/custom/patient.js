$(function () {

    var domForm = $("#booking-form"), // form - html dom object.
            btnSubmit = $("#btnSubmit"),
            returnUrl = domForm.attr("data-url-return");

    btnSubmit.click(function () {
        var bool = validator_patient.form();
        if (bool) {
            formAjaxSubmit();
        }
    });
    //医生认证表单验证板块
    var validator_patient = domForm.validate({
        //focusInvalid: true,
        rules: {
            'booking[contact_name]': {
                required: true
            },
            'booking[date_start]': {
                required: true
            },
            'booking[date_end]': {
                required: true
            },
            'booking[disease_name]': {
                required: true,
                maxlength: 50
            },
            'booking[disease_detail]': {
                required: true,
                maxlength: 1000
            }
        },
        messages: {
            'booking[contact_name]': {
                required: "请填写真实姓名",
                maxlength: "请将字数控制在45以内"
            },
            'booking[date_start]': {
                required: '请选择开始日期'
            },
            'booking[date_end]': {
                required: '请选择截止日期'
            },
            'booking[disease_name]': {
                required: '请填写疾病名称'
            },
            'booking[disease_detail]': {
                required: '请填写疾病描述'
            }
        },
//        errorContainer: "div.error",
//        errorLabelContainer: $("#DoctorForm-form div .error"),
//        wrapper: "div",
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            error.appendTo(element.parent());                        //这里的element是录入数据的对象  
        }
    });
    //disabledBtn
//    function disabledBtn(btnSubmit) {
//        $(".ui-loader").show();
//        btnSubmit.attr("disabled", true);
//        //btnSubmit.button('disable');
//    }
    //enableBtn
//    function enableBtn(btnSubmit) {
//        $(".ui-loader").hide();
//        btnSubmit.attr("disabled", false);
//        //btnSubmit.button('enable');
//    }
    function formAjaxSubmit() {
        //form插件的异步无刷新提交
        //disabledBtn(btnSubmit);
        requestUrl = domForm.attr('data-actionUrl');
        //alert(requestUrl);
        var formdata = domForm.serialize();
        //var formdata='booking[username]=13916681596&booking[token]=A1851959F4716D067128D220FCBDA0C8&booking[mobile]=13955556666&booking[contact_name]=患者名字&booking[disease_pid]=123456789123456789&booking[expteam_id]=1&booking[disease_name]=疾病名&booking[disease_detail]=疾病详情&booking[date_start]=2015-10-15&booking[date_end]=2015-10-18';
        //alert(formdata);
        $.ajax({
            type: 'post',
            url: requestUrl,
            data: formdata,
            success: function (data) {
                console.log(data);
                //alert(5);
                //success.
                if (data.status == 'ok') {
                    returnUrl += '?id=' + data.booking.id;
                    //alert(data.booking.id);
                    //return;
                    window.location.href = returnUrl;
                } else {
                    domForm.find("div.error").remove();
                    for (error in data.errors) {
                        errerMsg = data.errors[error];
                        inputKey = '#patient_' + error;
                        $(inputKey).focus();
                        $(inputKey).parent().after("<div class='error'>" + errerMsg + "</div> ");
                    }
                    //enableBtn(btnSubmit);
                    //error.
                }
            },
            error: function (XmlHttpRequest, textStatus, errorThrown) {
                //enableBtn(btnSubmit);
                console.log(XmlHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            },
            complete: function () {
                //enableBtn(btnSubmit);
            }
        });
    }
});

