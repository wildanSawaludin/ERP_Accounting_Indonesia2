<?php

/**
 * @var $this EmailTemplateController
 * @var $emailTemplate EmailTemplate
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-email-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-email-module/master/LICENSE
 *
 * @package yii-email-module
 */
$this->pageTitle = Yii::t('email', 'Template ID-:id', [':id' => $emailTemplate->id]);

// links
$this->menu[] = ['label' => Yii::t('email', 'View'), 'url' => ['view', 'id' => $emailTemplate->id], 'linkOptions' => ['class' => 'btn btn-default']];

// form
$this->renderPartial('_form', [
    'emailTemplate' => $emailTemplate,
]);
