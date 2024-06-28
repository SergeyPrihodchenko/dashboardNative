<?php

namespace S\P\Controllers;

use S\P\Exceptions\RequestException;
use S\P\Http\Request;
use S\P\Models\General\GeneralWika;
use S\P\Models\InvoiceMail\Hylok;
use S\P\Models\InvoiceMail\Swagelo;
use S\P\Models\InvoiceMail\Wika;

class ClientCardController {

    public static function dataByClient(Request $request):array
    {

        try {

            $clientMail = $request->getPostData('mail');
            $site = $request->getPostData('site');
            $clientId = $request->getPostData('id');
        
        } catch (RequestException $e) {
            
            // redirect

        }
        
        // switch ($site) {
        //     case 'swagelo':
        //         $client = new Swagelo;
        //         break;
        //     case 'hylok':
        //         $client = new Hylok;
        //         break;
        //     case 'wika':
        //         $client = new Wika;
        //         break;
        // }


        $generalWika = new GeneralWika;
        $data['data'] = $generalWika->buildData($clientMail);

        $data['clientMail'] = $clientMail;
        $data['site'] = $site;

        return $data;
    }
}