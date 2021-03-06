<?php
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/m/jquery.formvalidate.min.1.0.js', CClientScript::POS_END);
?>
<?php
/*
 * $model DoctorForm.
 */
$this->setPageTitle('评价');
$urlSubmitForm = $this->createUrl("comment/ajaxAddComment");
$urlReturn = $this->createAbsoluteUrl('booking/patientBookingList');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
$orderInfo = $data->results->orderInfo;
?>

<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">评价</h1>
    <nav class="right">
        <a onclick="javascript:location.reload()">
            <img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">
        </a>
    </nav>
</header>
<article id='review_article' class="active bg" data-scroll="true">
    <div class=''>
        <div>
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
            echo $form->hiddenField($model, 'id', array('name' => 'comment[id]', 'value' => $data->results->id));
            echo $form->hiddenField($model, 'disease_detail', array('name' => 'comment[disease_detail]', 'value' => $data->results->diseaseName));
            ?>
            <div class="mt20 mb10 font-s18 text-center">
                主刀医生:<?php echo $data->results->expertName; ?>
            </div>
            <div class="bg-white pl20 pr20">
                <div class="ui-field-contain">
                    <div class='grid pt10'>
                        <div class='col-0 pt3'>
                            治疗效果:
                        </div>
                        <div class='col-1'>
                            <span data-star='1' class='effectStar pl10'><img src='http://static.mingyizhudao.com/146975981120273' class='w20p'></span>
                            <span data-star='2' class='effectStar pl10'><img src='http://static.mingyizhudao.com/146975981120273' class='w20p'></span>
                            <span data-star='3' class='effectStar pl10'><img src='http://static.mingyizhudao.com/146975981120273' class='w20p'></span>
                            <span data-star='4' class='effectStar pl10'><img src='http://static.mingyizhudao.com/146975981120273' class='w20p'></span>
                            <span data-star='5' class='effectStar pl10'><img src='http://static.mingyizhudao.com/146975981120273' class='w20p'></span>
                            <?php echo $form->hiddenField($model, 'effect', array('name' => 'comment[effect]', 'value' => 5)); ?>
                        </div>
                    </div>
                </div>
                <div class="ui-field-contain">
                    <div class='grid pt10 pb10'>
                        <div class='col-0 pt3'>
                            医生态度:
                        </div>
                        <div class='col-1 color-gray'>
                            <span data-star='1' class='doctorAttitudeStar pl10'><img src='http://static.mingyizhudao.com/146975981120273' class='w20p'></span>
                            <span data-star='2' class='doctorAttitudeStar pl10'><img src='http://static.mingyizhudao.com/146975981120273' class='w20p'></span>
                            <span data-star='3' class='doctorAttitudeStar pl10'><img src='http://static.mingyizhudao.com/146975981120273' class='w20p'></span>
                            <span data-star='4' class='doctorAttitudeStar pl10'><img src='http://static.mingyizhudao.com/146975981120273' class='w20p'></span>
                            <span data-star='5' class='doctorAttitudeStar pl10'><img src='http://static.mingyizhudao.com/146975981120273' class='w20p'></span>
                            <?php echo $form->hiddenField($model, 'doctor_attitude', array('name' => 'comment[doctor_attitude]', 'value' => 5)); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui-field-contain mt20 ml10 mr10">
                <div class="bg-white pl10 pr10">
                    <div class="pt10 pb10 mt10">
                        <?php echo $form->textArea($model, 'comment_text', array('name' => 'comment[comment_text]', 'minlength' => 10, 'maxlength' => 1000, 'rows' => '6', 'placeholder' => '术后评价，给更多病友参考')); ?>
                    </div>
                </div>
            </div>
            <div class="pl10 pr10 pt10 pb20">
                <button id="btnSubmit" type="button" class="button btnFull-yellow font-s16">提交评价</button>
            </div>
            <?php
            $this->endWidget();
            ?>
        </div>

        <div class="font-s12 letter-s1 bg-white pad10 color-gray4">
            <div>订单编号:<?php echo $data->results->refNo; ?></div>
            <?php
            for ($i = 0; $i < count($orderInfo); $i++) {
                if ($orderInfo[$i]->is_paid == 1) {
                    if ($orderInfo[$i]->order_type == 'deposit') {
                        echo '<div class="bt-gray pad10">已支付手术预约金：' . $orderInfo[$i]->final_amount . '元</div>';
                    } else {
                        echo '<div class="bt-gray pad10">已支付手术咨询费：' . $orderInfo[$i]->final_amount . '元</div>';
                    }
                }
            }
            ?>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        //服务效率
        $('.effectStar').click(function () {
            var number = Number($(this).attr('data-star'));
            $('input[id="comment_effect"]').attr('value', number);
            $('.effectStar').each(function () {
                if ($(this).attr('data-star') <= number) {
                    $(this).html("<img src='http://static.mingyizhudao.com/146975981120273' class='w20p'>");
                } else {
                    $(this).html("<img src='http://static.mingyizhudao.com/146975996998473' class='w20p'>");
                }
            });
        });
        //手术效果
        $('.doctorAttitudeStar').click(function () {
            var number = Number($(this).attr('data-star'));
            $('input[id="comment_doctor_attitude"]').attr('value', number);
            $('.doctorAttitudeStar').each(function () {
                if ($(this).attr('data-star') <= number) {
                    $(this).html("<img src='http://static.mingyizhudao.com/146975981120273' class='w20p'>");
                } else {
                    $(this).html("<img src='http://static.mingyizhudao.com/146975996998473' class='w20p'>");
                }
            });
        });
        var btnSubmit = $("#btnSubmit");
        var domForm = $("#comment-form");
        var uploadReturnUrl = domForm.attr('data-url-return');
        btnSubmit.click(function () {
            domForm.submit();
        });
        //表单验证板块
        var validator = domForm.validate({
            rules: {
                'comment[comment_text]': {
                    required: true,
                    maxlength: 1000
                }
            },
            messages: {
                'comment[comment_text]': {
                    required: '请填写服务评价',
                    maxlength: '评价太长（最多1000个字）',
                    minlength: '评价太短（最少10个字）'
                }
            },
            errorElement: "div",
            errorPlacement: function (error, element) {                             //错误信息位置设置方法  
                element.parents(".ui-field-contain").find("div.error").remove();
                error.appendTo(element.parents(".ui-field-contain")); //这里的element是录入数据的对象  
            },
            submitHandler: function () {
                disabledBtn(btnSubmit);
                //form插件的异步无刷新提交
                var actionUrl = domForm.attr('data-actionurl');
                var formdata = domForm.serializeArray();
                console.log(formdata);
                domForm.ajaxSubmit({
                    type: 'post',
                    url: actionUrl,
                    data: formdata,
                    success: function (data) {
                        console.log(data);
                        //图片上传
                        if (data.status == 'ok') {
                            location.href = uploadReturnUrl;
                            enableBtn(btnSubmit);
                        } else {

                        }
                        enableBtn(btnSubmit);
                    }
                });
            }
        });
    });
</script>