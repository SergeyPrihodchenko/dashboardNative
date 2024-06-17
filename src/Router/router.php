<?php

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
        
        $stencli->render('templates/template', [
            'style' => $style,
            'script' => $script,
            $stencli->render('contents/dashboard', [])
        ]);
        break;
    
    default:
        # code...
        break;
}