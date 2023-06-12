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
 * @property int $esito
 * @property int|null $id_notizia
 * @property string|null $media_path
 *
 * @property Notizia $notizia
 */
class Segnalazioni extends \yii\db\ActiveRecord
{
    public const VALUTAZIONI_ARRAY = [
        -1 => 'Media report', 
        0 => 'It\'s unreliable', 
        25 => 'It\'s mostly unrealible', 
        50 => 'I don\'t know', 
        75 => 'It\'s mostrly reliable', 
        100 => 'It\'s reliable'
    ];
    
    public const ESITO_ARRAY = [
        0 => '-----',
        1 => 'Reliable',
        -1 => 'Not reliable',
        2 => 'Media accepted'
    ];

    public const ESITO_REPORT_ARRAY = [
        0 => '-----',
        1 => 'Reliable',
        -1 => 'Not reliable',
    ];

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
            [['id', 'url', 'motivo'], 'required'],
            [['id', 'valutazione', 'esito', 'id_notizia'], 'integer'],
            [['url', 'media_path'], 'string', 'max' => 255],
            [['motivo'], 'string', 'max' => 500],
            [['id'], 'unique'],
            [['id_notizia'], 'exist', 'skipOnError' => true, 'targetClass' => Notizia::class, 'targetAttribute' => ['id_notizia' => 'id']],
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
            'esito' => 'Esito',
            'id_notizia' => 'Id Notizia',
            'media_path' => 'Media Path',
        ];
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

    public static function getValutazione(int $valutazione): string
    {
        if(isset(Segnalazioni::VALUTAZIONI_ARRAY[$valutazione])) {
            return Segnalazioni::VALUTAZIONI_ARRAY[$valutazione];
        }
        else
            return "invalid";
    }

    public static function getEsito(int $esito): string
    {
        if(isset(Segnalazioni::ESITO_ARRAY[$esito])) {
            return Segnalazioni::ESITO_ARRAY[$esito];
        }
        else
            return "invalid";
    }
}
