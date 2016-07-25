var fileCountCorp = 0, uploaderCorp, booking_id = {"id": "1", "name": "1"};
$(function () {
    var btnUploadSelector = "#btnSubmit",
            domForm = $("#booking-form"),
            btnSubmit = $("#btnSubmit"),
            $wrap = $('#uploaderCorp'),
            // 图片容器
            $queue = $('<ul class="filelist"></ul>')
            .appendTo($wrap.find('.queueList')),
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
            urlUplaodCorpFile = domForm.attr('data-url-uploadCorp'),
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
            })()
            // WebUploader实例
            ;

    if (!WebUploader.Uploader.support()) {
        alert('Web Uploader 不支持您的浏览器！如果你使用的是IE浏览器，请尝试升级 flash 播放器');
        throw new Error('WebUploader does not support the browser you are using.');
    }
    uploaderCorp = WebUploader.create({
        pick: {
            id: '#filePicker3',
            innerHTML: '&nbsp;选择图片'
        },
        accept: {
            title: 'Images',
            extensions: 'jpg,jpeg,png,gif',
            mimeTypes: 'image/*',
        },
        // swf文件路径
        swf: 'webuploader/Uploader.swf',
        // 文件接收服务端。
        server: urlUplaodCorpFile,
        disableGlobalDnd: true,
        // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
        //compress: true,
        chunked: true,
        // server: 'http://webuploader.duapp.com/server/fileupload.php',
        server: urlUploadFile,
                fileNumLimit: 1,
        fileSizeLimit: 10 * 1024 * 1024, // 200 M
        fileSingleSizeLimit: 100 * 1024 * 1024    // 50 M
    });
//    uploaderCorp.addButton({
//        id: '#filePicker4',
//        label: '&nbsp;继续添加'
//    });

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
            uploaderCorp.makeThumb(file, function (error, src) {
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
                    uploaderCorp.removeFile(file);
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
        updateStatusCorp();
    }

    function updateStatusCorp() {
        var text = '', stats;
        if (state === 'ready') {
            text = '选中' + fileCountCorp + '张图片，共' +
                    WebUploader.formatSize(fileSize) + '。';
        } else if (state === 'confirm') {
            stats = uploaderCorp.getStats();
            if (stats.uploadFailNum) {
                text = '已成功上传' + stats.successNum + '张图片，' +
                        stats.uploadFailNum + '张图片上传失败，<a class="retry" href="#">重新上传</a>失败图片或<a class="ignore" href="#">忽略</a>'
            }

        } else {
            stats = uploaderCorp.getStats();
            text = '共' + fileCountCorp + '张（' +
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
                uploaderCorp.refresh();
                break;

            case 'ready':
                $placeHolder.addClass('element-invisible');
                $('#filePicker4').removeClass('element-invisible');
                $queue.parent().addClass('filled');
                $queue.show();
                $statusBar.removeClass('element-invisible');
                uploaderCorp.refresh();
                break;

//            case 'uploading':
//                $( '#filePicker4' ).addClass( 'element-invisible' );
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
                $('#filePicker4').addClass('element-invisible');
                stats = uploaderCorp.getStats();
                if (stats.successNum && !stats.uploadFailNum) {
                    setState('finish');
                    return;
                }
                break;
            case 'finish':
                stats = uploaderCorp.getStats();
                if (stats.successNum) {
                    //console.log(stats);
                    //location.href = uploadReturnUrl;
                    //location.hash = uploadReturnUrl;
                } else {
                    // 没有成功的图片，重设
                    state = 'done';
                    location.reload();
                }
                break;
        }
        updateStatusCorp();
    }

    uploaderCorp.onUploadProgress = function (file, percentage) {
        var $li = $('#' + file.id),
                $percent = $li.find('.progress span');

        $percent.css('width', percentage * 100 + '%');
        percentages[ file.id ][ 1 ] = percentage;
        updateTotalProgress();
    };

    uploaderCorp.onFileQueued = function (file) {
        fileCountCorp++;
        fileSize += file.size;

        if (fileCountCorp === 1) {
            $placeHolder.addClass('element-invisible');
            $statusBar.show();
        }
        addFile(file);
        setState('ready');
        updateTotalProgress();
    };

    uploaderCorp.onFileDequeued = function (file) {
        fileCountCorp--;
        fileSize -= file.size;
        if (!fileCountCorp) {
            setState('pedding');
        }
        removeFile(file);
        updateTotalProgress();

    };

    uploaderCorp.on('all', function (type) {
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
    uploaderCorp.onError = function (code) {
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
        $("#errorConfirm .confirmcontent .errorinfo").html(errorinfo);
        $("#errorConfirm").show();
        //console.log(errorinfo);
        //alert('错误信息: ' + errorinfo);
    };


    //单个文件上传之前触发的事件
    uploaderCorp.on("startUpload", function () {
        //文件上传之前加上表单成功返回的参数
        uploaderCorp.option("formData", {
            'booking[id]': booking_id.id,
        });

    });
    //当所有文件上传结束时触发
    uploaderCorp.on("uploadFinished", function (file, data) {

    });
    //单个文件上传成功触发的事件
    uploaderCorp.on("uploadSuccess", function (file, data) {
        //console.log(data);
    });
//单个文件上传失败触发的事件
    uploaderCorp.on("uploadError", function (file, data) {
        //console.log(data);
    });
//单个文件上传服务器时的事件
    uploaderCorp.on("uploadAccept", function (file, data) {
        //判断该文件上传由后台返回的状态 返回false则会表示文件上传失败 

        if (data.status != 'ok') {
            return false;
        }
    });


    $info.on('click', '.retry', function () {
        uploaderCorp.retry();
    });

    $info.on('click', '.ignore', function () {
        //忽略的操作 错误图片不再上传 直接页面跳转
        location.href = uploadReturnUrl;
    });

    $upload.addClass('state-' + state);
    updateTotalProgress();


});
function getUploaderCorp() {
    return uploaderCorp;
}
function getFileCountCorp() {
    return fileCountCorp;
}
