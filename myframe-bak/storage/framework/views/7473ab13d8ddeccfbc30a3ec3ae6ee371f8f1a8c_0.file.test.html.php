<?php
/* Smarty version 3.1.39, created on 2021-04-15 09:15:30
  from 'C:\web\www\myframe-bak\resources\views\test.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_607793b221d432_67558692',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7473ab13d8ddeccfbc30a3ec3ae6ee371f8f1a8c' => 
    array (
      0 => 'C:\\web\\www\\myframe-bak\\resources\\views\\test.html',
      1 => 1618449320,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_607793b221d432_67558692 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCMENT html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Smarty示例</title>
</head>
<body>
	<!--<h1>Hello <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h1>
	<p><?php echo $_smarty_tpl->tpl_vars['desc']->value;?>
</p>-->
	<table border="1">
      <tr><th>name</th><th>email</th><th>gender</th></tr>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['student']->value, 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
      <tr>
        <td>
		<?php if ($_smarty_tpl->tpl_vars['v']->value['gender'] == '男') {?>
			<font color="red"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</font>
		<?php } else { ?>
			<?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>

		<?php }?>
		</td>
        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['email'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['gender'];?>
</td>
      </tr>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </table>
</body><?php }
}
