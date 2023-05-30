<?php

namespace app\models\external_apis;

use Yii;
use yii\httpclient\Client;

class WorldNewsController
{
    private const _url = "https://api.worldnewsapi.com/";
    private const _api_key = "425d05eae0364df492097017d430646c";
    private $client;

    public function __construct() {
        $this->client = new Client(['baseUrl' => WorldNewsController::_url]);
    }

    public function extract(string $url) {
        return $this->client->get('extract-news', ["analyze" => "true", "url" => $url, "api-key" => WorldNewsController::_api_key])->send();
    }

}

?>