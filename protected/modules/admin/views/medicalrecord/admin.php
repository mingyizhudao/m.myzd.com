<?php
/* @var $this MedicalRecordController */
/* @var $model MedicalRecord */

$this->breadcrumbs=array(
	'Medical Records'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MedicalRecord', 'url'=>array('index')),
	array('label'=>'Create MedicalRecord', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#medical-record-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Medical Records</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'medical-record-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'name',
		'nric',
		'gender',
		'dob',
		/*
		'state',
		'city',
		'occupation',
		'patient_condition',
		'surgery_history',
		'drug_history',
		'disease_history',
		'remark',
		'date_created',
		'date_updated',
		'date_deleted',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
