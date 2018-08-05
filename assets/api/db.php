<?php

 
// Initialize

$db = new \ArchFW\Controller\DatabaseTest();

$data = $db->dl();
 
return $data;