<?php

namespace S\P\Controllers;

use S\P\Database\SateliRepository;
use S\P\Http\Request;
use S\P\Models\ClientSateli;

class SateliCardController {

    public static function index(Request $request): array
    {

        $ClientPhone = $request->getParam('phone');

        $client = new ClientSateli($ClientPhone, new SateliRepository);

        $clientData =  $client->getClientData([
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
    public static function dataByClient(Request $request): array
    {

        $ClientPhone = $request->getPostData('phone');

        $client = new ClientSateli($ClientPhone, new SateliRepository);

        $clientData =  $client->getClientData([
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