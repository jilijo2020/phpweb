<?php
/* Smarty version 3.1.39, created on 2021-05-04 09:24:02
  from 'C:\web\www\myframe\resources\views\sub\show.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6090a2320317c7_57611121',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b36537067d48af7064ab3aafe154e90beb461ebb' => 
    array (
      0 => 'C:\\web\\www\\myframe\\resources\\views\\sub\\show.html',
      1 => 1620091393,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6090a2320317c7_57611121 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="as">
  <?php if ($_smarty_tpl->tpl_vars['article']->value) {?>
    <div class="as-title"><h1><?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
</h1></div>
    <div class="as-row">
      <span>栏目：
          <?php if ((isset($_smarty_tpl->tpl_vars['category_name']->value))) {?>
            <a href="/show?id=<?php echo $_smarty_tpl->tpl_vars['article']->value['cid'];?>
"><?php echo $_smarty_tpl->tpl_vars['category_name']->value;?>
</a>
          <?php } else { ?>
            无
          <?php }?>
        </span>
      <span>作者：<?php echo $_smarty_tpl->tpl_vars['article']->value['author'];?>
</span>
      <span>发表时间：<?php echo $_smarty_tpl->tpl_vars['article']->value['created_at'];?>
</span>
      <span>阅读：<?php echo $_smarty_tpl->tpl_vars['article']->value['views'];?>
次</span>
    </div>
    <div class="as-content"><?php echo $_smarty_tpl->tpl_vars['article']->value['content'];?>
</div>
    <div class="as-change">
      <span>上一篇：
        <?php if ($_smarty_tpl->tpl_vars['article_prev']->value) {?>
          <a href="/show?id=<?php echo $_smarty_tpl->tpl_vars['article_prev']->value['id'];?>
"
          title="<?php echo $_smarty_tpl->tpl_vars['article_prev']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['article_prev']->value['title'];?>
</a>
        <?php } else { ?>
          无
        <?php }?>
      </span>
      <span>下一篇：
        <?php if ($_smarty_tpl->tpl_vars['article_next']->value) {?>
          <a href="/show?id=<?php echo $_smarty_tpl->tpl_vars['article_next']->value['id'];?>
"
          title="<?php echo $_smarty_tpl->tpl_vars['article_next']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['article_next']->value['title'];?>
</a>
        <?php } else { ?>
          无
        <?php }?>
      </span>
    </div>
  <?php } else { ?>
    <div class="as-message">
      您查看的文章不存在。<p><a href="/">点我返回首页</a></p>
    </div>
  <?php }?>
</div><?php }
}
