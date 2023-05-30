<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ReportArticleForm extends Model
{
    public $url;
    public $motive;
    public $review;
    public $id_notizia;

    public function rules()
    {
        return [
            [['url', 'motive', 'review'], 'required', 'message'=>'This field is required'],
            ['url','url', 'defaultScheme' => 'http'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'url' => 'News url to verify',
            'motive' => 'Why do you think this is/isn\'t a fake news?',
            'review' => 'How much do you think this news is reliable?',
        ];
    }
}