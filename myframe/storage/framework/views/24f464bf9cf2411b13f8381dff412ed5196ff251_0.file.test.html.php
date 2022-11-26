<?php
/* Smarty version 3.1.39, created on 2021-04-15 15:34:10
  from 'C:\web\www\myframe\resources\views\test.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6077ec728f7e96_97647784',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '24f464bf9cf2411b13f8381dff412ed5196ff251' => 
    array (
      0 => 'C:\\web\\www\\myframe\\resources\\views\\test.html',
      1 => 1618472046,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6077ec728f7e96_97647784 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCMENT html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Smarty示例</title>
</head>
<body>
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
