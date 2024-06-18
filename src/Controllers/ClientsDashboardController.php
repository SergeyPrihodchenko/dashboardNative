<?php

namespace S\P\Controllers;

use S\P\Database\HylokRepository;
use S\P\Database\SwageloRepository;
use S\P\Database\WikaRepository;
use S\P\Exceptions\RequestException;
use S\P\Http\Request;
use S\P\Models\Client;

class ClientsDashboardController {

    public static function index(Request $request): array
    {
        $data = [];

        $sites = [
            'hylok',
            'swagelo',
            'wika'
        ];

        try {
            $site = $request->getParam('titleSite');
        } catch (RequestException $e) {
            $site = 'default';
        }

        switch ($site) {
            case 'hylok':
               $repo = new HylokRepository();
               $ParamSite = 'hylok';
                break;
            case 'swagelo':
                $repo = new SwageloRepository();
                $ParamSite = 'swagelo';
                break;
            case 'wika':
                $repo = new WikaRepository();
                $ParamSite = 'wika';
                break;
            
            default:
                $repo = new HylokRepository();
                $ParamSite = 'hylok';
                break;
        }

        $allClients = Client::getAllClients($repo);
        foreach ($allClients as $key => $client) {
            
            $client = new Client($client['client_mail'], $repo);
            $allClients[$key]['createdBill'] = $client->totalPrice(0)['bill'];
            $allClients[$key]['outputBill'] = $client->totalPrice(1)['bill'];
            $allClients[$key]['closeBill'] = $client->totalPrice(2)['bill'];
            $allClients[$key]['countCreatedBill'] = $client->totalPrice(0)['countBills'];
            $allClients[$key]['countOutputBill'] = $client->totalPrice(1)['countBills'];
            $allClients[$key]['countCloseBill'] = $client->totalPrice(2)['countBills'];
        }

        $data['clients'] = $allClients;
        $data['sites'] = $sites;
        $data['paramSite'] = $ParamSite;
        return $data;
    }
}