<?php
$baseUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl . '/css/peter_custom.css');
?>

<?php
$this->breadcrumbs = [
    $this->module->id,
];
?>

<div class="page-header">
    <h1>
        <?php echo CHtml::image(Yii::app()->request->baseUrlCdn . '/images/icon/company.png') ?>
        Welcome M4 (Asset Management) Users!! (SAMPLE PAGE)
    </h1>
</div>
