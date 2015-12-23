$(function () {
    //图片上传板块
    var domForm = $("#booking-form"),
            btnSubmit = $("#btnSubmit"),
            urlReturn = domForm.attr("data-url-return"),
            urlUploadFile = domForm.attr("data-url-uploadFile");

    btnSubmit.click(function () {
        var bool = validator.form();
        if (bool) {
            formAjaxSubmit();
        }
    });
//表单验证板块
    var validator = domForm.validate({
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
//        errorLabelContainer: $("#booking-form div .error"),
//        wrapper: "div",
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            element.parents(".ui-field-contain").find("div.error").remove();
            error.appendTo(element.parents(".ui-field-contain"));     //这里的element是录入数据的对象  
        }
    });

    function formAjaxSubmit() {
        disabledBtnAndriod(btnSubmit);
        //form插件的异步无刷新提交
        actionUrl = domForm.attr('data-actionUrl');
        //returnUrl = domForm.attr("data-url-return");
        var formdata = domForm.serializeArray();
        $.ajax({
            type: 'post',
            url: actionUrl,
            data: formdata,
            success: function (data) {
                //图片上传
                if (data.status == 'ok') {
                    var inputCount = $(".MultiFile-applied").length - 1;
                    if (inputCount == 0) {
                        location.href = urlReturn + '?refNo=' + data.salesOrderRefNo;
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

            }
        });
    }

    //异步上传病历
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