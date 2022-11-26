<?php
namespace myframe;

use PDO;
use PDOException;
use Exception;

class DB
{
    protected static $initConfig = [];
    protected static $instance;
    protected $config = [
        'type' => 'mysql',          //数据库类型
        'host' => '127.0.0.1',      //主机名
        'port' => '3306',           //端口号
        'dbname' => '',             //数据库名称
        'charset' => 'utf8mb4',     // 字符集
        'user' => 'root',           // 用户名
        'pwd' => '',                //密码
        'prefix' => ''              //表前缀
    ];
    protected $pdo;
    public function __construct(array $config = [])
    {
        $this->config = array_merge($this->config, $config);
        $this->initPDO(); // 实例化PDO,连接数据库
    }

    public function getConfig($name = null)
    {
        return $name ? $this->config[$name] : $this->config;
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static(static::$initConfig);
        }
        return self::$instance;
    }

    public static function init(array $config = [])
    {
        static::$initConfig = $config;
    }

    protected function initPDO()
    {
        // 取出数据库配置信息
        $type = $this->config['type'];
        $host = $this->config['host'];
        $port = $this->config['port'];
        $dbname = $this->config['dbname'];
        $charset = $this->config['charset'];
        // 拼接数据源DSN
        $dsn = "$type:host=$host;port=$port;dbname=$dbname;charset=$charset";
        try {
            // 连接数据库，创建PDO
            $this->pdo = new PDO($dsn, $this->config['user'], $this->config['pwd']);
        } catch (PDOException $e) {
            // 抛出异常
            throw new Exception('数据库连接失败，错误信息：' . $e->getMessage());
        }
        // 设置PDO的错误模式
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
	public function fetchRow($sql, Array $bind = [])
	{
		try {
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute($bind);
			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			$error = $this->errorMsg($e, $sql);
			throw new Exception($error);
		}
	}
	protected function errorMsg($e, $sql = ''){
		$error = $e->getMessage();
		if ($sql != ''){
			$error .= ' SQL语句执行失败：' . $sql;
		}
		return $error;
	}
	public function fetchAll($sql, Array $bind = [])
	{
		try {
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute($bind);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			$error = $this->errorMsg($e, $sql);
			throw new Exception($error);
		}
	}
	public function execute($sql, Array $bind = [])
	{
		try {
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute($bind);
			return $stmt->rowCount();
		} catch (PDOException $e) {
			$error = $this->errorMsg($e, $sql);
			throw new Exception($error);
		}
	}
	public function lastInsertId()
	{
		return $this->pdo->lastInsertId();
	}
}
