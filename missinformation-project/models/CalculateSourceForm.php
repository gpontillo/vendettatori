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
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'source' => 'Source name to verify'
        ];
    }
}