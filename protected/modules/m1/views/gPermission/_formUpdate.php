<style>
    .userautocompletelink {
        height: 52px;
    }

    .userautocompletelink img {
        float: left;
        margin-right: 5px;
        width: 40px;
    }

</style>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker', "
$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).mask('99-99-9999');
		//$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).mask('99-99-9999 99:99');
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).mask('99-99-9999 99:99');
		$( \"#" . CHtml::activeId($model, 'number_of_day') . "\" ).mask('9?9');

		$( \"#" . CHtml::activeId($model, 'parent_name') . "\" ).autocomplete({
			'minLength' : 2,
			'source': ' " . Yii::app()->createUrl('/m1/gPerson/personAutoCompletePhoto') . "',
			'focus': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'parent_name') . "\").val(ui.item.label);
			return false;
			},
			'select': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'parent_id') . "\").val(ui.item.id);
			return false;
			},
			
		})
		.data( \"autocomplete\" )._renderItem = function( ul, item ) {
			return $( \"<li></li>\")
			.data( \"item.autocomplete\", item )
			.append('<a class=\'userautocompletelink\'><img src=\'" . Yii::app()->baseUrl . "/shareimages/hr/employee/" . "'+item.photo+'\'/><h5>'+item.label+'</h5></a>')
			.appendTo( ul );
		};
		
		
});

		");
?>

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'g-cuti-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php //echo $form->textFieldGroup($model,'parent_name',array('class'=>'col-md-4','maxlength'=>10)); ?>

<?php /*
  <div class="form-group">
  <?php echo $form->labelEx($model,'parent_name',array('class'=>'control-label')); ?>
  <div class="col-sm-9">
  <?php
  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
  'model'=>$model,
  'attribute'=>'parent_name',
  'source'=>$this->createUrl('/m1/gPerson/personAutoCompleteId'),
  'options'=>array(
  'minLength'=>'2',
  'focus'=> 'js:function( event, ui ) {
  $("#'.CHtml::activeId($model,'parent_name').'").val(ui.item.label);
  return false;
  }',
  'select'=> 'js:function( event, ui ) {
  $("#'.CHtml::activeId($model,'parent_id').'").val(ui.item.id);
  return false;
  }',
  ),
  'htmlOptions'=>array(
  'class'=>'input-medium',
  'placeholder'=>'Search Name',
  'class'=>'col-md-4',
  ),
  ));

  ?>
  </div>
  </div>
 */
?>

<?php //echo $form->hiddenField($model,'parent_id'); ?>

<?php echo $form->textFieldGroup($model, 'input_date'); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'start_date', ['class' => 'col-sm-3 control-label']); ?>
    <div class="col-sm-9">
        <?php
        $this->widget(
            'ext.EJuiDateTimePicker.EJuiDateTimePicker', [
                'model' => $model,
                'attribute' => 'start_date',
                'options' => [
                    'dateFormat' => 'dd-mm-yy',
                    'timeFormat' => 'hh:mm', //'hh:mm tt' default
                    //'stepMinute' => 15,
                ],
                'htmlOptions' => [
                    'class' => 'form-control'
                ]
            ]
        );
        ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'end_date', ['class' => 'col-sm-3 control-label']); ?>
    <div class="col-sm-9">
        <?php
        $this->widget(
            'ext.EJuiDateTimePicker.EJuiDateTimePicker', [
                'model' => $model,
                'attribute' => 'end_date',
                'options' => [
                    'dateFormat' => 'dd-mm-yy',
                    'timeFormat' => 'hh:mm', //'hh:mm tt' default
                    //'stepMinute' => 15,
                ],
                'htmlOptions' => [
                    'class' => 'form-control'
                ]
            ]
        );
        ?>
    </div>
</div>

<?php echo $form->dropDownListGroup($model, 'permission_type_id', ['widgetOptions' => [
    'data' => gParamPermission::model()->permissionDropDown()
]]); ?>

<?php echo $form->numberFieldGroup($model, 'number_of_day', ['hint' => 'Total days of permission', 'widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->textAreaGroup($model, 'permission_reason', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>



<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <?php
        $this->widget('booster.widgets.TbButton', [
            'buttonType' => 'submit',
            'context' => 'primary',
            'icon' => 'fa fa-check',
            'label' => $model->isNewRecord ? 'Create' : 'Save',
        ]);
        ?>
    </div>
</div>
<?php
$this->endWidget();
