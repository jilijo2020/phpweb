<?php
namespace myframe;

use ReflectionMethod;
use Exception;

class App extends Container
{
    protected $rootPath;
    protected $debug = true;
    protected $request;
    public function __construct()
    {
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
    public function run()
    {
        //echo "应用已启动";
        try {
            $dispatch = $this->roteCheck();
            return $this->dispatch($dispatch);
        } catch (HttpException $e) {
            return $e->getResponse();
        } catch (Exception $e) {
            $msg = $this->debug ? $e->getMessage() : '';
            return Response::create('系统发生错误：' . $msg, 403);
        }
    }
    public function dispatch(array $dispatch)
    {
        list($controller, $action) = $dispatch;
        $this->request->setAction($action);
        $instance = $this->controller($controller);
        if (is_callable([$instance,$action])) {
            // 对$action进行反射
            $reflect = new ReflectionMethod($instance, $action);
        } else {
            //exit('操作不存在。'. $action . '()');
            $msg = '操作不存在';
            $msg .= get_class($instance) . '->' . $action . '()';
            throw new Exception($msg);
        }
        // 创建$action方法依赖的对象，保存在$args参数中
        $args = $this->bindParam($reflect);
        // 调用$action方法，传入$args参数
        //$data = $instance->$action();
        $data = $reflect->invokeArgs($instance, $args);
        return Response::create($data);
    }
    public function controller($name)
    {
        $class = '\\App\\Http\\Controllers\\'.$name;
        if (!class_exists($class)) {
            //exit('请求的控制器'.$class.'不存在');
            $msg = '请求的控制器'.$class.'不存在';
            throw new Exception($msg);
        }
        return $this->make($class);
    }
    public function roteCheck()
    {
        // 获取PATH_INFO
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
                //exit('请求参数包含特殊字符');
                $msg = '请求参数包含特殊字符';
                throw new Exception($msg);
            }
        }
        return [$controller,$action];
    }
}
