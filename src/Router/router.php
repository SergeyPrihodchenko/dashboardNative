<?php

use S\P\Controllers\ClientCardController;
use S\P\Controllers\ClientsDashboardController;
use S\P\Controllers\SateliCardController;
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
$method = $_SERVER['REQUEST_METHOD'];

$stencli = new Stencli(__DIR__ . '/../Views');


switch ($method) {
    case 'GET':
    
        switch ($route) {
            case '/':
                
                $data = ClientsDashboardController::index(new Request());
                $style = 'styles/style.css';
                $script = 'scripts/emailDashboard.js';
                $data['modal'] = $stencli->render('components/modalClientCard');
        
                echo $stencli->render('templates/template', [
                    'title' => 'Dashboard',
                    'style' => $style,
                    'script' => $script,
                    'content' => $stencli->render('contents/dashboard', $data),
                ]);
                break;
        
            case '/sateli':
                
                $data = [];
                $title = 'Sateli';
                $script = 'scripts/phoneDashboard.js';
                $style = 'styles/style.css';
                $data['modal'] = $stencli->render('components/modalClientCard');
        
                echo $stencli->render('templates/template', [
                    'title' => 'Sateli',
                    'style' => $style,
                    'script' => $script,
                    'content' => $stencli->render('contents/dashboardSateli', $data)
                ]);
                break;
            
            default:
                echo $stencli->render('templates/template', [
                    'title' => 'Error',
                    'content' => $stencli->render('error/error', [])
                ]);
                break;
        }
        break;
    
    case 'POST':
            switch ($route) {
//***************************************************EMAIL POST */
                case '/emailDashboardData':
                    
                    $data = ClientsDashboardController::emailDashboardData(new Request);
                    echo json_encode($data);
                    break;

                case '/emailClientCard':
                    
                    $data = ClientCardController::dataByClient(new Request());
                    echo json_encode($data);
                    break;
//*****************************************************PHONE POST */
                    case '/phoneDashboardData':
                    
                        $data = SateliDashboardController::phoneDashboardData(new Request);
                        echo json_encode($data);
                        break;

                case '/phoneClientCard':
                    
                    $data = SateliCardController::dataByClient(new Request());
                    echo json_encode($data);
                    break;
                
                default:
                    # code...
                    break;
            }
        break;
}
