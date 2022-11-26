<?php
/* Smarty version 3.1.39, created on 2021-05-03 10:26:43
  from 'C:\web\www\myframe\resources\views\admin\category_list.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_608f5f637a9b38_18938682',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b16e80712b20f49833882f609e69ee6c2589ac7e' => 
    array (
      0 => 'C:\\web\\www\\myframe\\resources\\views\\admin\\category_list.html',
      1 => 1620008795,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608f5f637a9b38_18938682 (Smarty_Internal_Template $_smarty_tpl) {
?><div>
  <div class="main-title">
    <h2>栏目管理</h2>
  </div>
  <div class="main-section form-inline">
    <a href="/admin/category/edit" class="btn btn-success">+ 新增</a>
  </div>
  <div class="main-section">
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <th>栏目名称</th>
          <th>排序值</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($_smarty_tpl->tpl_vars['category']->value) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category']->value, 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
        <tr>
          <td><a href="/admin/category/edit?id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</a></td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['sort'];?>
</td>
          <td>
            <a href="/admin/category/edit?id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" style="margin-right:5px;">编辑</a>
            <a href="/admin/category/delete?id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" class="j-del text-danger">删除</a>
          </td>
        </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php } else { ?>
        <tr>
          <td colspan="3" class="text-center">列表为空</td>
        </tr>
        <?php }?>
      </tbody>
    </table>
  </div>
</div>
<?php echo '<script'; ?>
>
  main.menuActive('category');
  $('.j-del').click(function () {
    if (confirm('您确定要删除此项？')) {
      main.ajaxPost($(this).attr('href'), function () {
        main.contentRefresh();
      });
    }
    return false;
  });
<?php echo '</script'; ?>
><?php }
}
