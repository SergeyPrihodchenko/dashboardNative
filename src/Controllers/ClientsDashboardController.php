<?php

namespace S\P\Controllers;

use S\P\Exceptions\RequestException;
use S\P\Http\Request;
use S\P\Models\Hylok;
use S\P\Models\Swagelo;
use S\P\Models\Wika;

class ClientsDashboardController {

    public static function index(): array
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
            $page = $request->getPostData('page');

        } catch (RequestException $e) {

            if(!isset($page)) {
                $page = 1;
            }

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

        $allClients = $client->lazyAllUniqClients(['client_mail'], (int)$page);
        foreach ($allClients as $key => $dataClient) {
            
            $client->setId($dataClient['client_mail']);
            $allClients[$key]['createdBill'] = $client->totalCostByStatus(0, (int)$page)['bill'];
            $allClients[$key]['outputBill'] = $client->totalCostByStatus(1, (int)$page)['bill'];
            $allClients[$key]['closeBill'] = $client->totalCostByStatus(2, (int)$page)['bill'];
            $allClients[$key]['countCreatedBill'] = $client->totalCostByStatus(0, (int)$page)['countBills'];
            $allClients[$key]['countOutputBill'] = $client->totalCostByStatus(1, (int)$page)['countBills'];
            $allClients[$key]['countCloseBill'] = $client->totalCostByStatus(2, (int)$page)['countBills'];
        }

        $data['clients'] = $allClients;
        $data['site'] = $ParamSite;
        $data['paramSite'] = $ParamSite;

        return $data;
    }
}