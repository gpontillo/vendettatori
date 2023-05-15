<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CalculateForm extends Model
{
    public $url;
    public $category;

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
            'category' => 'Select a category to search'
        ];
    }
}