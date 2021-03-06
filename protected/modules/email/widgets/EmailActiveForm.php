<?php

Yii::import('booster.widgets.TbActiveForm');

/**
 * EmailActiveForm
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-email-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-email-module/master/LICENSE
 *
 * @package yii-email-module
 */
class EmailActiveForm extends TbActiveForm
{

    /**
     * @param $buttonClass
     * @param null $gridId
     */
    public function searchToggle($buttonClass, $gridId = null)
    {
        $script = "$('." . $buttonClass . "').click(function(){ $('#" . $this->id . "').toggle(); });";
        if ($gridId) {
            $script .= "
                $('#" . $this->id . "').submit(function(){
                    $.fn.yiiGridView.update('" . $gridId . "', {url: $(this).attr('action'),data: $(this).serialize()});
                    return false;
                });
            ";
        }
        Yii::app()->clientScript->registerScript($this->id . '-searchToggle', $script, CClientScript::POS_READY);
    }

    /**
     * @param null $label
     * @param array $options
     * @return string
     */
    public function getSubmitButtonRow($label = null, $options = [])
    {
        if (!isset($options['color']))
            $options['color'] = TbHtml::BUTTON_COLOR_PRIMARY;
        return CHtml::tag('div', ['class' => 'form-actions'], TbHtml::submitButton($label, $options));
    }

}
