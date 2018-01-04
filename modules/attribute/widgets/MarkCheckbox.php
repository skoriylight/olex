<?php

namespace app\modules\attribute\widgets;

use bookin\aws\checkbox\AwesomeCheckbox;
use yii\helpers\Html;

Class MarkCheckbox extends AwesomeCheckbox{

    public $labelOptions;

    protected function renderItem(){
        $html = [];
        $html [] = Html::beginTag('div',array_merge(['class'=>$this->getClass()],$this->wrapperOptions));
        $label = $this->labelContent;
        $html[] = $this->input;
        if($label){
            $html[] = Html::tag('label', $label,
                [
                    'for'=>$this->labelId,
                    'class' => !empty($this->labelOptions['class'])?$this->labelOptions['class']:''
                ]);
        }
        $html [] = Html::endTag('div');
        return implode('',$html);
    }

    protected function getLabelContent(){
        $label = array_key_exists('label',$this->options)?$this->options['label']:false;

        $this->options['label']=null;
        return $label;
    }
}