<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ReportMediaForm extends Model
{
    public $url;
    public $motive;
    public $media;
    public $id_notizia;

    public function rules()
    {
        return [
            [['url', 'motive'], 'required', 'message'=>'This field is required'],
            [['media'], 'file'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'url' => 'News url to verify',
            'motive' => 'Why do you have reported this media for this news?',
            'media' => 'Upload the media',
        ];
    }

    public function getMediaPath() {
        if($this->media != null)
            return '\\uploads\\' . $this->id_notizia . 'media-'.hash('sha256', $this->media->basename).'.'. $this->media->extension;
        return 'test.png';
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->media->saveAs(Yii::getAlias('@webroot').$this->getMediaPath());
            return true;
        } else {
            return false;
        }
    }
}