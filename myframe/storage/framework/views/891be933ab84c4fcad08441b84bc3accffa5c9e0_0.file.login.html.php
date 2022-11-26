<?php
/* Smarty version 3.1.39, created on 2021-05-02 09:27:15
  from 'C:\web\www\myframe\resources\views\admin\login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_608dfff34e7683_60092369',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '891be933ab84c4fcad08441b84bc3accffa5c9e0' => 
    array (
      0 => 'C:\\web\\www\\myframe\\resources\\views\\admin\\login.html',
      1 => 1619918832,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608dfff34e7683_60092369 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- 引入静态资源start -->
  <link rel="stylesheet" href="/static/common/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/static/common/toastr.js/2.1.4/toastr.min.css">
  <link rel="stylesheet" href="/static/admin/css/main.css">
  <?php echo '<script'; ?>
 src="/static/common/jquery/1.12.4/jquery.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="/static/common/twitter-bootstrap/3.4.1/js/bootstrap.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="/static/common/toastr.js/2.1.4/toastr.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="/static/admin/js/main.js"><?php echo '</script'; ?>
>
  <!-- 引入静态资源end -->
  <title>登录</title>
</head>
<body class="login">
  <div class="container">
    <form method="post" action="/admin/login/login" class="j-login">
      <h1>内台管理系统</h1>
      <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="用户名" required>
      </div>
      <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="密码" required>
      </div>
      <div class="form-group">
        <input type="text" name="captcha" class="form-control" placeholder="验证码" required>
      </div>
      <div class="form-group">
        <div class="login-captcha"><img src="/admin/login/captcha" alt="captcha" title="单击更换"></div>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-lg btn-success" value="登录">
      </div>
    </form>
    <div class="main-loading" style="display:none">
      <div class="dot-carousel"></div>
    </div>
  </div>
  <?php echo '<script'; ?>
>
    main.ajaxForm('.j-login',function(){
      //登录成功，跳转后台首页
      location.href = '/admin/index/index';
    },function(){
      $('.login-captcha img').click();
    });
    $('.login-captcha img').click(function(){
      $(this).attr('src','/admin/login/captcha?_=' + Math.random());
    });
  <?php echo '</script'; ?>
>
</body>
</html><?php }
}
