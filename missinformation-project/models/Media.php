<?php

namespace app\models;

use Yii;
use app\models\MediaNotizia;

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
    public const EXTENSIONS_IMAGE = ['jpg', 'jpeg', 'jpe', 'jif', 'jfif', 'jfi', 'png', 'gif', 'webp', 'svg', 'svgz'];
    public const EXTENSIONS_AUDIO = ['3gp', 'aac', 'act', 'amr', 'awb', 'flac', 'gsm', 'm4a', 'm4b', 'mp3', 'mpc', 'raw', 'rf64', 'sln', 'tta', 'vox', 'wav', 'wv', 'webm', 'cda',];
    public const EXTENSIONS_VIDEO = ['webm', 'mkv', 'flv', 'flv', 'vob', 'ogv', 'ogg', 'drc', 'gif', 'gifv', 'mng', 'avi', 'MTS', 'M2TS', 'TS', 'mov', 'qt', 'wmv', 'yuv', 'rm', 'rmvb', 'viv', 'asf', 'amv', 'mp4', 'm4p', 'm4v', 'mpg', 'mp2', 'mpeg', 'mpe', 'mpv', 'mpg', 'mpeg', 'm2v', 'm4v', 'svi', '3gp', '3g2', 'mxf', 'roq', 'nsv', 'flv', 'f4v', 'f4p', 'f4a', 'f4b'];
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

    public function isImage($estensione)
    {
        return in_array($estensione, Media::EXTENSIONS_IMAGE);
    }

    public function isAudio($estensione)
    {
        return in_array($estensione, Media::EXTENSIONS_AUDIO);
    }

    public function isVideo($estensione)
    {
        return in_array($estensione, Media::EXTENSIONS_VIDEO);
    }

    public function retriveMedia($id)
    {
        //inner join tra media_notizia e media con id notizia di media notizia = id

        // $query = Media::find()
        //     ->innerJoinWith("media_notizia", "media_notizia.id_media = media.id")
        //     ->andWhere(['media_notizia.id_media' => $id])
        //     ->all();

        $query = Media::find()
            ->innerJoin("media_notizia", true)
            ->where("media.id = media_notizia.id_media")
            ->andWhere(["media_notizia.id_notizia" => $id])
            ->all();

        return $query;
    }

    public function retriveNews($id)
    {
        $query = Notizia::find()
            ->innerJoin("media_notizia", true)
            ->where("notizia.id = media_notizia.id_notizia")
            ->andWhere(["media_notizia.id_media" => $id])
            ->all();

        return $query;
    }

    public function calculateIndice()
    {
        $list_news = $this->retriveNews($this->id);

        $index = 0;
        $i = 0;
        foreach($list_news as $news) {
            $index += $news->indice_attendibilita;
            $i++;
        }

        $index = $index / $i;
        $this->indice_attendibilita = $index;
        $this->save();
    }
}