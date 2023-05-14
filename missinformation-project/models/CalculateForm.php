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

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function verify($url)
    {
        if ($this->validate()) {
            return true;
        }
        return false;
    }
}