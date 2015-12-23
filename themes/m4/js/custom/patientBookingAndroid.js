$(function () {
    //图片上传板块
    var domForm = $("#booking-form"),
            btnSubmit = $("#btnSubmit"),
            urlUploadFile = domForm.attr("data-url-uploadFile"),
            urlReturn = domForm.attr('data-url-return');

    $('#btn-addfiles').click(function () {
        $('#imgbtn').removeClass('hide');
    });

    btnSubmit.click(function () {
        var id = $('#booking_id').attr('value');
        ajaxFileupload(id);
    });

    //异步上传病历
    function ajaxFileupload(id) {
        disabledBtn(btnSubmit);
        $(".MultiFile-applied").attr("name", 'file');
        var successCount = 0, inputCount = 0, backCount = 0;
        inputCount = $(".MultiFile-applied").length - 1;
        var fileParam = {"booking[id]": id, 'plugin': 'ajaxFileUpload'};
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
                    error: function (XMLHttpRequest, fdata, status, e) {
                        //错误处理
                        console.log(fdata);
                        alert('文件过大,上传失败');
                    },
                    complete: function () {
                        backCount++;
                        if (inputCount == backCount) {
                            if (successCount == inputCount) {
                                //alert("恭喜 上传成功!");
                                //location.href = urlReturn + '?refNo=' + data.salesOrderRefNo;
                                location.href = urlReturn;
                            } else {
                                //$失败操作
                            }
                            enableBtn(btnSubmit);
                        }
                    }
                });
            }
        });
    }
});