<?php

namespace S\P\Controllers;

use S\P\Exceptions\RequestException;
use S\P\Http\Request;
use S\P\Models\Hylok;
use S\P\Models\Swagelo;
use S\P\Models\Wika;

class ClientCardController {

    public static function dataByClient(Request $request):array
    {

        try {

            $clientMail = $request->getPostData('mail');
            $site = $request->getPostData('site');
            $page = $request->getPostData('page');

        } catch (RequestException $e) {
            
            // redirect

        }
        
        switch ($site) {
            case 'swagelo':
                $client = new Swagelo;
                break;
            case 'hylok':
                $client = new Hylok;
                break;
            case 'wika':
                $client = new Wika;
                break;
        }

        $client->setId($clientMail);

        $clientData =  $client->lazyFind([
            'client_id',
            'fluid_tag',
            'client_mail_id',
            'client_code',
            'invoice_id',
            'invoice_status',
            'invoice_number',
            'invoice_date',
            'invoice_price'
         ], $page);

        $data['clientMail'] = $clientMail;
        $data['site'] = $site;
        $data['clientData'] = $clientData;

        return $data;
    }
}