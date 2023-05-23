<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CalculateForm extends Model
{
    public $url;
    public $secondUrl;

    public function rules()
    {
        return [
            [['url'], 'required'],
            ['url','url', 'defaultScheme' => 'http'],
            [['secondUrl'], 'required']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'url' => 'News url to verify',
            'secondUrl' => 'Resource url to verify'
        ];
    }
}