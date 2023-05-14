<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property int $id
 * @property string $link
 * @property string $descrizione
 * @property int|null $indiceAttendibilita
 * @property string|null $dataPubblicazione
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'link', 'descrizione'], 'required'],
            [['id', 'indiceAttendibilita'], 'integer'],
            [['dataPubblicazione'], 'safe'],
            [['link', 'descrizione'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Link',
            'descrizione' => 'Descrizione',
            'indiceAttendibilita' => 'Indice Attendibilita',
            'dataPubblicazione' => 'Data Pubblicazione',
        ];
    }
}
