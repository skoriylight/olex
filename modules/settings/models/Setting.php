<?php

namespace app\modules\settings\models;

use yii\base\Model;

class Setting extends Model {
    public $siteName, $siteDescription;
    public function rules()
    {
        return [
            [['siteName', 'siteDescription'], 'string'],
        ];
    }

    public function fields()
    {
        return ['siteName', 'siteDescription'];
    }

    public function attributeLabels()
    {
        return [
            'siteName' => \Yii::t('settings', 'SITE_NAME'),
            'siteDescription'  => \Yii::t('settings', 'SITE_DESCRIPTION') ];
    }

    public function attributes()
    {
        return [
            'siteName',
            'siteDescription'
            ];
    }
}