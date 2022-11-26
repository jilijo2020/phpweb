<?php
/* Smarty version 3.1.39, created on 2021-05-03 17:20:30
  from 'C:\web\www\myframe\resources\views\admin\article_edit.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_608fc05eb1a2e9_25665975',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '730387a33da8fdd381f4fbb6161bcfb8a1efb8c2' => 
    array (
      0 => 'C:\\web\\www\\myframe\\resources\\views\\admin\\article_edit.html',
      1 => 1620033523,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608fc05eb1a2e9_25665975 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="main-title">
  <h2><?php if ($_smarty_tpl->tpl_vars['id']->value) {?>修改<?php } else { ?>添加<?php }?>文章</h2>
</div>
<div class="main-section">
  <form method="post" action="/admin/article/save" class="j-form">
    <ul class="form-group form-inline">
      <li>
        <input type="text" class="form-control" name="title" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
" required>
        <label>文章标题</label>
      </li>
      <li>
        <select name="cid" class="form-control" style="min-width:196px;">
          <option value="0">---</option>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category']->value, 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['v']->value['id'] === $_smarty_tpl->tpl_vars['data']->value['cid']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
 </option>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </select>
        <label>所属分类</label>
      </li>
      <li>
        <input type="text" class="form-control" name="author" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['author'];?>
" required>
        <label>作者</label>
      </li>
      <li>
        <label>封面图</label>
        <input type="file" name="image">
      </li>
      <?php if ($_smarty_tpl->tpl_vars['data']->value['image']) {?>
      <li>
        <ul class="main-imglist">
          <li>
            <div class="main-imglist-item">
              <a href="/uploads/images/<?php echo $_smarty_tpl->tpl_vars['data']->value['image'];?>
" target="_blank"><img src="/uploads/images/<?php echo $_smarty_tpl->tpl_vars['data']->value['image'];?>
"></a>
            </div>
          </li>
        </ul>
      </li>
      <?php }?>
      <li>
        <label>文章内容</label>
        <div><textarea class="j-content" name="content" style="height:200px"><?php echo $_smarty_tpl->tpl_vars['data']->value['content'];?>
</textarea></div>
      </li>
      <li>
        <label><input type="checkbox" name="show" value="1" <?php if ($_smarty_tpl->tpl_vars['data']->value['show']) {?>checked<?php }?>> 发布</label>
      </li>
      <li>
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
        <input type="submit" value="提交表单" class="btn btn-primary">
        <a href="/admin/article/index" class="btn btn-default">返回列表</a>
      </li>
    </ul>
  </form>
</div>
<?php echo '<script'; ?>
>
  main.menuActive('article');
  main.ajaxForm('.j-form', function () {
    main.content('/admin/article/index');
  });
  main.loadJS('/static/admin/editor/ueditor1.4.3.3/ueditor.config.js');
  main.loadJS('/static/admin/editor/ueditor1.4.3.3/ueditor.all.min.js');
  main.loadJS('/static/admin/editor/main.editor.js');
  main.editor($('.j-content'), 'article_edit', function(opt) {
    opt.UEDITOR_HOME_URL = '/static/admin/editor/ueditor1.4.3.3/'
  }, function(editor) {
    $('.j-form').submit(function() {
      editor.sync();
    });
  });
<?php echo '</script'; ?>
><?php }
}
