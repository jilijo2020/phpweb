<?php
namespace myframe;

use ReflectionClass; // 反射
use ReflectionMethod; // 反射

class Container
{
    protected $instances = [];
    protected static $instance;

    public function make($class)
    {
        if (!isset($this->instances[$class])) {
            //$this->instances[$class] = new $class();
            $reflect = new ReflectionClass($class);
            $constructor = $reflect->getConstructor();
            $args = $constructor ? $this->bindParam($constructor) : [];
            $this->instances[$class] = $reflect->newInstanceArgs($args);
        }
        return $this->instances[$class];
    }

    protected function bindParam(ReflectionMethod $reflect)
    {
        $args = [];
        $params = $reflect->getParameters();
        foreach ($params as $param) {
            $class = $param->getClass();
            if ($class) {
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
