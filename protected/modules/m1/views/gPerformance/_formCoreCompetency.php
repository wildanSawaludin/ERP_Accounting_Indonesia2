<div class="row">
    <div class="col-md-12">

        <div class="page-header">
            <h3>New Core Competency (<?php echo $year ?>)</h3>
        </div>


        <?php
        $form = $this->beginWidget('booster.widgets.TbActiveForm', [
            'id' => 'g-target-setting-form',
            'enableAjaxValidation' => false,
        ]);
        ?>


        <?php //echo $form->dropDownListGroup($model,'year',gTalentPerformance::getTalentPeriod());  ?>


        <?php
        //echo $form->dropDownListGroup($model,'company_id',[],
        //array('class'=>'col-md-5','maxlength'=>50));
        ?>


        <?php echo $form->dropDownListGroup($model, 'talent_template_id', ['widgetOptions' => [
            'data' => gParamCompetency::coreDropDown()
        ]]);
        ?>


        <?php //echo $form->textFieldGroup($model,'superior_score',array('class'=>'col-md-1'));  ?>


        <?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 5]]]); ?>


        <div class="form-group">
            <div class="col-sm-12">
                <?php
                $this->widget('booster.widgets.TbButton', [
                    'buttonType' => 'submit',
                    'context' => 'primary',
                    'icon' => 'fa fa-check',
                    'label' => $model->isNewRecord ? 'Create' : 'Save',
                ]);
                ?>



                <?php
                $this->widget('booster.widgets.TbButton', [
                    'context' => 'primary',
                    'buttonType' => 'link',
                    'icon' => 'fa fa-check',
                    'url' => Yii::app()->createUrl('/m1/gPerformance/generateCoreCompetency', ['id' => $id, 'year' => $year]),
                    'label' => 'Generate All',
                ]);
                ?>

            </div>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
