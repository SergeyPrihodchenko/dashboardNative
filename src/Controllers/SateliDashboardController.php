<?php

namespace S\P\Controllers;

use S\P\Database\SateliRepository;
use S\P\Http\Request;
use S\P\Models\ClientSateli;

class SateliDashboardController {

    public static function index()
    {

    }

    public static function phoneDashboardData(Request $request): array
    {
        $limit = 30;
        $page = 1;
        $allClients = ClientSateli::getAllClients(new SateliRepository, $limit, $page);
        foreach ($allClients as $key => $client) {
            $client = new ClientSateli($client['client_phone'], new SateliRepository);
            $allClients[$key]['createdBill'] = $client->totalPrice(0)['bill'];
            $allClients[$key]['outputBill'] = $client->totalPrice(1)['bill'];
            $allClients[$key]['closeBill'] = $client->totalPrice(2)['bill'];
            $allClients[$key]['countCreatedBill'] = $client->totalPrice(0)['countBills'];
            $allClients[$key]['countOutputBill'] = $client->totalPrice(1)['countBills'];
            $allClients[$key]['countCloseBill'] = $client->totalPrice(2)['countBills'];
        }

        $data['clients'] = $allClients;

        return $data;
    }
}