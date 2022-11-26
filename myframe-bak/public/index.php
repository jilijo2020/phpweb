<?php
namespace myframe;

// 自动加载
require "../vendor/autoload.php";
// (new App())->run()->send();
App::getInstance()->run()->send();
/*
define('VIEW_PATH', '../resources/views/'); // 定义视图路径常量
// 获取PATH_INFO
$pathinfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
$route = [
    'student' => 'student/index',
    'odd' => 'student/odd',
    'goods' => 'goods/index'
];
$pathinfo = trim($pathinfo, '/');
if (isset($route[$pathinfo])) {
    $pathinfo = $route[$pathinfo];
}
$arr = explode('/', trim($pathinfo, '/'));
list($controller, $action) = $arr;
$controller = ucwords($controller) . 'Controller';
// 拼接完整的命名空间
$controller = '\\App\\Http\\Controllers\\' . $controller; // 命名空间的完全限定访问
// 实例化控制器
$student = new $controller();
// 调用控制器的方法
$student->$action();
*/
