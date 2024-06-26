<?php

namespace S\P\Controllers;

use S\P\Database\Connect;
use S\P\Database\HylokRepository;
use S\P\Database\NSiteClientRepository;
use S\P\Database\SwageloRepository;
use S\P\Database\WikaRepository;
use S\P\Exceptions\RequestException;
use S\P\Http\Request;
use S\P\Models\Client;
use S\P\Models\Hylok;
use S\P\Models\Swagelo;
use S\P\Models\Wika;

class ClientsDashboardController {

    public static function index(Request $request): array
    {
        $data = [];

        $sites = [
            'hylok',
            'swagelo',
            'wika'
        ];

        $data['sites'] = $sites;

        return $data;
    }

    public static function emailDashboardData(Request $request): array
    {
        $data = [];

        try {
            $site = $request->getPostData('titleSite');
            $limit = 30;
            $page = $request->getPostData('page');

        } catch (RequestException $e) {
            $site = 'default';
        }

        switch ($site) {
            case 'hylok':
               $client = new Hylok();
               $ParamSite = 'hylok';
                break;
            case 'swagelo':
                $client = new Swagelo();
                $ParamSite = 'swagelo';
                break;
            case 'wika':
                $client = new Wika();
                $ParamSite = 'wika';
                break;
            
            default:
                $client = new Hylok();
                $ParamSite = 'hylok';
                break;
        }

        $allClients = $client->allUniqClients(['client_mail']);
        foreach ($allClients as $key => $dataClient) {
            
            $client->setId($dataClient['client_mail']);
            $allClients[$key]['createdBill'] = $client->totalCostByStatus(0, 1)['bill'];
            $allClients[$key]['outputBill'] = $client->totalCostByStatus(1, 1)['bill'];
            $allClients[$key]['closeBill'] = $client->totalCostByStatus(2, 1)['bill'];
            $allClients[$key]['countCreatedBill'] = $client->totalCostByStatus(0, 1)['countBills'];
            $allClients[$key]['countOutputBill'] = $client->totalCostByStatus(1, 1)['countBills'];
            $allClients[$key]['countCloseBill'] = $client->totalCostByStatus(2, 1)['countBills'];
        }

        $data['clients'] = $allClients;
        $data['site'] = $ParamSite;
        $data['paramSite'] = $ParamSite;

        return $data;
    }
}