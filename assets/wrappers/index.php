<?php

use ArchFW\Controller\Mailer;

new Mailer([
    'to' => 'Allaya Rosah',
    'email' => 'alleluja669@gmail.com'
],
"Tytuł Maila",
"Treść maila",
true,
false
);
die;


return ['test'=> 'działa'];