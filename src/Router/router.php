<?php

use S\P\Controllers\ClientsDashboardController;
use S\P\Database\Connect;
use S\P\Templater\Stencli;

Connect::setAttributs(    
    'mysql',
    '172.17.0.1:20002',
    'DB',
    'dev',
    '123'
);

$route = $_SERVER['REQUEST_URI'];

$stencli = new Stencli(__DIR__ . '/../Views');

switch ($route) {
    case '/':
        
        $data = ClientsDashboardController::index();

        echo $stencli->render('templates/template', [
            'title' => 'Dashboard',
            'style' => $style,
            'script' => $script,
            'content' => $stencli->render('contents/dashboard', [
                'data' => $data,
            ])
        ]);
        break;
        
    case '/client':  
        echo $stencli->render('templates/template', [
            'title' => 'Dashboard',
            'style' => $style,
            'script' => $script,
            'content' => $stencli->render('contents/clientDashboard', [])
        ]);
        break;
    case '/':  
        echo $stencli->render('templates/template', [
            'title' => 'Dashboard',
            'style' => $style,
            'script' => $script,
            'content' => $stencli->render('contents/dashboard', [])
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