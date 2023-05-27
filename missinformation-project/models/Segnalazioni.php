<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%segnalazioni}}".
 *
 * @property int $id
 * @property string $url
 * @property string $motivo
 * @property int $valutazione
 * @property string $esito
 */
class Segnalazioni extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%segnalazioni}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'url', 'motivo', 'valutazione'], 'required'],
            [['id', 'valutazione'], 'integer'],
            [['url'], 'string', 'max' => 50],
            [['motivo'], 'string', 'max' => 200],
            [['esito'], 'string', 'max' => 100],
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
            'url' => 'Url',
            'motivo' => 'Motivo',
            'valutazione' => 'Valutazione',
            'esito' => 'Esito'
        ];
    }
}
