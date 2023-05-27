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
 */
class Segnalazioni extends \yii\db\ActiveRecord
{
    public const VALUTAZIONI_ARRAY = [
        0 => 'It\'s unreliable', 
        25 => 'It\'s mostly unrealible', 
        50 => 'I don\'t know', 
        75 => 'It\'s mostrly reliable', 
        100 => 'It\'s reliable'
    ];
    
    public const ESITO_ARRAY = [
        0 => '-----',
        1 => 'Reliable',
        -1 => 'Not reliable'
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
            [['id', 'url', 'motivo', 'valutazione'], 'required'],
            [['id', 'valutazione', 'esito'], 'integer'],
            [['url'], 'string', 'max' => 50],
            [['motivo'], 'string', 'max' => 200],
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
