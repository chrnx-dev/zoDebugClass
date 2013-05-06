<?php /* Smarty version Smarty-3.1.13, created on 2013-02-15 01:47:46
         compiled from "/var/www/sites/inhabitat/html/wp-content/plugins/CDebug/vendors/smarty/templates/console.tpl" */ ?>
<?php /*%%SmartyHeaderCode:38496748511d5b01195e96-40768286%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '044c23b0afa35ed1181dac62a3d8106ef22fb9ae' => 
    array (
      0 => '/var/www/sites/inhabitat/html/wp-content/plugins/CDebug/vendors/smarty/templates/console.tpl',
      1 => 1360892845,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '38496748511d5b01195e96-40768286',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_511d5b0157bee6_34276418',
  'variables' => 
  array (
    'debugs' => 0,
    'debug' => 0,
    'key' => 0,
    'value' => 0,
    'errors' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_511d5b0157bee6_34276418')) {function content_511d5b0157bee6_34276418($_smarty_tpl) {?><div id="CDebug-console" class="container-fluid">
	<div id="CDebug-container" class="container-fluid">
	<div class="row-fluid">
		<div class="span10">
			<h1><small>Debug Console</small></h1>
		</div>
		<div class="span2">
			<h5><small><?php echo date('Y-m-d H:i:s');?>
</small></h5>
		</div>
	</div>
	<?php  $_smarty_tpl->tpl_vars['debug'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['debug']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['debugs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['debug']->key => $_smarty_tpl->tpl_vars['debug']->value){
$_smarty_tpl->tpl_vars['debug']->_loop = true;
?>
	<div class="row-fluid">
		<?php if ($_smarty_tpl->tpl_vars['debug']->value['type']=='CDEBUG_TOKEN_MESSAGE'||$_smarty_tpl->tpl_vars['debug']->value['type']=='CDEBUG_TOKEN_CHECKPOINT'){?>
		<div class="row-fluid debug-entry " rel="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">
			<div class="debug-entry-header">
				<span class="label <?php echo $_smarty_tpl->tpl_vars['value']->value['class'];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value['stringToken'];?>
</span>
				<span class="muted"> <?php echo $_smarty_tpl->tpl_vars['value']->value['value'];?>
</span>
			</div>
			<div class="debug-entry-footer">
				<span class="muted">triggered on <b><?php echo $_smarty_tpl->tpl_vars['value']->value['srcFilename'];?>
</b> in line <b><?php echo $_smarty_tpl->tpl_vars['value']->value['line'];?>
</b></span>
			</div>
		</div>
		<?php }else{ ?>
		<?php }?>
	</div>	
	<?php } ?>	
	</div>
	<!-- ./CDebug-container -->
</div>
<!-- ./CDebug-console -->
<pre><?php echo print_r($_smarty_tpl->tpl_vars['errors']->value);?>
</pre><?php }} ?>