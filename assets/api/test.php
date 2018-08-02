<?php 

use ArchFW\Application;

$json = [
    'state' => 'working',
    'apiMessage' => 'test went correct'
];

// EXAMPLE OF THROWING ERRORS:
Application::error(404,"NOT FOUND", "json");

return $json;