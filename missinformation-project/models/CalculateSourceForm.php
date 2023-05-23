<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CalculateSourceForm extends Model
{
    public $source;

    public function rules()
    {
        return [
            [['source'], 'required'],
            ['source','source', 'defaultScheme' => 'http'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'source' => 'News url to verify'
        ];
    }
}