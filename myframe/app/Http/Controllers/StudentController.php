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
    public function index()
    {
        echo 'index()方法已执行';
        /*$student = new Student();
        $data = $student->getAll();
        require VIEW_PATH . 'student.php';*/
    }

    public function test(Student $student)
    {
        $data = $student->get();
        $this->assign('student', $data);
        return $this->fetch('test');
    }
}
