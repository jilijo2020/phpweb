<?php
namespace myframe;

use Smarty;

class Controller
{
    protected $Smarty;
    protected $app;
    protected $request;
    public function __construct(App $app, Request $request, Smarty $Smarty)
    {
        $this->Smarty = $Smarty;
        $this->app = $app;
        $this->request = $request;
        // 配置视图文件目录
        $template_dir = $app->getRootPath() . 'resources/views';
        // 配置编译完成后的视图文目录
        $compile_dir = $app->getRootPath() . 'storage/framework/views';
        $this->Smarty->template_dir = $template_dir;
        $this->Smarty->compile_dir = $compile_dir;
        $this->initialize();
    }
    protected function initialize()
    {}
    protected function assign($name, $value = '')
    {
        $this->Smarty->assign($name, $value);
    }
    protected function fetch($template = '')
    {
        return $this->Smarty->fetch($template . '.html');
    }
    protected function success($msg = '')
    {
        $data = json_encode(['code' => 1, 'msg' => $msg]);
        $header = ['Content-Type' => 'application/json'];
        throw new HttpException(Response::create($data, 200, $header));
    }

    protected function error($msg = '')
    {
        $data = json_encode(['code' => 0, 'msg' => $msg]);
        $header = ['Content-Type' => 'application/json'];
        throw new HttpException(Response::create($data, 200, $header));
    }
    protected function redirect($url = '', $code = '302')
    {
        $header = ['Location' => $url];
        throw new HttpException(Response::create('', $code, $header));
    }

    protected function display($template = '')
    {
        $data = $this->fetch($template);
        throw new HttpException(Response::create($data));
    }
}
