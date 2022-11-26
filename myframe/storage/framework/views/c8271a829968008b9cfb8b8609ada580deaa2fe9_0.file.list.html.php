<?php
/* Smarty version 3.1.39, created on 2021-05-04 09:08:17
  from 'C:\web\www\myframe\resources\views\sub\list.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60909e815d4984_62786714',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c8271a829968008b9cfb8b8609ada580deaa2fe9' => 
    array (
      0 => 'C:\\web\\www\\myframe\\resources\\views\\sub\\list.html',
      1 => 1620090493,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60909e815d4984_62786714 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="al">
  <?php if ((isset($_smarty_tpl->tpl_vars['category_name']->value))) {?>
    <div class="al-title"><h1><?php echo $_smarty_tpl->tpl_vars['category_name']->value;?>
</h1></div>
  <?php }?>
  <?php if ($_smarty_tpl->tpl_vars['article']->value) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['article']->value, 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
      <div class="al-each">
        <div class="al-info">
          <a href="/show?id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['v']->value['image']) {?>
          <div class="al-img">
            <a href="/show?id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">
              <img src="/uploads/images/<?php echo $_smarty_tpl->tpl_vars['v']->value['image'];?>
" alt="点击阅读文章">
            </a>
          </div>
        <?php }?>
        <div class="al-more">
          <span>作者：<?php echo $_smarty_tpl->tpl_vars['v']->value['author'];?>
 | 发表于：<?php echo $_smarty_tpl->tpl_vars['v']->value['created_at'];?>
</span>
        </div>
      </div>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  <?php } else { ?>
    <div class="al-message">
      该栏目内暂时没有内容。<p><a href="/">点击返回首页</a></p>
    </div>
  <?php }?>
</div>
<div class="pagelist"><?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>
</div><?php }
}
