<?php
/* Smarty version 3.1.39, created on 2021-05-02 14:40:51
  from 'C:\web\www\myframe\resources\views\admin\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_608e4973f13817_47292853',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '843eec1638d44a0306240d3d6e6dd4e258816313' => 
    array (
      0 => 'C:\\web\\www\\myframe\\resources\\views\\admin\\index.html',
      1 => 1619937646,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608e4973f13817_47292853 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="main-title">
  <h2>首页</h2>
</div>
<div class="main-section">
  <div class="panel panel-default">
    <div class="panel-heading">欢迎访问</div>
    <div class="panel-body">欢迎进入内容管理系统！</div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">服务器信息</div>
    <ul class="list-group">
      <li class="list-group-item">
        系统环境：<?php echo $_smarty_tpl->tpl_vars['server_info']->value['server_version'];?>

      </li>
      <li class="list-group-item">
        MySQL版本：<?php echo $_smarty_tpl->tpl_vars['server_info']->value['mysql_version'];?>

      </li>
      <li class="list-group-item">
        文件上传限制：<?php echo $_smarty_tpl->tpl_vars['server_info']->value['upload_max_filesize'];?>

      </li>
      <li class="list-group-item">
        脚本执行时限：<?php echo $_smarty_tpl->tpl_vars['server_info']->value['max_execution_time'];?>

      </li>
      <li class="list-group-item">
        服务器时间：<?php echo $_smarty_tpl->tpl_vars['server_info']->value['server_time'];?>

      </li>
    </ul>
  </div>
</div>
<?php echo '<script'; ?>
>
  main.menuActive('index');
<?php echo '</script'; ?>
><?php }
}
