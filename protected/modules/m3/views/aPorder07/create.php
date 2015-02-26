<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->getClientScript()->getCoreScriptUrl() . '/jui/css/2jui-bootstrap/js/jquery-ui-1.8.16.custom.min.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->getClientScript()->getCoreScriptUrl() . '/jui/css/2jui-bootstrap/jquery-ui.css');
Yii::app()->getClientScript()->registerCoreScript('maskedinput');

Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'periode_date') . "\" ).datepicker({
		'dateFormat':'yymm',
});
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).mask('99-99-9999');
		$( \"#" . CHtml::activeId($model, 'periode_date') . "\" ).mask('999999');
});

		");
?>

<?php
$this->breadcrumbs = [
    'Purchase Order' => ['index'],
    'Create',
];
$this->menu = [
    ['label' => 'Home', 'url' => ['/m3/aPorder07']],
    ['label' => 'Create PO With Dept', 'url' => ['createDept']],
];

$this->menu1 = aPorder::getTopUpdated07();
$this->menu2 = aPorder::getTopCreated07();
?>

<div class="page-header">
    <h1>
        <?php echo CHtml::image(Yii::app()->request->baseUrlCdn . '/images/icon/cash.png') ?>
        New PO
        <small>Create new PO C-07</small>
    </h1>
</div>

<div class="btn-group">
    <a class="btn"
       href="<?php echo Yii::app()->createUrl('/m3/aPorder07/create') ?>">Create
        PO</a> <a class="btn"
                  href="<?php echo Yii::app()->createUrl('/m3/aPorder07/createDept') ?>">Create
        PO With Dept</a> <a class="btn"
                            href="<?php echo Yii::app()->createUrl('/m3/aPorder07/create') ?>">Create
        Non PO</a>
</div>
<br/>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
    'id' => 'aPorder-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>
<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'input_date'); ?>

<?php echo $form->textFieldRow($model, 'no_ref', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'periode_date'); ?>

<?php
echo $form->dropDownListRow($model, 'budgetcomp_id', aBudget::mainComponent07(), [
//	'ajax'=>array(
    //				'success'=>'js:function( event, ui ) {
    //					$("#'.CHtml::activeId($model,'no_ref').'").val("Test");
    //					return false;
    //				}',
    //	),
]);
?>


<?php echo $form->textAreaRow($model, 'remark', ['rows' => 2, 'cols' => 50]); ?>


<?php echo $form->dropDownListRow($model, 'issuer_id', sParameter::items("cIssuer")); ?>
<?php
$this->widget('ext.appendo.JAppendo', [
    'id' => 'repeateEnum',
    'model' => $model,
    'viewName' => '_detailPorder07',
    'labelDel' => 'Remove Row'
    //'cssFile' => 'css/jquery.appendo2.css'
]);
?>
<div class="form-group">
    <?php echo CHtml::htmlButton('<i class="fa fa-check"></i>' . $model->isNewRecord ? 'Create' : 'Save', ['class' => 'btn', 'type' => 'submit']); ?>
</div>

<?php $this->endWidget(); ?>
