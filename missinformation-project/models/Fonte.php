<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fonte".
 *
 * @property int $id_fonte
 * @property string $descrizione_fonte
 * @property int $indice_fonte
 *
 * @property Notizia[] $notizias
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
            [['id_fonte', 'descrizione_fonte', 'indice_fonte'], 'required'],
            [['id_fonte', 'indice_fonte'], 'integer'],
            [['descrizione_fonte'], 'string', 'max' => 500],
            [['id_fonte'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_fonte' => 'Id Fonte',
            'descrizione_fonte' => 'Descrizione Fonte',
            'indice_fonte' => 'Indice Fonte',
        ];
    }

    /**
     * Gets query for [[Notizias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotizias()
    {
        return $this->hasMany(Notizia::class, ['fonte' => 'id_fonte']);
    }
}
