<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.form.js', CClientScript::POS_END);
?>
<?php
/*
 * $model DoctorForm.
 */
$this->setPageTitle('支付订单');
$urlSubmitForm = $this->createUrl("comment/ajaxAddComment");
$urlReturn = $this->createUrl('order/view');
$urlId = Yii::app()->request->getQuery('id', '');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<style>
    .bt-gray5{
        border-top: 1px solid #ececec;
    }
    .bb-gray5{
        border-bottom: 1px solid #ececec;
    }

    #evaluate_article textarea{
        margin-bottom:0px;
        border: none!important;
        border-radius: 0!important;
        -webkit-box-shadow: none!important;
        box-shadow: none!important;
        padding: 0!important;
        height: 60px!important;
    }
    #evaluate_article.bg{
        background-color: #EAEFF1;
    }
    #evaluate_article .btnFull-yellow{
        background-color: #fe8c08;
        width: 100%;
        display: block;
        margin: 5px auto;
    }
</style>
<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">支付订单</h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>
<article id='evaluate_article' class="active bg" data-scroll="true">
    <div class=''>
        <div class="bg-white pl10 pr10">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'comment-form',
                'htmlOptions' => array("enctype" => "multipart/form-data", 'data-actionUrl' => $urlSubmitForm, 'data-url-return' => $urlReturn),
                'enableClientValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnType' => true,
                    'validateOnDelay' => 500,
                    'errorCssClass' => 'error',
                ),
                'enableAjaxValidation' => false,
            ));
            echo $form->hiddenField($model, 'id', array('name' => 'comment[id]', 'value' => $urlId));
            ?>
            <div class="grid pt20 color-green font-s18">
                <div class='col-1 w50'>
                    当前状态:
                </div>
                <div class='col-1 w50 text-right'>
                    待评价
                </div>
            </div>
            <div class='mt10'>
                主刀医生:刘跃武
            </div>
            <div class='grid mt10'>
                <div class='col-0 pt3'>
                    服务效率:
                </div>
                <div class='col-1'>
                    <span data-star='1' class='serviceStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='2' class='serviceStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='3' class='serviceStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='4' class='serviceStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='5' class='serviceStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <?php echo $form->hiddenField($model, 'service', array('name' => 'comment[service]')); ?>
                </div>
            </div>
            <div class='grid mt10'>
                <div class='col-0 pt3'>
                    手术效果:
                </div>
                <div class='col-1 color-gray'>
                    <span data-star='1' class='operationStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='2' class='operationStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='3' class='operationStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='4' class='operationStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='5' class='operationStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <?php echo $form->hiddenField($model, 'post_operative', array('name' => 'comment[post_operative]')); ?>
                </div>
            </div>
            <div class="ui-field-contain">
                <div class="pt10 pb10 mt10 bt-gray5 bb-gray5">
                    <?php echo $form->textArea($model, 'comment_text', array('name' => 'comment[comment_text]', 'minlength' => 10, 'maxlength' => 1000, 'rows' => '6', 'placeholder' => '请您对此次服务给予评价，谢谢！11')); ?>
                </div>
            </div>
            <div class="pt20 pb30 text-center color-blue">
                <div class="font-s16">术后评价,给更多病友参考。</div>
                <div>祝您早日康复</div>
            </div>
            <?php
            $this->endWidget();
            ?>
        </div>
        <div class="ml10 mr10 mt10 font-s12 letter-s1">
            <div>订单编号:MYZD20160119012</div>
            <div class="grid">
                <div class="col-0">
                    已付手术预约金:1000元
                </div>
                <div class="col-1 text-right">
                    2016-02-23 23:23:23
                </div>
            </div>
            <div class="grid">
                <div class="col-0">
                    已付平台服务费:20000元
                </div>
                <div class="col-1 text-right">
                    2016-02-23 23:23:23
                </div>
            </div>
        </div>
        <div class="pl10 pr10 pt20">
            <button id="btnSubmit" type="button" class="button btnFull-yellow font-s16">预约</button>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        //服务效率
        $('.serviceStar').click(function () {
            var number = Number($(this).attr('data-star'));
            $('input[id="comment_service"]').attr('value', number);
            $('.serviceStar').each(function () {
                if ($(this).attr('data-star') <= number) {
                    $(this).html("<img src='<?php echo $urlResImage; ?>starFill.png' class='w20p'>");
                } else {
                    $(this).html("<img src='<?php echo $urlResImage; ?>star.png' class='w20p'>");
                }
            });
        });
        //手术效果
        $('.operationStar').click(function () {
            var number = Number($(this).attr('data-star'));
            $('input[id="comment_post_operative"]').attr('value', number);
            $('.operationStar').each(function () {
                if ($(this).attr('data-star') <= number) {
                    $(this).html("<img src='<?php echo $urlResImage; ?>starFill.png' class='w20p'>");
                } else {
                    $(this).html("<img src='<?php echo $urlResImage; ?>star.png' class='w20p'>");
                }
            });
        });
        $btnSubmit = $("#btnSubmit");
        $domForm = $("#comment-form");
        $btnSubmit.click(function () {
            $domForm.submit();
        });
        //表单验证板块
        var validator = $domForm.validate({
            rules: {
                'comment[comment_text]': {
                    required: true,
                    maxlength: 1000
                }
            },
            messages: {
                'comment[comment_text]': {
                    required: '请填写疾病描述',
                    maxlength: '病情太长（最多1000个字）',
                    minlength: '病情太短（最少10个字）'
                }
            },
            errorElement: "div",
            errorPlacement: function (error, element) {                             //错误信息位置设置方法  
                element.parents(".ui-field-contain").find("div.error").remove();
                error.appendTo(element.parents(".ui-field-contain")); //这里的element是录入数据的对象  
            },
            submitHandler: function () {
                disabledBtn($btnSubmit);
                //form插件的异步无刷新提交
                var actionUrl = $domForm.attr('data-actionurl');
                var formdata = $domForm.serializeArray();
                console.log(formdata);
                $domForm.ajaxSubmit({
                    type: 'post',
                    url: actionUrl,
                    data: formdata,
                    success: function (data) {
                        console.log(data);
                        //图片上传
                        if (data.status == 'ok') {
                            uploadReturnUrl = uploadReturnUrl + '?refNo=' + data.salesOrderRefNo;
                            location.href = uploadReturnUrl;
                            enableBtn($btnSubmit);
                        } else {

                        }
                        enableBtn($btnSubmit);
                    }
                });
            }
        });
    });
</script>