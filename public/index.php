<?php

use S\P\Database\Connect;
use S\P\Database\SateliRepository;
use S\P\Database\SwageloRepository;
use S\P\Exceptions\TemplateNotFoundException;
use S\P\Models\Client;
use S\P\Templater\Stencli;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../src/Router/router.php';

// $repository = new SwageloRepository();
// $client = new Client('jaS241KIUkhgDiWvRbJO3tcTNs8AHwf6', $repository);
// $test = $client->fullPayPrice(['invoice_status', 'invoice_price']);

// var_dump($test);

// $stencli = new Stencli(__DIR__ . '/../src/Views/');

// try {
//     echo $stencli->render('templates/template', [
//         'content' => $stencli->render('contents/dashboard', [])
//     ]);
// } catch (TemplateNotFoundException $e) {
//     var_dump($e->getMessage());
// }