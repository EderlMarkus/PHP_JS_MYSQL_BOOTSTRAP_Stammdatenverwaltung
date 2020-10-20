<?php

class Headers
{

    private $origin;

    public function __construct($originurl)
    {
        $this->origin = $originurl;

    }
    public function setHeaders()
    {
        if (!headers_sent()) {
            header('Access-Control-Allow-Origin: ' . $this->origin);
            //header('Access-Control-Allow-Origin: *');

            header("Access-Control-Allow-Methods: GET, DELETE, POST");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");
            $_POST = json_decode(file_get_contents("php://input"), true);
        }

    }
}
