<?php

namespace app\models;

use Yii;
use app\models\Notizia;


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
            [['link_fonte'], 'string', 'max' => 255],
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

    public function calcolaIndiceFonte()
    {
        $news = (new \yii\db\Query())
            ->select(['indice_attendibilita'])
            ->from('notizia')
            ->where(['fonte' => $this->id_fonte])
            ->all();


        $secondResult = (new \yii\db\Query())
        ->select(['id_fonte'])
        ->from('fonte')
        ->join('INNER JOIN', 'notizia', 'fonte = id_fonte')
        ->all();


        $sum = 0;
        $i = 0;

        foreach($news as $row):
            foreach($row as $r):
                $sum += $r;
                $i++;
            endforeach;
        endforeach;


        $toPass = null;

        foreach($secondResult as $row):
            $toPass = $row;
        endforeach;

        if($i == 0) $media = 0;
        else $media = $sum / $i;

        $media = $sum / $i;

        $this->indice_fonte = round($media, 0);
        $this->update();
    }
}
