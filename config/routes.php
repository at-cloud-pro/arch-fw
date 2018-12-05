<?php


return [
    # Add adresses to our router. Key here is a URL adress user enters, and value is name of wrapper and twig files.
    # When file is in subdirectory, you can use '/', e.g. 'login/recoverpassword'.
    'APProuter'         => [
        '/' => 'index'
    ],

    # Router in API is matching URL (key here) and wrapper file name (value here)
    'APIrouter'         => [
        '/test'        => 'test',
        '/routercheck' => 'routercheck',
        '/auth'        => 'auth'
    ],

    # Redirect all routes that does not match the above scheme to other, defined above route
    # set FALSE to turn off this function
    # set STRING with route to turn on this function
    'redirectOnNoMatch' => '/'

];
