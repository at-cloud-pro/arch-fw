<?php 

use ArchFW\Application;
use ArchAPI\Controller\Authenticator;

$json = [
    'state' => 'working',
    'apiMessage' => 'test went correct'
];

// EXAMPLE OF THROWING ERRORS:
// Application::error(404,"NOT FOUND", "json");

new Authenticator();

return $json;