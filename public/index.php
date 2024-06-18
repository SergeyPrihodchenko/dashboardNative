<?php

use S\P\Database\Connect;
use S\P\Database\HylokRepository;
use S\P\Database\SateliRepository;
use S\P\Database\SwageloRepository;
use S\P\Exceptions\TemplateNotFoundException;
use S\P\Models\Client;
use S\P\Templater\Stencli;

require_once __DIR__ . '/../vendor/autoload.php';

$script = 'scripts/dashboard.js';
$style = 'styles/style.css';

require_once __DIR__ . '/../src/Router/router.php';
