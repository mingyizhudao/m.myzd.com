/*global Qiniu */
/*global plupload */
/*global FileProgress */
/*global hljs */


$(function () {
    var num = 0;
    var domForm = $('#booking-form'),
            btnSubmit = $('#btnSubmit'),
            urlReturn = domForm.attr('data-url-return'),
            returnResult = true;
    var uploader = Qiniu.uploader({
        runtimes: 'html5,flash,html4',
        browse_button: 'pickfiles',
        container: 'container',
        drop_element: 'container',
        max_file_size: '1000mb',
        flash_swf_url: 'bower_components/plupload/js/Moxie.swf',
        dragdrop: true,
        chunk_size: '4mb',
        uptoken_url: $('#uptoken_url').val(),
        domain: $('#domain').val(),
        get_new_uptoken: false,
        // downtoken_url: '/downtoken',
        // unique_names: true,
        // save_key: true,
        // x_vars: {
        //     'id': '1234',
        //     'time': function(up, file) {
        //         var time = (new Date()).getTime();
        //         // do something with 'time'
        //         return time;
        //     },
        // },
        auto_start: false,
        log_level: 5,
        init: {
            'FilesAdded': function (up, files) {

                for (var i = 0; i < files.length; i++) {
                    var uploadFile = true;
                    if (($('.progressContainer').length) >= 9) {
                        $('#jingle_toast').find('a').text('影像资料不能超过9张');
                        $('#jingle_toast').show();
                        setTimeout(function () {
                            $('#jingle_toast').hide();
                        }, 1000);
                        uploadFile = false;
                    }
                    $('.progressName').each(function () {
                        if (($(this).html() == files[i].name) && ($(this).next('.progressFileSize').html() == plupload.formatSize(files[i].size).toUpperCase())) {
                            $('#jingle_toast').find('a').text('该文件已被选择');
                            $('#jingle_toast').show();
                            setTimeout(function () {
                                $('#jingle_toast').hide();
                            }, 1000);
                            uploadFile = false;
                        }
                    });
                    if (uploadFile) {
                        $('#pickfiles').find('span').text('继续添加');
                        $('table').show();
                        $('#success').hide();
                        plupload.each(files, function (file) {
                            var progress = new FileProgress(file, 'fsUploadProgress');
                            progress.setStatus("等待...");
                            progress.bindUploadCancel(up);
                        });
                    }
                }
            },
            'BeforeUpload': function (up, file) {
                var progress = new FileProgress(file, 'fsUploadProgress');
                var chunk_size = plupload.parseSize(this.getOption('chunk_size'));
                if (up.runtime === 'html5' && chunk_size) {
                    progress.setChunkProgess(chunk_size);
                }
            },
            'UploadProgress': function (up, file) {
                var progress = new FileProgress(file, 'fsUploadProgress');
                var chunk_size = plupload.parseSize(this.getOption('chunk_size'));
                progress.setProgress(file.percent + "%", file.speed, chunk_size);
            },
            'UploadComplete': function () {
                location.href = urlReturn + '?refNo=' + $('#salesOrderRefNo').val();
                enableBtnAndriod(btnSubmit);
            },
            'FileUploaded': function (up, file, info) {
                //单个文件上传成功所做的事情 
                // 其中 info 是文件上传成功后，服务端返回的json，形式如
                // {
                //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                //    "key": "gogopher.jpg"
                //  }
                // 参考http://developer.qiniu.com/docs/v6/api/overview/up/response/simple-response.html
                // var domain = up.getOption('domain');
                // var res = parseJSON(info);
                // var sourceLink = domain + res.key; 获取上传成功后的文件的Url

                var progress = new FileProgress(file, 'fsUploadProgress');
                var infoJson = eval('(' + info + ')');
                progress.setComplete(up, info);
                var formdata = new FormData();
                var fileExtension = file.name.substring(file.name.lastIndexOf('.') + 1);
                formdata.append('booking[booking_id]', domForm.find('#booking_id').val());
                formdata.append('booking[file_name]', file.name);
                formdata.append('booking[file_url]', file.name);
                formdata.append('booking[file_size]', file.size);
                formdata.append('booking[mime_type]', file.type);
                formdata.append('booking[file_ext]', fileExtension);
                formdata.append('booking[remote_domain]', domForm.find('#domain').val());
                formdata.append('booking[remote_file_key]', infoJson.key);
                $.ajax({
                    url: domForm.attr('data-url-uploadfile'),
                    data: formdata,
                    type: 'post',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 'ok') {
                        } else {
                            returnResult = false;
                        }
                    },
                    error: function (data) {
                        returnResult = false;
                    }
                });
            },
            'Error': function (up, err, errTip) {
                returnResult = false;
                console.log('错误信息' + errTip);
                $('table').show();
                var progress = new FileProgress(err.file, 'fsUploadProgress');
                progress.setError();
                progress.setStatus(errTip);
            }
            ,
            'Key': function (up, file) {
                var fileExtension = file.name.substring(file.name.lastIndexOf('.') + 1);
                var key = (new Date()).getTime() + '' + Math.floor(Math.random() * 100) + '.' + fileExtension;
                // do something with key
                return key;
            }
        }
    });

    uploader.bind('FileUploaded', function () {
        //console.log('hello man,a file is uploaded');
    });



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
                maxlength: "请将字数控制在50以内"
            },
            'booking[date_start]': {
                required: '请选择开始日期'
            },
            'booking[date_end]': {
                required: '请选择截止日期'
            },
            'booking[disease_name]': {
                required: '请填写疾病名称',
                maxlength: '病情太长（最多50个字）'
            },
            'booking[disease_detail]': {
                required: '请填写疾病描述',
                maxlength: '病情太长（最多1000个字）',
                minlength: '病情太短（最少10个字）'
            }
        },
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            element.parents(".ui-field-contain").find("div.error").remove();
            error.appendTo(element.parents(".ui-field-contain"));     //这里的element是录入数据的对象  
        }
    });

    function formAjaxSubmit() {
        disabledBtnAndriod(btnSubmit);
        //form插件的异步无刷新提交
        var actionUrl = domForm.attr('data-actionUrl');
        var formdata = domForm.serializeArray();
        $.ajax({
            type: 'post',
            url: actionUrl,
            data: formdata,
            success: function (data) {
                //图片上传
                if (data.status == 'ok') {
                    $('#booking_id').val(data.booking.id);
                    $('#salesOrderRefNo').val(data.salesOrderRefNo);
                    if ($('#fsUploadProgress').find('tr').length = 0) {
                        location.href = urlReturn + '?refNo=' + data.salesOrderRefNo;
                    } else {
                        uploader.start();
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

    $('#container').on(
            'dragenter',
            function (e) {
                e.preventDefault();
                $('#container').addClass('draging');
                e.stopPropagation();
            }
    ).on('drop', function (e) {
        e.preventDefault();
        $('#container').removeClass('draging');
        e.stopPropagation();
    }).on('dragleave', function (e) {
        e.preventDefault();
        $('#container').removeClass('draging');
        e.stopPropagation();
    }).on('dragover', function (e) {
        e.preventDefault();
        $('#container').addClass('draging');
        e.stopPropagation();
    });



    $('#show_code').on('click', function () {
        $('#myModal-code').modal();
        $('pre code').each(function (i, e) {
            hljs.highlightBlock(e);
        });
    });


    $('body').on('click', 'table button.btn', function () {
        $(this).parents('tr').next().toggle();
    });


    $('#up_load').on('click', function () {
        uploader.start();
    });


    var getRotate = function (url) {
        if (!url) {
            return 0;
        }
        var arr = url.split('/');
        for (var i = 0, len = arr.length; i < len; i++) {
            if (arr[i] === 'rotate') {
                return parseInt(arr[i + 1], 10);
            }
        }
        return 0;
    };

    $('#myModal-img .modal-body-footer').find('a').on('click', function () {
        var img = $('#myModal-img').find('.modal-body img');
        var key = img.data('key');
        var oldUrl = img.attr('src');
        var originHeight = parseInt(img.data('h'), 10);
        var fopArr = [];
        var rotate = getRotate(oldUrl);
        if (!$(this).hasClass('no-disable-click')) {
            $(this).addClass('disabled').siblings().removeClass('disabled');
            if ($(this).data('imagemogr') !== 'no-rotate') {
                fopArr.push({
                    'fop': 'imageMogr2',
                    'auto-orient': true,
                    'strip': true,
                    'rotate': rotate,
                    'format': 'png'
                });
            }
        } else {
            $(this).siblings().removeClass('disabled');
            var imageMogr = $(this).data('imagemogr');
            if (imageMogr === 'left') {
                rotate = rotate - 90 < 0 ? rotate + 270 : rotate - 90;
            } else if (imageMogr === 'right') {
                rotate = rotate + 90 > 360 ? rotate - 270 : rotate + 90;
            }
            fopArr.push({
                'fop': 'imageMogr2',
                'auto-orient': true,
                'strip': true,
                'rotate': rotate,
                'format': 'png'
            });
        }

        $('#myModal-img .modal-body-footer').find('a.disabled').each(function () {

            var watermark = $(this).data('watermark');
            var imageView = $(this).data('imageview');
            var imageMogr = $(this).data('imagemogr');

            if (watermark) {
                fopArr.push({
                    fop: 'watermark',
                    mode: 1,
                    image: 'http://www.b1.qiniudn.com/images/logo-2.png',
                    dissolve: 100,
                    gravity: watermark,
                    dx: 100,
                    dy: 100
                });
            }

            if (imageView) {
                var height;
                switch (imageView) {
                    case 'large':
                        height = originHeight;
                        break;
                    case 'middle':
                        height = originHeight * 0.5;
                        break;
                    case 'small':
                        height = originHeight * 0.1;
                        break;
                    default:
                        height = originHeight;
                        break;
                }
                fopArr.push({
                    fop: 'imageView2',
                    mode: 3,
                    h: parseInt(height, 10),
                    q: 100,
                    format: 'png'
                });
            }

            if (imageMogr === 'no-rotate') {
                fopArr.push({
                    'fop': 'imageMogr2',
                    'auto-orient': true,
                    'strip': true,
                    'rotate': 0,
                    'format': 'png'
                });
            }
        });

        var newUrl = Qiniu.pipeline(fopArr, key);

        var newImg = new Image();
        img.attr('src', 'images/loading.gif');
        newImg.onload = function () {
            img.attr('src', newUrl);
            img.parent('a').attr('href', newUrl);
        };
        newImg.src = newUrl;
        return false;
    });

});
