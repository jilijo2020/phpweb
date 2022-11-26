<?php
namespace myframe;

class Request
{
    protected $pathinfo;
    public function pathinfo()
    {
        if (is_null($this->pathinfo)) {
            $this->pathinfo = ltrim($this->server('PATH_INFO', ''), '/');
        }
        return $this->pathinfo;
    }

    public function server($name, $default = null)
    {
        return isset($_SERVER[$name]) ? $_SERVER[$name] : $default;
    }

    public function get($name, $default = null)
    {
        return isset($_GET[$name]) ? $_GET[$name] : $default;
    }
}
