<?php

namespace S\P\Controllers;

use S\P\Database\SateliRepository;
use S\P\Http\Request;
use S\P\Models\ClientSateli;
use S\P\Models\Sateli;

class SateliDashboardController {

    public static function index()
    {

    }

    public static function phoneDashboardData(Request $request): array
    {
        $page = 1;
        $client = new Sateli();
        $allClients = $client->lazyAllUniqClients(['client_phone'], $page);
        foreach ($allClients as $key => $clientData) {
            $client->setId($clientData['client_phone']);
            $allClients[$key]['createdBill'] = $client->totalCostByStatus(0, $page)['bill'];
            $allClients[$key]['outputBill'] = $client->totalCostByStatus(1, $page)['bill'];
            $allClients[$key]['closeBill'] = $client->totalCostByStatus(2, $page)['bill'];
            $allClients[$key]['countCreatedBill'] = $client->totalCostByStatus(0, $page)['countBills'];
            $allClients[$key]['countOutputBill'] = $client->totalCostByStatus(1, $page)['countBills'];
            $allClients[$key]['countCloseBill'] = $client->totalCostByStatus(2, $page)['countBills'];
        }

        $data['clients'] = $allClients;

        return $data;
    }
}