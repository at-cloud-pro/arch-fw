<?php

namespace ArchAPI\Model;

use ArchAPI\Model\APIClientLogger;

final class APISecureClient
{
    const POST = 'post';
    const GET = 'get';

    private $_auth;

    public function __construct(APIClientLogger $auth)
    {
        $this->_auth = $auth;
        // 
        // $homepage = file_get_contents("http://example.com/file", false, $context );
    }

    public function post(string $relative, array $data = null)
    {
        if(is_array($data))
        {
            
        }
        $context = stream_context_create(
            ['http' =>[
                'method' => 'POST',
                'header' => [ "Authorization: Basic $auth \r\n"
                , "Content-type: application/x-www-form-urlencoded \r\n"]
                ],
                'content' => $_POST
                
            ]);
        $server = $this->_auth->getServer();

        echo $server.$relative;
        die;

        $data = file_get_contents($server.$relative, false, $context);




    //     if (!$data = file_get_contents("http://www.google.com")) {
    //         $error = error_get_last();
    //         echo "HTTP request failed. Error was: " . $error['message'];
    //   } else {
    //         echo "Everything went better than expected";
    //   }
    }
// $this->createGET($data, self::POST);
    private function createGET()
    {

    }
}
