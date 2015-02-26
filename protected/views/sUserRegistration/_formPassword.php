<?php
/* @var $this SUserRegistrationController */
/* @var $model sUserRegistration */
/* @var $form CActiveForm */
?>

<div class="raw">
    <div class="col-md-12">

        <?php
        $form = $this->beginWidget('TbActiveForm', [
            'id' => 's-user-registration-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ]);
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->passwordFieldGroup($model, 'password', ['size' => 60, 'maxlength' => 255]); ?>
        <?php echo $form->passwordFieldGroup($model, 'password_repeat', ['size' => 60, 'maxlength' => 255]); ?>

        <div class="control-group">
            <?php
            $this->widget('booster.widgets.TbButton', [
                'buttonType' => 'submit',
                // 'type' => 'primary',
                'icon' => 'fa fa-check',
                'label' => $model->isNewRecord ? 'Create' : 'Save',
            ]);
            ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>
    <!-- form -->
</div><!-- form -->