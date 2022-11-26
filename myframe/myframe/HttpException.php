<?php
namespace myframe;

use Exception;

class HttpException extends Exception
{
    protected $response;
    public function __construct(Response $response)
    {
        $this->response = $response;
    }
    public function getResponse()
    {
        return $this->response;
    }
}
