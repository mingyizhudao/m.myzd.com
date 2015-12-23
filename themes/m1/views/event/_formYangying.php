<?php
$model = new EventYangying();

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'event-comment-form',
    //  'action' => $this->createUrl('event/ajaxAddComment'),
    'htmlOptions' => array('class' => 'enquiry-form'),
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
    <?php echo $form->label($model, 'author'); ?>
    <?php echo $form->textField($model, 'author', array('maxlength' => 45, 'data-clear-btn' => true, 'placeholder' => "昵称（可不填）")); ?>
    <?php echo $form->error($model, 'author'); ?>
</div>

<div class="ui-field-contain">
    <?php echo $form->label($model, 'comment'); ?>
    <?php echo $form->textarea($model, 'comment', array('maxlength' => 200, 'rows' => 8, 'placeholder' => "请留下您的祝福语")); ?>
    <?php echo $form->error($model, 'comment'); ?>
</div>

<div class="ui-field-contain">
    <a id="btnSubmitComment" class="ui-btn btn-success">发送祝福</a>
</div>
<div class="ui-field-contain">        


</div>

<?php
$this->endWidget();
?>
