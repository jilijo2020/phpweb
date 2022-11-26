<?php
namespace myframe;

class Response
{
    protected $code = 200;
    protected $header = [];
    protected $data = '';
    public function __construct($data = '', $code = 200, array $header = [])
    {
        $this->code = $code;
        $this->data = $data;
        $this->header = array_merge($this->header, $header);
    }
    public function send()
    {
        http_response_code($this->code);
        foreach ($this->header as $name => $value) {
            header($name . (is_null($value) ? '' : ':' . $value));
        }
        echo $this->data;
    }
    public static function create($data = '', $code = 200, array $header = [])
    {
        // new Response($data,$code,$header);
        return new static($data,$code,$header);
    }
}