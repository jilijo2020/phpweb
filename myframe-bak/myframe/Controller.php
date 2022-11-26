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
		$template_dir = $app->getRootPath() . 'resources/views';
		$compile_dir = $app->getRootPath() . 'storage/framework/views';
		$this->Smarty->template_dir = $template_dir;
		$this->Smarty->compile_dir = $compile_dir;
	}
	protected function assign($name, $value = '')
	{
		$this->Smarty->assign($name, $value);
	}
	protected function fetch($template = '')
	{
		return $this->Smarty->fetch($template . '.html');
	}
}