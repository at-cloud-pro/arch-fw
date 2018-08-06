<?php 

use ArchFW\Application;
use Examples\Controller\Authenticator;

// Example of safe authenticate
new Authenticator("region");

$json = [
    'state' => 'working',
    'apiMessage' => 'test went correct'
];

// EXAMPLE OF THROWING ERRORS:
// Application::error(404,"NOT FOUND", "json");


return $json;