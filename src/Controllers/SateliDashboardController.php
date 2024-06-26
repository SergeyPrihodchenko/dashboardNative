<?php

namespace S\P\Controllers;

use S\P\Http\Request;
use S\P\Models\Sateli;

class SateliDashboardController {

    public static function index()
    {

    }

    public static function phoneDashboardData(Request $request): array
    {
        $page = $request->getPostData('page');

        $client = new Sateli();
        $allClients = $client->lazyAllUniqClients(['client_phone'], (int)$page);
        foreach ($allClients as $key => $clientData) {
            $client->setId($clientData['client_phone']);
            $allClients[$key]['createdBill'] = $client->totalCostByStatus(0, (int)$page)['bill'];
            $allClients[$key]['outputBill'] = $client->totalCostByStatus(1, (int)$page)['bill'];
            $allClients[$key]['closeBill'] = $client->totalCostByStatus(2, (int)$page)['bill'];
            $allClients[$key]['countCreatedBill'] = $client->totalCostByStatus(0, (int)$page)['countBills'];
            $allClients[$key]['countOutputBill'] = $client->totalCostByStatus(1, (int)$page)['countBills'];
            $allClients[$key]['countCloseBill'] = $client->totalCostByStatus(2, (int)$page)['countBills'];
        }

        $data['clients'] = $allClients;

        return $data;
    }
}