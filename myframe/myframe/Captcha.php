<?php
namespace myframe;

class Captcha
{
    public function create($count = 5)
    {
        $charset = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';  // 随机因子
        $code = '';
        // 生成随机验证码
        $len = strlen($charset) - 1;
        for ($i = 0; $i < $count; ++$i) {
            $code .= $charset[mt_rand(0, $len)];
        }
        return $code;
    }
    public function show($code, $x = 250, $y = 62)
    {
        // 创建图像资源
        $im = imagecreate($x, $y);
        // 随机生成背景颜色
        imagecolorallocate(
            $im,
            mt_rand(50, 200),
            mt_rand(0, 155),
            mt_rand(0, 155)
        );
        // 设置验证码文本的颜色和字体
        $fontcolor = imagecolorallocate($im, 255, 255, 255);
        $fontfile = __DIR__ . '/fonts/captcha.ttf';
        // 在图像中绘制验证码
        for ($i = 0, $len = strlen($code); $i < $len; ++$i) {
            imagettftext(
                $im,                                // 图像资源
                30,                                 // 字符尺寸
                mt_rand(0, 20) - mt_rand(0, 25),    // 随机设置字符倾斜角度
                32 + $i * 40,                       // 字符间距
                mt_rand(30, 50),                    // 随机设置字符坐标
                $fontcolor,                         // 字符颜色
                $fontfile,                          // 字符样式
                $code[$i]                           // 字符内容
            );
        }
        // 添加8个干扰线
        for ($i = 0; $i < 8; ++$i) {
            // 随机生成干扰线颜色
            $linecolor = imagecolorallocate(
                $im,
                mt_rand(0, 255),
                mt_rand(0, 255),
                mt_rand(0, 255)
            );
            // 随机生成干扰线
            imageline($im, mt_rand(0, $x), 0, mt_rand(0, $x), $y, $linecolor);
        }
        // 添加250个噪点
        for ($i = 0; $i < 250; ++$i) {
            // 随机生成噪点位置
            imagesetpixel($im, mt_rand(0, $x), mt_rand(0, $y), $fontcolor);
        }
        $this->output($im);
    }
    protected function output($im)
    {
        // 打开缓冲区
        ob_start();
        // 把图片输出到缓冲区
        imagepng($im);
        // 销毁图像
        imagedestroy($im);
        // 获取缓冲区的数据
        $data = ob_get_contents();
        // 清除缓冲区
        ob_end_clean();
        $header = ['Content-Type' => 'image/png'];
        throw new HttpException(Response::create($data, 200, $header));
    }
}
