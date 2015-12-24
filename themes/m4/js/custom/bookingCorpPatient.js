$(function () {

// 手机号码验证
    $.validator.addMethod("isMobile", function (value, element) {
        var length = value.length;
        var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
        return this.optional(element) || (length == 11 && mobile.test(value));
    }, "请填写正确的手机号码");

    //图片上传板块
    var btnUploadSelector = "#btnSubmit",
            domForm = $("#booking-form"),
            btnSubmit = $("#btnSubmit"),
            $wrap = $('#uploader'),
            // 图片容器
            $queue = $('<ul class="filelist"></ul>').appendTo($wrap.find('.queueList')),
            // 状态栏，包括进度和控制按钮
            $statusBar = $wrap.find('.statusBar'),
            // 文件总体选择信息。
            $info = $statusBar.find('.info'),
            // 上传按钮
            $upload = btnSubmit,
            // 没选择文件之前的内容。
            $placeHolder = $wrap.find('.placeholder'),
            // 总体进度条
            $progress = $statusBar.find('.progress').hide(),
            // 添加的文件数量
            fileCount = 0,
            // 添加的文件总大小
            fileSize = 0,
            //图片上传时所需要的参数
            fileParam = {"id": "1", "name": "1"},
    //全部成功 返回地址
    uploadReturnUrl = domForm.attr('data-url-return'),
            //请求路径
            actionUrl = '',
            //data-url-uploadFile
            urlUploadFile = domForm.attr('data-url-uploadFile'),
            // 优化retina, 在retina下这个值是2
            ratio = window.devicePixelRatio || 1,
            // 缩略图大小
            thumbnailWidth = 110 * ratio,
            thumbnailHeight = 110 * ratio,
            // 可能有pedding, ready, uploading, confirm, done.
            state = 'pedding',
            // 所有文件的进度信息，key为file id
            percentages = {},
            supportTransition = (function () {
                var s = document.createElement('p').style,
                        r = 'transition' in s ||
                        'WebkitTransition' in s ||
                        'MozTransition' in s ||
                        'msTransition' in s ||
                        'OTransition' in s;
                s = null;
                return r;
            })(),
            // WebUploader实例
            uploader;
    uploaderCorp;

    if (!WebUploader.Uploader.support()) {
        alert('Web Uploader 不支持您的浏览器！如果你使用的是IE浏览器，请尝试升级 flash 播放器');
        throw new Error('WebUploader does not support the browser you are using.');
    }

    // 实例化
    uploader = WebUploader.create({
        pick: {
            id: '#filePicker',
            innerHTML: '&nbsp;选择图片'
        },
        dnd: '#uploader .queueList',
        paste: document.body,
        accept: {
            title: 'Images',
            extensions: 'jpg,jpeg,png,gif',
            mimeTypes: 'image/*',
        },
        // swf文件路径
        swf: 'webuploader/Uploader.swf',
        disableGlobalDnd: true,
        // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
        //compress: true,
        chunked: true,
        // server: 'http://webuploader.duapp.com/server/fileupload.php',
        server: urlUploadFile,
        fileNumLimit: 10,
        fileSizeLimit: 10 * 1024 * 1024, // 200 M
        fileSingleSizeLimit: 100 * 1024 * 1024    // 50 M
    });


//    uploader.option('thumb',{
//        width: 1600,
//        height: 1600,
//
//        // 图片质量，只有type为`image/jpeg`的时候才有效。
//        quality: 90,
//
//        // 是否允许放大，如果想要生成小图的时候不失真，此选项应该设置为false.
//        allowMagnify: true,
//
//        // 是否允许裁剪。
//        crop: true,
//        // 为空的话则保留原有图片格式。
//        // 否则强制转换成指定的类型。
//        type: 'image/jpeg'
//    });
// 
//    // 修改后图片上传前，尝试将图片压缩到1600 * 1600
//    uploader.option( 'compress', {
//        width: 1600,
//        height: 1600,
//          // 图片质量，只有type为`image/jpeg`的时候才有效。
//        quality: 90,
//        // 是否允许放大，如果想要生成小图的时候不失真，此选项应该设置为false.
//        allowMagnify: false,
//
//        // 是否允许裁剪。
//        crop: false,
//
//        // 是否保留头部meta信息。
//        preserveHeaders: true,
//
//        // 如果发现压缩后文件大小比原来还大，则使用原来图片
//        // 此属性可能会影响图片自动纠正功能
//        noCompressIfLarger: false,
//
//        // 单位字节，如果图片大小小于此值，不会采用压缩。
//        compressSize: 1 * 1024 * 1024
//    });


    // 添加“添加文件”的按钮，
    uploader.addButton({
        id: '#filePicker2',
        label: '&nbsp;继续添加'
    });


    // 当有文件添加进来时执行，负责view的创建
    function addFile(file) {
        var $li = $('<li id="' + file.id + '">' +
                '<p class="title">' + file.name + '</p>' +
                '<p class="imgWrap"></p>' +
                '<p class="progress"><span></span></p>' +
                '</li>'),
                $btns = $('<div class="file-panel">' +
                        '<span class="cancel">删除</span>').appendTo($li),
                $prgress = $li.find('p.progress span'),
                $wrap = $li.find('p.imgWrap'),
                $info = $('<p class="error"></p>'),
                showError = function (code) {
                    switch (code) {
                        case 'exceed_size':
                            text = '文件大小超出';
                            break;

                        case 'interrupt':
                            text = '上传暂停';
                            break;

                        default:
                            text = '上传失败，请重试';
                            break;
                    }

                    $info.text(text).appendTo($li);
                };

        if (file.getStatus() === 'invalid') {
            showError(file.statusText);
        } else {
            // @todo lazyload
            $wrap.text('预览中');
            uploader.makeThumb(file, function (error, src) {
                if (error) {
                    $wrap.text('不能预览');
                    return;
                }
                var img = $('<img src="' + src + '">');
                $wrap.empty().append(img);
            }, thumbnailWidth, thumbnailHeight);

            percentages[ file.id ] = [file.size, 0];
            file.rotation = 0;
        }

        file.on('statuschange', function (cur, prev) {
            if (prev === 'progress') {
                $prgress.hide().width(0);
            } else if (prev === 'queued') {
                $li.off('mouseenter mouseleave');
                $btns.remove();
            }

            // 成功
            if (cur === 'error' || cur === 'invalid') {
                console.log(file.statusText);
                showError(file.statusText);
                percentages[ file.id ][ 1 ] = 1;
            } else if (cur === 'interrupt') {
                showError('interrupt');
            } else if (cur === 'queued') {
                percentages[ file.id ][ 1 ] = 0;
            } else if (cur === 'progress') {
                $info.remove();
                $prgress.css('display', 'block');
            } else if (cur === 'complete') {
                $li.append('<span class="success"></span>');
            }

            $li.removeClass('state-' + prev).addClass('state-' + cur);
        });

        $li.on('mouseenter', function () {
            $btns.stop().animate({height: 30});
        });

        $li.on('mouseleave', function () {
            $btns.stop().animate({height: 0});
        });

        $btns.on('click', 'span', function () {
            var index = $(this).index(),
                    deg;

            switch (index) {
                case 0:
                    uploader.removeFile(file);
                    return;

                case 1:
                    file.rotation += 90;
                    break;

                case 2:
                    file.rotation -= 90;
                    break;
            }

            if (supportTransition) {
                deg = 'rotate(' + file.rotation + 'deg)';
                $wrap.css({
                    '-webkit-transform': deg,
                    '-mos-transform': deg,
                    '-o-transform': deg,
                    'transform': deg
                });
            } else {
                $wrap.css('filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation=' + (~~((file.rotation / 90) % 4 + 4) % 4) + ')');
            }
        });

        $li.appendTo($queue);
    }

    // 负责view的销毁
    function removeFile(file) {
        var $li = $('#' + file.id);

        delete percentages[ file.id ];
        updateTotalProgress();
        $li.off().find('.file-panel').off().end().remove();
    }

    function updateTotalProgress() {
        var loaded = 0,
                total = 0,
                spans = $progress.children(),
                percent;

        $.each(percentages, function (k, v) {
            total += v[ 0 ];
            loaded += v[ 0 ] * v[ 1 ];
        });

        percent = total ? loaded / total : 0;

        spans.eq(0).text(Math.round(percent * 100) + '%');
        spans.eq(1).css('width', Math.round(percent * 100) + '%');
        updateStatus();
    }

    function updateStatus() {
        var text = '', stats;

        if (state === 'ready') {
            text = '选中' + fileCount + '张图片，共' +
                    WebUploader.formatSize(fileSize) + '。';
        } else if (state === 'confirm') {
            stats = uploader.getStats();
            if (stats.uploadFailNum) {
                text = '已成功上传' + stats.successNum + '张图片，' +
                        stats.uploadFailNum + '张图片上传失败，<a class="retry" href="#">重新上传</a>失败图片或<a class="ignore" href="#">忽略</a>'
            }

        } else {
            stats = uploader.getStats();
            text = '共' + fileCount + '张（' +
                    WebUploader.formatSize(fileSize) +
                    '），已上传' + stats.successNum + '张';

            if (stats.uploadFailNum) {
                text += '，失败' + stats.uploadFailNum + '张';
            }
        }

        $info.html(text);
    }

    function setState(val) {
        var file, stats;

        if (val === state) {
            return;
        }

        $upload.removeClass('state-' + state);
        $upload.addClass('state-' + val);
        state = val;

        switch (state) {
            case 'pedding':
                $placeHolder.removeClass('element-invisible');
                $queue.parent().removeClass('filled');
                $queue.hide();
                $statusBar.addClass('element-invisible');
                uploader.refresh();
                break;

            case 'ready':
                $placeHolder.addClass('element-invisible');
                $('#filePicker2').removeClass('element-invisible');
                $queue.parent().addClass('filled');
                $queue.show();
                $statusBar.removeClass('element-invisible');
                uploader.refresh();
                break;

//            case 'uploading':
//                $( '#filePicker2' ).addClass( 'element-invisible' );
//                $progress.show();
//                $upload.text( '暂停上传' );
//                break;
//
//            case 'paused':
//                $progress.show();
//                $upload.text( '继续上传' );
//                break;

            case 'confirm':
                $progress.hide();
                $upload.addClass('disabled');
                $('#filePicker2').addClass('element-invisible');
                stats = uploader.getStats();
                if (stats.successNum && !stats.uploadFailNum) {
                    setState('finish');
                    return;
                }
                break;
            case 'finish':
                stats = uploader.getStats();
                if (stats.successNum) {
                    //console.log(stats);
                    //location.href = uploadReturnUrl;
                    //location.hash = uploadReturnUrl;
                    J.popup({
                        html: '<div><div class="popup-title">提示</div><div class="popup-content"><h4>提交成功！</h4><div class="mt20"><a data-target="link" href="' + uploadReturnUrl + '" class="btn btn-yes btn-block">确定</a></div></div></div>',
                        pos: 'center'
                    });
                } else {
                    // 没有成功的图片，重设
                    //state = 'done';
                    location.reload();
                }
                break;
        }
        updateStatus();
    }

    uploader.onUploadProgress = function (file, percentage) {
        var $li = $('#' + file.id),
                $percent = $li.find('.progress span');

        $percent.css('width', percentage * 100 + '%');
        percentages[ file.id ][ 1 ] = percentage;
        updateTotalProgress();
    };

    uploader.onFileQueued = function (file) {
        fileCount++;
        fileSize += file.size;

        if (fileCount === 1) {
            $placeHolder.addClass('element-invisible');
            $statusBar.show();
        }
        addFile(file);
        setState('ready');
        updateTotalProgress();
    };

    uploader.onFileDequeued = function (file) {
        fileCount--;
        fileSize -= file.size;
        if (!fileCount) {
            setState('pedding');
        }
        removeFile(file);
        updateTotalProgress();

    };

    uploader.on('all', function (type) {
        var stats;
        switch (type) {
            case 'uploadFinished':
                setState('confirm');
                break;

            case 'startUpload':
                setState('uploading');
                break;

//            case 'stopUpload':
//                setState( 'paused' );
//                break;

        }
    });
    //图片上传前的错误验证
    uploader.onError = function (code) {
        var errorinfo;
        switch (code) {
            case 'F_DUPLICATE':
                errorinfo = "文件名重复!";
                break;
            case 'F_EXCEED_SIZE':
                errorinfo = "图片过大!";
                break;
            case 'Q_EXCEED_SIZE_LIMIT':
                errorinfo = "图片队列总大小过大!";
                break;
            case 'Q_EXCEED_NUM_LIMIT':
                errorinfo = "文件数量过多!";
                break;
            case 'Q_TYPE_DENIED':
                errorinfo = "请选择jpg/jpeg/png或gif格式的图片!";
                break;
        }
        J.showToast(errorinfo, '', 2000);
        //console.log(errorinfo);
        //alert('错误信息: ' + errorinfo);
    };


    //单个文件上传之前触发的事件
    uploader.on("startUpload", function () {
        //文件上传之前加上表单成功返回的参数
        uploader.option("formData", {
            'booking[id]': fileParam.id,
        });

    });
    //当所有文件上传结束时触发
    uploader.on("uploadFinished", function (file, data) {

    });
    //单个文件上传成功触发的事件
    uploader.on("uploadSuccess", function (file, data) {
        //console.log(data);
    });
//单个文件上传失败触发的事件
    uploader.on("uploadError", function (file, data) {
        //console.log(data);
    });
//单个文件上传服务器时的事件
    uploader.on("uploadAccept", function (file, data) {
        //判断该文件上传由后台返回的状态 返回false则会表示文件上传失败 
        if (data.status != 'ok') {
            return false;
        }
    });
    //提交按钮点击时间
    $upload.on('click', function () {
        if ($(this).hasClass('disabled') || $(this).hasClass("ui-state-disabled")) {
            return false;
        }
        formSubmit();
        //触发表单提交事件 
        //domForm.submit();
    });

    $info.on('click', '.retry', function () {
        uploader.retry();
    });

    $info.on('click', '.ignore', function () {
        //忽略的操作 错误图片不再上传 直接页面跳转
        //location.href = uploadReturnUrl;
    });

    $upload.addClass('state-' + state);
    updateTotalProgress();

    function formSubmit() {
        if (getFileCountCorp() == 0) {
            J.showToast('请选择企业工牌照片', '', 2000);
        } else {
            var bool = validator.form();
            if (bool) {
                formAjaxSubmit();
            }
        }


    }
//表单验证板块
    var validator = domForm.validate({
        rules: {
            'booking[corporate_name]': {
                required: true,
                maxlength: 50
            },
            'booking[corp_staff_rel]': {
                required: true
            },
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
            'booking[corporate_name]': {
                required: '请填写医生企业名称',
                maxlength: '企业名称太长'
            },
            'booking[corp_staff_rel]': {
                required: '请选择与患者的关系'
            },
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
//        errorContainer: "div.error",
//        errorLabelContainer: $("#booking-form div .error"),
//        wrapper: "div",
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            $('div.error').text('');
            error.appendTo(element.parent());     //这里的element是录入数据的对象  
        },
        submitHandler: function () {

        }
    });
    function formAjaxSubmit() {
        //form插件的异步无刷新提交
        actionUrl = domForm.attr('data-actionUrl');
        returnUrl = domForm.attr("data-url-return");
        var uploaderCorp = getUploaderCorp();
        var formdata = domForm.serializeArray();
        $.ajax({
            type: 'post',
            url: actionUrl,
            data: formdata,
            success: function (data) {
                //图片上传
                if (data.status == 'ok') {
                    fileParam.id = data.booking.id;
                    //基本数据插入成功  判断是否有图片
                    if (uploaderCorp.state == 'ready') {
                        uploaderCorp.upload();
                    }
                    if (state == 'ready') {
                        //文件上传 自动跳转
                        uploader.upload();
                    } else {
                        J.popup({
                            html: '<div><div class="popup-title">提示</div><div class="popup-content"><h4>提交成功！</h4><div class="mt20"><a data-target="link" href="' + returnUrl + '" class="btn btn-yes btn-block">确定</a></div></div></div>',
                            pos: 'center'
                        });
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
                }
            },
            error: function (XmlHttpRequest, textStatus, errorThrown) {
                console.log(XmlHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            },
            complete: function () {

            }
        });
    }
});