<?php
class Db
{
    public $link;
    private static $instance = null;
    private function __construct()
    {
        $this->link = new mysqli('localhost', 'exam', 'Hzh74E7ZnXZLJHNZ', 'exam');
    }
    public static function getInstance()
    {
        if (empty(self::instance)) {
            self::$instance = new self();
        }
        return self::instance;
    }
}
$db = DB::getInstance();
session_start();