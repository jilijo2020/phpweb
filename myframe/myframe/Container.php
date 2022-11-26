<?php
namespace myframe;

use ReflectionClass;
use ReflectionMethod;

class Container
{
    protected $instances = [];
    protected static $instance;
    public function make($class){
        if (!isset($this->instances[$class])) {
            // 创建反射对象
            $reflect = new ReflectionClass($class);
            // 获取构造方法
            $constuctor = $reflect->getConstructor();
            // 创建构造方法依赖对象，将对象保存在$args参数中
            $args = $constuctor ? $this->bindParam($constuctor) : [];
            // 实例化类，并传入$args参数
            //$this->instances[$class] = new $class();
            $this->instances[$class] = $reflect->newInstanceArgs($args);
        }
        return $this->instances[$class];
    }
    public function bindParam(ReflectionMethod $reflect){
        $args = [];
        $params = $reflect->getParameters();
        foreach ($params as $param) {
            $class = $param->getClass();
            if($class){
                $args[] = $this->make($class->getName());
            }
        }
        return $args;
    }
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}