<?php
namespace App\Http\Controllers\Admin;

use App\User;
use myframe\Captcha;

class LoginController extends CommonController
{
    protected $checkLoginExclude = ['index','login','captcha','logout'];
    public function index()
    {
        return $this->fetch('admin/login');
    }
    public function login(User $user)
    {
        $username = $this->request->post('username', '');
        $password = $this->request->post('password', '');
        $captcha = $this->request->post('captcha', '');
        if (!$this->checkCaptcha($captcha)) {
            $this->error('登录失败：验证码有误');
        }
        $data = $user->where(['username' => $username])->first();
        if (!$data) {
            $this->error('用户不存在');
        }
        // 判断用户密码是否正确
        if ($data['password'] != $this->passwordMD5($password, $data['salt'])) {
            $this->error('用户或者密码错误');
        }
        $this->setLogin(['id'=>$data['id'],'name'=>$data['username']]);
        $this->success('登录成功');
    }

    public function logout()
    {
        $this->setLogin([]);
        $this->redirect('/admin/login/index');
    }

    public function captcha(Captcha $captcha)
    {
        $code = $captcha->create();
        $this->setCaptcha($code);
        $captcha->show($code);
    }

    protected function setCaptcha($code)
    {
        $_SESSION['cms']['captcha'] = $code;
    }
    protected function checkCaptcha($code)
    {
        if (isset($_SESSION['cms']['captcha'])) {
            $captcha = $_SESSION['cms']['captcha'];
            unset($_SESSION['cms']['captcha']);
            return strtolower($code) === strtolower($captcha);
        }
        return false;
    }
    protected function passwordMD5($password, $salt)
    {
        return md5(md5($password).$salt);
    }
    protected function setLogin(array $user = [])
    {
        $_SESSION['cms']['admin'] = $user;
    }
}
