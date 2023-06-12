<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%media_notizia}}".
 *
 * @property int $id_notizia
 * @property int $id_media
 *
 * @property Media $media
 * @property Notizia $notizia
 */
class MediaNotizia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%media_notizia}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_notizia', 'id_media'], 'required'],
            [['id_notizia', 'id_media'], 'integer'],
            [['id_notizia', 'id_media'], 'unique', 'targetAttribute' => ['id_notizia', 'id_media']],
            [['id_notizia'], 'exist', 'skipOnError' => true, 'targetClass' => Notizia::class, 'targetAttribute' => ['id_notizia' => 'id']],
            [['id_media'], 'exist', 'skipOnError' => true, 'targetClass' => Media::class, 'targetAttribute' => ['id_media' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_notizia' => 'Id Notizia',
            'id_media' => 'Id Media',
        ];
    }

    /**
     * Gets query for [[Media]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasOne(Media::class, ['id' => 'id_media']);
    }

    /**
     * Gets query for [[Notizia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotizia()
    {
        return $this->hasOne(Notizia::class, ['id' => 'id_notizia']);
    }
}
