<?php

namespace app\models;

use Exception;
use Yii;
use yii\httpclient\Client;

/**
 * This is the model class for table "notizia".
 *
 * @property int $id
 * @property string $link
 * @property string $descrizione_notizia
 * @property int|null $tipo_categoria
 * @property int|null $fonte
 * @property int $indice_attendibilita
 * @property string $data_pubblicazione
 * @property string|null $data_accaduto
 * @property string|null $coinvolgimento
 *
 * @property Fonte $fonte0
 * @property Categoria $tipoCategoria
 */
class Notizia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notizia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'link', 'descrizione_notizia', 'indice_attendibilita', 'data_pubblicazione'], 'required'],
            [['id', 'tipo_categoria', 'fonte', 'indice_attendibilita'], 'integer'],
            [['data_pubblicazione', 'data_accaduto'], 'safe'],
            [['link'], 'string', 'max' => 2600],
            [['descrizione_notizia', 'coinvolgimento'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['tipo_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['tipo_categoria' => 'id_categoria']],
            [['fonte'], 'exist', 'skipOnError' => true, 'targetClass' => Fonte::class, 'targetAttribute' => ['fonte' => 'id_fonte']],
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
            'descrizione_notizia' => 'Descrizione Notizia',
            'tipo_categoria' => 'Tipo Categoria',
            'fonte' => 'Fonte',
            'indice_attendibilita' => 'Indice Attendibilita',
            'data_pubblicazione' => 'Data Pubblicazione',
            'data_accaduto' => 'Data Accaduto',
            'coinvolgimento' => 'Coinvolgimento',
        ];
    }

    /**
     * Gets query for [[Fonte0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFonte0()
    {
        return $this->hasOne(Fonte::class, ['id_fonte' => 'fonte']);
    }

    /**
     * Gets query for [[TipoCategoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoCategoria()
    {
        return $this->hasOne(Categoria::class, ['id_categoria' => 'tipo_categoria']);
    }

    public static function calculateNotizia(string $url) {
        $client = new Client();
        $key = 'AIzaSyByXBZw2RxpQ3nxXuaI3aGPAKUSocXnYfk';
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('https://factchecktools.googleapis.com/v1alpha1/claims:search?query='.$url.'&key='.$key)
            ->send();
        if ($response->isOk) {
            $claim = $response->data['claims'][0];
            if($claim) {
                $notizia = new Notizia();
                $notizia->id = Notizia::find()->max('id');
                if ($notizia->id == null)
                    $notizia->id = 1;
                else
                    $notizia->id++;
                $notizia->link = $url;
                $notizia->descrizione_notizia = $claim['text'];
                $notizia->tipo_categoria = 1;
                $notizia->fonte = 1;
                $notizia->indice_attendibilita = 0;
                $notizia->data_pubblicazione = $claim['claimDate'];
                $notizia->data_accaduto = $claim['claimDate'];
                $notizia->coinvolgimento = "pippo";
                $notizia->save();
                return $notizia;
            }
        }
        throw new Exception($response);
        return null;
    }
}
