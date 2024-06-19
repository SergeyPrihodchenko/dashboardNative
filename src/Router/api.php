<?php

use S\P\Controllers\ClientCardController;
use S\P\Controllers\ClientsDashboardController;
use S\P\Controllers\SateliDashboardController;
use S\P\Database\Connect;
use S\P\Database\HylokRepository;
use S\P\Http\Request;
use S\P\Models\Client;
use S\P\Templater\Stencli;

Connect::setAttributs(    
    'mysql',
    '172.17.0.1:20002',
    'DB',
    'dev',
    '123'
);

$route = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];


if($method == 'POST') {
    switch ($route) {
        case '/api/email':
            
            $data = ClientsDashboardController::index(new Request());

            header('Content-Type: application/json');

            echo json_encode($data);

            break;
    
        case '/sateli':
            
            $data = SateliDashboardController::index(new Request());
    
    
            break;
            
        case '/api/clientCard':
    
            $data = ClientCardController::index(new Request());
    
            echo json_encode($data);
            break;
        
        default:
    
            break;
    }

}