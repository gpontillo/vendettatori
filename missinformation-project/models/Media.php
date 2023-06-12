<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%media}}".
 *
 * @property int $id
 * @property int $indice_attendibilita
 * @property string $estensione
 * @property string $percorso
 *
 * @property MediaNotizia[] $mediaNotizias
 * @property Notizia[] $notizias
 */
class Media extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%media}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'indice_attendibilita', 'estensione', 'percorso'], 'required'],
            [['id', 'indice_attendibilita'], 'integer'],
            [['estensione'], 'string', 'max' => 10],
            [['percorso'], 'string', 'max' => 250],
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
            'indice_attendibilita' => 'Indice Attendibilita',
            'estensione' => 'Estensione',
            'percorso' => 'Percorso',
        ];
    }

    /**
     * Gets query for [[MediaNotizias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMediaNotizias()
    {
        return $this->hasMany(MediaNotizia::class, ['id_media' => 'id']);
    }

    /**
     * Gets query for [[Notizias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotizias()
    {
        return $this->hasMany(Notizia::class, ['id' => 'id_notizia'])->viaTable('{{%media_notizia}}', ['id_media' => 'id']);
    }

    //MOCKED
    public function calculateIndice() {
        $this->indice_attendibilita = rand(0, 100);
    }
}
