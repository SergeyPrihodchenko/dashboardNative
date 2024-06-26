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
        $clients = $client->lazyAllUniqClients(['client_phone'], (int)$page);
        foreach ($clients as $key => $clientData) {
            $client->setId($clientData['client_phone']);
            $clients[$key]['createdBill'] = $client->totalCostByStatus(0, (int)$page)['bill'];
            $clients[$key]['outputBill'] = $client->totalCostByStatus(1, (int)$page)['bill'];
            $clients[$key]['closeBill'] = $client->totalCostByStatus(2, (int)$page)['bill'];
            $clients[$key]['countCreatedBill'] = $client->totalCostByStatus(0, (int)$page)['countBills'];
            $clients[$key]['countOutputBill'] = $client->totalCostByStatus(1, (int)$page)['countBills'];
            $clients[$key]['countCloseBill'] = $client->totalCostByStatus(2, (int)$page)['countBills'];
        }

        $data['clients'] = $clients;

        return $data;
    }
}