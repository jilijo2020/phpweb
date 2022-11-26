<?php
namespace App\Http\Controllers;

use App\Student;
use fengqi\Hanzi\Hanzi;
use myframe\Request;
use myframe\App;
use myframe\DB;
use myframe\Controller;

class StudentController extends Controller
{
    protected $request;

    public function index()
    {
        echo 'index()方法已启动';
        /*$model = new Student();
        $data = $model->getAll();
        require VIEW_PATH . 'student.php';//引入视图文件*/
    }
    public function test(Student $student)
    {
		/*
		// 为模板中变量复制
        $this->Smarty->assign('title', 'Smarty');
        $this->Smarty->assign('desc', 'Smarty是一个PHP的模板引擎');
		// 渲染模板，返回渲染的html结果字符串
		return $this->Smarty->fetch('test.html');
		*/
		/*
		// 为模板中变量复制
        $this->assign('title', 'Smarty');
        $this->assign('desc', 'Smarty是一个PHP的模板引擎');
		// 渲染模板，返回渲染的html结果字符串
		return $this->fetch('test');
		*/
		$data = $student->get();
		$this->assign('student', $data);
		return $this->fetch('test');
    }
}
