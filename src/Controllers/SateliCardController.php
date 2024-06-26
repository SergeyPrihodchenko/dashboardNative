<?php

namespace S\P\Controllers;

use S\P\Database\SateliRepository;
use S\P\Http\Request;
use S\P\Models\ClientSateli;
use S\P\Models\Sateli;

class SateliCardController {

    public static function dataByClient(Request $request): array
    {

        $ClientPhone = $request->getPostData('phone');

        $client = new Sateli();

        $client->setId($ClientPhone);

        $clientData =  $client->find([
            'client_code',
            'client_phone_id',
            'client_phone_date',
            'invoice_id',
            'invoice_status',
            'invoice_number',
            'invoice_date',
            'invoice_price'
         ]);

        $data['phone'] = $ClientPhone;
        $data['clientData'] = $clientData;

        return $data;
    }
}