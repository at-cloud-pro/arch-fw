<?php

return [

    /*
     * Directory where view classes are located. Only classes in this directory can be called.
     * With below routingPaths it should create Full Qualified class name to be called.
     */
    'safeClassCalloutPath' => [
        'application' => 'ArchFW\Views\HTMLViews',
        'api'         => 'ArchFW\Views\JSONViews',
    ],

    /*
     * Here are stored
     */
    'routingPaths'         => [
        'application' => [
            '' => [
                'class'    => 'InitialScreen',
                'template' => 'index.twig',
            ],
        ],
        'api'         => [
            'test' => 'InitialScreen',
        ],
    ],

    /*
     Redirect all routes that does not match the above scheme to other, defined above route
     set FALSE to turn off this function
     set STRING with route to turn on this function
    */
    'redirectOnNoMatch'    => '/',

];
