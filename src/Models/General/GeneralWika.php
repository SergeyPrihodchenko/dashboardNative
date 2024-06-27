<?php

namespace S\P\Models\General;

use Exception;
use S\P\Http\Api\Yandex;
use S\P\Models\InvoiceMail\Wika;
use S\P\Models\Visitors\WikaVisitors;

class General {

    private Yandex $yandex;
    private Wika $wika;
    private WikaVisitors $visitors;

    public function __construct(  
    )
    {
        $this->yandex = new Yandex($_SERVER['AUTH_TOKEN'], $_SERVER['COUNTER_ID']);
        $this->wika = new Wika;
        $this->visitors = new WikaVisitors;
    }

    public function setId(string $id, $settings): void
    {
        switch ($settings) {
            case Wika::class:
                $this->wika->setId($id);
                break;
            case WikaVisitors::class:
                $this->visitors->setId($id);
                break;
            
            default:
                throw new \Exception('Dont right setting for : ' . self::class);
                break;
        }
    }

    private function buildData()
    {
        
    }
}