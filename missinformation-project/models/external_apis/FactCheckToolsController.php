<?php

namespace app\models\external_apis;

use Yii;
use yii\httpclient\Client;

class FactCheckToolsController
{
    private const _url = "https://factchecktools.googleapis.com/v1alpha1/";
    private const _api_key = "AIzaSyByXBZw2RxpQ3nxXuaI3aGPAKUSocXnYfk";
    private $client;

    public function __construct() {
        $this->client = new Client(['baseUrl' => FactCheckToolsController::_url]);
    }

    public function search(string $url) {
        return $this->client->get('claims:search', ["query" => $url, "key" => FactCheckToolsController::_api_key])->send();
    }

}

?>