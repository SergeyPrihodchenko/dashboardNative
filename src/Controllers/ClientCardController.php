<?php

namespace S\P\Controllers;

use S\P\Database\HylokRepository;
use S\P\Database\SwageloRepository;
use S\P\Database\WikaRepository;
use S\P\Http\Request;
use S\P\Models\Client;

class ClientCardController {

    public static function index(Request $request):array
    {

        $sites = [
            'hylok',
            'swagelo',
            'wika'
        ];

        $clientMail = $request->getParam('email');
        $site = $request->getParam('site');
        
        switch ($site) {
            case 'swagelo':
                $repo = new SwageloRepository;
                break;
            case 'hylok':
                $repo = new HylokRepository;
                break;
            case 'wika':
                $repo = new WikaRepository;
                break;
        }

        $client = new Client($clientMail, $repo);

        $clientData =  $client->getClientData([
            'client_id',
            'fluid_tag',
            'client_mail_id',
            'client_code',
            'invoice_id',
            'invoice_status',
            'invoice_number',
            'invoice_date',
            'invoice_price'
         ]);

        $data['clientMail'] = $clientMail;
        $data['site'] = $site;
        $data['sites'] = $sites;
        $data['clientData'] = $clientData;

        return $data;
    }
}