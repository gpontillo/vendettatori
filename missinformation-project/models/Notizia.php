<?php

namespace app\models;

use Exception;
use Yii;
use app\models\external_apis\FactCheckToolsController;
use app\models\external_apis\WorldNewsController;

/**
 * This is the model class for table "{{%notizia}}".
 *
 * @property int $id
 * @property string $link
 * @property string $descrizione_notizia
 * @property string|null $argomento
 * @property int|null $fonte
 * @property int $indice_attendibilita
 * @property string $data_pubblicazione
 * @property string|null $data_accaduto
 * @property string|null $coinvolgimento
 * @property string|null $luogo
 * @property int $from_api
 *
 * @property Fonte $fonte0
 */
class Notizia extends \yii\db\ActiveRecord
{
    public const separatorSoggetti = ';';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%notizia}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'link', 'descrizione_notizia', 'indice_attendibilita', 'data_pubblicazione'], 'required'],
            [['id', 'fonte', 'indice_attendibilita', 'from_api'], 'integer'],
            [['data_pubblicazione', 'data_accaduto'], 'safe'],
            [['link'], 'string', 'max' => 2600],
            [['descrizione_notizia', 'argomento', 'coinvolgimento'], 'string', 'max' => 255],
            [['luogo'], 'string', 'max' => 20],
            [['id'], 'unique'],
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
            'argomento' => 'Argomento',
            'fonte' => 'Fonte',
            'indice_attendibilita' => 'Indice Attendibilita',
            'data_pubblicazione' => 'Data Pubblicazione',
            'data_accaduto' => 'Data Accaduto',
            'coinvolgimento' => 'Coinvolgimento',
            'luogo' => 'Luogo',
            'from_api' => 'From Api',
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

    private static function filterEntities($entities, int $mode = 0): string
    {
        /* values of mode:
            - '0' : all subjects
            - '1' : remove locations
            - '2' : only locations
        */
        $list_entities = "";

        foreach ($entities as $entity) {
            if ($mode == 0 || ($mode == 1 && $entity['type'] != 'LOC') || ($mode == 2 && $entity['type'] == 'LOC')) {
                $list_entities = $list_entities . $entity['name'] . ';';
            }
        }

        $list_entities2 = substr($list_entities, 0, -1);
        if ($list_entities2 != false)
            $list_entities = $list_entities2;

        return $list_entities;
    }

    private static function findFonte($url)
    {
        $scomposedUrl = parse_url($url);
        $composedUrl = $scomposedUrl['scheme'] . '://' . $scomposedUrl['host'];

        $id_fonte = Fonte::find()->select(['id_fonte'])->where(['link_fonte' => $composedUrl])->one();
        if ($id_fonte !== null)
            return $id_fonte;
        else {
            $newFonte = new Fonte();
            $newFonte->id_fonte = Fonte::find()->max('id_fonte');
            if ($newFonte->id_fonte == null)
                $newFonte->id_fonte = 1;
            else
                $newFonte->id_fonte++;
            $newFonte->descrizione_fonte = "Source calculated with API";
            $newFonte->link_fonte = $composedUrl;
            $newFonte->indice_fonte = 0;
            $newFonte->save();
            return $newFonte->id_fonte;
        }
    }

    public static function calculateNotizia(string $url)
    {
        $client = new FactCheckToolsController();
        $response = $client->search($url);
        if ($response->isOk) {
            $notizia = Notizia::generateNotizia($url);
            if (array_key_exists('claims',$response->data)) {
                $claim = $response->data['claims'][0];
                if ($claim) {
                    $notizia->indice_attendibilita = 0;
                    $notizia->from_api = 1;
                }
            }
            if (!$notizia->save()) {
                throw new Exception("Error on save");
            };
            return $notizia;
        } else {
            throw new Exception($response);
        }
    }

    public static function generateNotizia(string $url): Notizia
    {
        $client = new WorldNewsController();
        $response = $client->extract($url);
        if ($response->isOk) {
            $notizia = new Notizia();
            $notizia->id = Notizia::find()->max('id');
            if ($notizia->id == null)
                $notizia->id = 1;
            else
                $notizia->id++;
            $notizia->link = $url;
            $notizia->descrizione_notizia = $response->data['title'];
            $notizia->argomento = Notizia::filterEntities($response->data["entities"], 0);
            $notizia->fonte = Notizia::findFonte($url);
            $notizia->data_pubblicazione = $response->data['publish_date'];
            $notizia->data_accaduto = $response->data['publish_date'];
            $notizia->coinvolgimento = Notizia::filterEntities($response->data["entities"], 1);
            $notizia->indice_attendibilita = -1;
            $notizia->luogo = Notizia::filterEntities($response->data["entities"], 2);
            $notizia->from_api = 0;
        } else {
            throw new Exception($response);
        }
        return $notizia;
    }
}
