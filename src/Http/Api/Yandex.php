<?php

namespace S\P\Http\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Promise;

final class Yandex {

    private string $authToken;
    public $client;

    public function __constract()
    {
        $this->authToken = $_SERVER['AUTH_TOKEN'];
        $client = new Promise();

        var_dump($client);
    }

}

