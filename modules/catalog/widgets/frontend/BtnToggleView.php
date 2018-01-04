<?php

namespace app\modules\catalog\widgets\frontend;

use yii\base\Widget;
use Yii;
use yii\helpers\Html;


Class BtnToggleView extends Widget
{

    public $tabs;
    public $options;
    public $btnOptions;
    protected $value;
    public $valueDefault = 'defaults';


    public function init()
    {

        parent::init();
        \app\modules\catalog\widgets\frontend\assets\BtnToggleViewAsset::register($this->view);
        $btnOptions = [
            'class' => 'btn-toggle-view',
            'tag' => 'div'
        ];

        $options = [
            'class' => 'container-toggle-view'
        ];

        $this->options = $options;
        $this->btnOptions = $btnOptions;
        $this->value = isset($_COOKIE['tab_view']) ?$_COOKIE['tab_view'] : $this->setValueDefault();

    }

    public function run()
    {
        return $this->createList();
    }

    protected function createList()
    {
        $res = "<ul class='{$this->options['class']}'>";
        foreach ($this->tabs as $index=>$tab) {
            $name = is_array($tab)?$index:$tab;
            $btn = $this->createBtn($name);
            $res.="<li>$btn</li>";
        }
        return $res."</ul>";
    }

    protected function getAttrVal($name, $index){
        if(isset($this->tabs[$name][$index]) && is_string($this->tabs[$name][$index])){
            return $this->tabs[$name][$index];
        }
        return  $name;
    }

    protected function createBtn($name)
    {
        return Html::tag($this->btnOptions['tag'], $this->getAttrVal($name, 'icon'),
            [
                'class' => (isset($this->tabs[$name]['class'])?$this->tabs[$name]['class']:$this->btnOptions['class'])
                    .($name == $this->value?' active':'' ),
                'data-role' => 'tab-view',
                'data-value' => $this->getAttrVal($name, 'value')
            ]);
    }

    protected function setValueDefault()
    {
        //setcookie('tab_view', $this->valueDefault);
        $_COOKIE['tab_view'] = $this->valueDefault;
        return $this->valueDefault;
    }


}