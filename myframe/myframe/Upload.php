<?php
namespace myframe;

use Exception;

class Upload
{
    protected $msg = [
        UPLOAD_ERR_INI_SIZE => '文件大小超过了服务器设置的限制！',
        UPLOAD_ERR_FORM_SIZE => '文件大小超过了表单设置的限制！',
        UPLOAD_ERR_PARTIAL => '文件只有部分被上传！',
        UPLOAD_ERR_NO_FILE => '没有文件被上传！',
        UPLOAD_ERR_NO_TMP_DIR => '上传文件临时目录不存在！',
        UPLOAD_ERR_CANT_WRITE => '文件写入失败！'
    ];

    protected $file = ['name' => '', 'tmp_name' => '', 'type' => '', 'size' => 0, 'error' => 4];

    public function __construct(array $file = [])
    {
        if (!isset($file['error'])) {
            throw new Exception('文件不合法！');
        }
        $error = $file['error'];
        if ($error !== UPLOAD_ERR_OK) {
            $msg = isset($this->msg[$error]) ? $this->msg[$error] : '未知错误！';
            throw new Exception($msg);
        }
        $this->file = array_merge($this->file, $file);
    }

    public static function create(array $file = [])
    {
        return new static($file);
    }

    public function extension()
    {
        return pathinfo($this->file['name'], PATHINFO_EXTENSION);
    }

    public function move($path = '.', $name = '')
    {
        $path = rtrim($path, '/') . '/';
        if (!is_dir($path) && !mkdir($path, 0777, true)) {
            throw new Exception('无法创建保存目录！');
        }
        if ($name === '') {
            $name = md5(microtime(true)) . '.' . $this->extension();
        }
        if (!move_uploaded_file($this->file['tmp_name'], $path . $name)) {
            throw new Exception('无法保存文件！');
        }
        return $name;
    }
}
