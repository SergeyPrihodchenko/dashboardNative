<?php

namespace S\P\Controllers;

use S\P\Database\HylokRepository;
use S\P\Http\Request;
use S\P\Models\Client;

class ClientsDashboardController {

    public static function index()
    {
        $allClients = Client::getAllClients(new HylokRepository());

        return $allClients;
    }
}