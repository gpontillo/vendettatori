<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $id_categoria
 * @property string $descrizione_categoria
 *
 * @property Notizia[] $notizias
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_categoria', 'descrizione_categoria'], 'required'],
            [['id_categoria'], 'integer'],
            [['descrizione_categoria'], 'string', 'max' => 255],
            [['id_categoria'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_categoria' => 'Id Categoria',
            'descrizione_categoria' => 'Descrizione Categoria',
        ];
    }

    /**
     * Gets query for [[Notizias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotizias()
    {
        return $this->hasMany(Notizia::class, ['tipo_categoria' => 'id_categoria']);
    }
}
