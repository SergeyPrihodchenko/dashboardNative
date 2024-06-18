<?php

use S\P\Controllers\ClientCardController;
use S\P\Controllers\ClientsDashboardController;
use S\P\Controllers\SateliDashboardController;
use S\P\Database\Connect;
use S\P\Http\Request;
use S\P\Templater\Stencli;

Connect::setAttributs(    
    'mysql',
    '172.17.0.1:20002',
    'DB',
    'dev',
    '123'
);

$route = parse_url($_SERVER['REQUEST_URI'])['path'];

$stencli = new Stencli(__DIR__ . '/../Views');

switch ($route) {
    case '/':
        
        $data = ClientsDashboardController::index(new Request());

        echo $stencli->render('templates/template', [
            'title' => 'Dashboard',
            'style' => $style,
            'script' => $script,
            'content' => $stencli->render('contents/dashboard', $data)
        ]);
        break;

    case '/sateli':
        
        $data = SateliDashboardController::index(new Request());

        echo $stencli->render('templates/template', [
            'title' => 'Sateli',
            'style' => $style,
            'script' => $script,
            'content' => $stencli->render('contents/dashboardSateli', $data)
        ]);
        break;
        
    case '/clientCard':

        $data = ClientCardController::index(new Request());

        echo $stencli->render('templates/template', [
            'title' => 'clientCard',
            'style' => $style,
            'script' => $script,
            'content' => $stencli->render('contents/emailCardDashboard', $data)
        ]);
        break;
    
    default:
        echo $stencli->render('templates/template', [
            'title' => 'Dashboard',
            'style' => $style,
            'script' => $script,
            'content' => $stencli->render('error/error', [])
        ]);
        break;
}