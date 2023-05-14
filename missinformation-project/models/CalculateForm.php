<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CalculateForm extends Model
{
    public $url;

    public function rules()
    {
        return [
            [['url'], 'required'],
            ['url','url', 'defaultScheme' => 'http'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'url' => 'News\'url to verify',
        ];
    }
}