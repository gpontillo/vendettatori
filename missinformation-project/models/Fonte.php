<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fonte".
 *
 * @property int $id
 * @property string $descrizione_fonte
 */
class Fonte extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fonte';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descrizione_fonte'], 'required'],
            [['descrizione_fonte'], 'string', 'max' => 500],
            [['link_fonte'], 'required'],
            [['link_fonte'], 'string', 'max' => 2600],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descrizione_fonte' => 'Descrizione Fonte',
            'link_fonte' => 'Link Fonte'
        ];
    }
}
