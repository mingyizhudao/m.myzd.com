<?php
/* @var $this EventDandaoController */
/* @var $model EventDandao */
/* @var $form CActiveForm */
?>

<section id="form-success" class="m-panel color-green text-center hide">
    <div class="m-sub-panel">恭喜，您已成功报名！</div>
</section>


<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'event-dandao-form',
        'action' => $this->createUrl('event/ajaxDandao'),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'htmlOptions' => array('class' => "form-horizontal", 'role' => 'form', 'autocomplete' => 'off'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnType' => true,
            'validateOnDelay' => 500,
            'errorCssClass' => 'error',
        ),
        'enableAjaxValidation' => false,
            ));
    ?>

    <div class="ui-field-contain">        
        <?php echo $form->label($model, 'name', array('class' => 'color-green')); ?>
        <?php echo $form->textField($model, 'name', array('class' => '', 'maxlength' => 45, 'placeholder' => '输入患者姓名')); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="ui-field-contain">        
        <?php //echo $form->label($model, 'gender', array('class' => 'color-green')); ?>
        <?php
        echo $form->dropDownList($model, 'gender', $model->getOptionsGender(), array(
            'prompt' => '选择性别',
            'class' => 'sel',
        ));
        ?>       
        <?php echo $form->error($model, 'gender'); ?>
    </div>

    <div class="ui-field-contain">        
        <?php echo $form->label($model, 'mobile', array('class' => 'color-green')); ?>
        <?php echo $form->textField($model, 'mobile', array('maxlength' => 11, 'placeholder' => '11位中国手机号码')); ?>
        <?php echo $form->error($model, 'mobile'); ?>
    </div>
    <div class="ui-field-contain">        
        <?php echo $form->label($model, 'nric', array('class' => 'color-green')); ?>
        <?php echo $form->textField($model, 'nric', array('maxlength' => 18, 'placeholder' => '输入身份证号码')); ?>
        <?php echo $form->error($model, 'nric'); ?>
    </div>

    <div class="ui-field-contain">        
        <?php echo $form->label($model, 'diagnosis', array('class' => 'color-green')); ?>
        <?php echo $form->textarea($model, 'diagnosis', array('rows' => 4, 'maxlength' => 200, 'placeholder' => '肝癌、肾结石等（限200个字）')); ?>
        <?php echo $form->error($model, 'diagnosis'); ?>
    </div>

    <div class="ui-field-contain">        
        <?php echo $form->label($model, 'treatment', array('class' => 'color-green')); ?>
        <?php echo $form->textarea($model, 'treatment', array('rows' => 4, 'maxlength' => 200, 'placeholder' => '请描述以上疾病的治疗经过（限200个字）')); ?>
        <?php echo $form->error($model, 'treatment'); ?>
    </div>

    <div class="ui-field-contain">        
        <?php echo $form->label($model, 'other', array('class' => 'color-green')); ?>
        <?php echo $form->textarea($model, 'other', array('rows' => 3, 'maxlength' => 100, 'placeholder' => '（限100个字）')); ?>
        <?php echo $form->error($model, 'other'); ?>
    </div>


    <div class="ui-field-contain">
        <?php
        echo CHtml::ajaxSubmitButton('提交', CHtml::normalizeUrl(array('event/ajaxDandao', 'render' => true)), array(
            'dataType' => 'json',
            'type' => 'post',
            'success' => 'function(data) {
                      //  $("#btnEventDandao").button("reset");
                         var domForm = $("#event-dandao-form");
                        if(data.status=="true"){
                         $("#form-success").removeClass("hide");
                         domForm[0].reset();
                         domForm.hide();
                        }
                         else{
                         $("#form-success").addClass("hide");
                        $.each(data, function(key, val) {
                        domForm.find("#"+key+"_em_").text(val);
                        domForm.find("#"+key+"_em_").show();
                        });
                        }       
                    }',
            'beforeSend' => 'function(){                        

                      }'
                ), array('id' => 'btnEventDandao', 'class' => 'btn-success', 'data-icon' => 'check'));
        ?>        
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->