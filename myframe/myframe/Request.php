<?php
namespace myframe;

class Request
{
    protected $pathinfo;
    protected $action;
    public function pathinfo()
    {
        if (is_null($this->pathinfo)) {
            $this->pathinfo = ltrim($this->server('PATH_INFO', ''), '/');
        }
        return $this->pathinfo;
    }
    public function setAction($action)
    {
        $this->action = $action;
    }

    public function action()
    {
        return $this->action ?: '';
    }
    public function server($name, $default = '')
    {
        return isset($_SERVER[$name]) ? $_SERVER[$name] : $default;
    }
    public function get($name, $default = null)
    {
        return isset($_GET[$name]) ? $_GET[$name] : $default;
    }
    public function post($name, $default = null)
    {
        return isset($_POST[$name]) ? $_POST[$name] : $default;
    }
    public function isAjax()
    {
        return $this->server('HTTP_X_REQUESTED_WITH') === 'XMLHttpRequest';
    }
    public function hasFile($name)
    {
        return isset($_FILES[$name]['error']) && $_FILES[$name]['error'] !== UPLOAD_ERR_NO_FILE;
    }

    public function file($name)
    {
        $file = isset($_FILES[$name]) ? $_FILES[$name] : [];
        return Upload::create($file);
    }
}
