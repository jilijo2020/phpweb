<?php
namespace myframe;

use ReflectionMethod;
use Exception;

class App extends Container
{
    protected $request;
    protected $debug = true;
    protected $rootPath;
    public function __construct()
    {
        //$this->request = new Request();
        $this->instances[App::class] = $this;
        $this->request = $this->make(Request::class);
        $this->rootPath = dirname(__DIR__) . '/';
        DB::init(require $this->rootPath . 'config/database.php');
    }
	/**
	 * 获取项目路径
	 */
	public function getRootPath()
	{
		return $this->rootPath;
	}
    /**
     * 启动方法
     */
    public function run()
    {
        try {
            $dispatch = $this->routeCheck();
            return $this->dispatch($dispatch);
        } catch (Exception $e) {
            $msg = $this->debug ? $e->getMessage() : '';
            return Response::create('系统发生错误。' . $msg .'<br>', 403);
        }
    }
    /**
     * 路由检测
     */
    public function routeCheck()
    {
        //$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        //$path = trim($path, '/');
        $path = $this->request->pathinfo();
        $controller = dirname($path);
        $action = basename($path);
        if ($controller === '' || $controller === '.') {
            $controller = 'Index';
        }
        if ($action === '') {
            $action = 'index';
        }
        $arr = explode('/', ucwords($controller, '/'));
        $controller = implode('\\', $arr) . 'Controller';
        $arr[] = $action;
        foreach ($arr as $v) {
            if (!preg_match('/^[A-Za-z]\w{0,20}$/', $v)) {
                throw new Exception('请求参数包含特殊字符！<br>');
            }
        }
        return [$controller,$action];
    }
    /**
     * 路由分发
     */
    public function dispatch($dispatch)
    {
        list($controller, $action) = $dispatch;
        $instance = $this->controller($controller);
        //$data = $instance->$action();
        if (is_callable([$instance,$action])) {
            $reflect = new ReflectionMethod($instance, $action);
        } else {
            throw new Exception('操作不存在：' . get_class($instance) . '->'. $action.'()<br>');
        }
        $args = $this->bindParam($reflect);
        $data = $reflect->invokeArgs($instance, $args);
        return Response::create($data);
    }
    /**
     * 实例化控制器
     */
    public function controller($name)
    {
        $class = '\\App\\Http\\Controllers\\' . $name;
        if (!class_exists($class)) {
            throw new Exception('请求的控制器' . $class . '不存在！<br>');
        }
        // return new $class();
        return $this->make($class);
    }
}
