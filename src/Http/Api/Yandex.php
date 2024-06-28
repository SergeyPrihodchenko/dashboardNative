<?php

namespace S\P\Http\Api;

use GuzzleHttp\Client;

final class Yandex {

    private Client $client;
    private const YANDEX_URL = 'https://api-metrika.yandex.net/';
    private $dateFrom;
    private $dateTo;

    public function __construct(
        private string $token,
        private string $counter_id,
    )
    {
        $this->token = $token;
        $this->client = new Client(['base_uri' => Yandex::YANDEX_URL]);
        $this->dateFrom = date('Y-m-d', mktime(0,0,0,0,0,2018));
        $this->dateTo = date('Y-m-d');
    }

    private function fetch(string $id, $counter = 1) 
    {
        $result = $this->client->request('GET', 'stat/v1/data', [
            'headers' => [
                'Authorization' => $this->token,
                'Content-Type' => 'application/x-yametrika+json'
            ],
            'query' => [
                'accuracy' => 1,
                'preset' => 'sources_search_phrases',
                'ids' => $this->counter_id,
                'metrics' => 'ym:s:visits,ym:s:users',
                'date1' => $this->dateFrom,
                'date2' => $this->dateTo,
                'dimensions' => 'ym:s:clientID,ym:s:firstVisitDate,ym:s:startURL',
                'filters' => "ym:s:clientID=={$id}",
                'limit' => 10000
            ]
        ]);

        if($counter == 3) {
            file_put_contents(__DIR__ . '/api_logs.txt', 'Ошибка при запросе к яндекс метрике' . "\n", FILE_APPEND);
            exit();
        }

        $status = $result->getStatusCode();

        if($status != '200') {

            $counter = $counter + 1;
            sleep(3);

            $this->fetch($id, $counter);

        }

        $data = $result->getBody();

        return $data;
    }

    public function metricById($id): array
    {
       $data = $this->fetch($id);

       $data = json_decode($data, true);

       return $data;
    }
}