<?php /* Smarty version Smarty-3.1.13, created on 2013-02-22 01:45:24
         compiled from "/var/www/sites/inhabitat_trunk/html/wp-content/plugins/CDebug/vendors/smarty/templates/message.tpl" */ ?>
<?php /*%%SmartyHeaderCode:205319051451265d0fa92883-12062579%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0dfb68ec3ddc82702ba8c8f7764d27face94fce6' => 
    array (
      0 => '/var/www/sites/inhabitat_trunk/html/wp-content/plugins/CDebug/vendors/smarty/templates/message.tpl',
      1 => 1361324619,
      2 => 'file',
    ),
    '30f36cf988cbeda8474d0610d265668c77499f20' => 
    array (
      0 => '/var/www/sites/inhabitat_trunk/html/wp-content/plugins/CDebug/vendors/smarty/templates/console.tpl',
      1 => 1361497519,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205319051451265d0fa92883-12062579',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51265d0fbd80b6_15530591',
  'variables' => 
  array (
    'headHTML' => 0,
    'debugs' => 0,
    'debug' => 0,
    'errors' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51265d0fbd80b6_15530591')) {function content_51265d0fbd80b6_15530591($_smarty_tpl) {?><?php if (!$_smarty_tpl->tpl_vars['headHTML']->value){?>
<div class="head"></div>
<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?>
<div id="CDebug-console" class="container-fluid">
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
		<?php if ((($_smarty_tpl->tpl_vars['debug']->value['type']==@constant('CDEBUG_TOKEN_MESSAGE'))||($_smarty_tpl->tpl_vars['debug']->value['type']==@constant('CDEBUG_TOKEN_CHECKPOINT')))){?>
		
<div class="row-fluid debug-entry " rel="<?php echo $_smarty_tpl->tpl_vars['debug']->iteration;?>
">
	<div class="debug-entry-header">
		<span class="label <?php echo $_smarty_tpl->tpl_vars['debug']->value['class'];?>
"><?php echo $_smarty_tpl->tpl_vars['debug']->value['stringToken'];?>
</span>
		<span class="muted"> <?php echo $_smarty_tpl->tpl_vars['debug']->value['value'];?>
</span>
	</div>
	<div class="debug-entry-footer">
		<span class="muted">triggered on <b><?php echo $_smarty_tpl->tpl_vars['debug']->value['srcFilename'];?>
</b> in line <b><?php echo $_smarty_tpl->tpl_vars['debug']->value['line'];?>
</b></span>
	</div>
</div>

		<?php }else{ ?>
		
<div class="row-fluid debug-entry" rel="<?php echo $_smarty_tpl->tpl_vars['debug']->teration;?>
">
	<div class="debug-entry-header">

		<div class="span7">
			<span class="label <?php echo $_smarty_tpl->tpl_vars['debug']->value['class'];?>
"><?php echo $_smarty_tpl->tpl_vars['debug']->value['stringToken'];?>
</span>
			<span><b>$<?php echo $_smarty_tpl->tpl_vars['debug']->value['name'];?>
</b></span>
		</div>
		<div class="span5 debug-control" rel="<?php echo $_smarty_tpl->tpl_vars['debug']->iteration;?>
">
			<a control="value" href="#">value</a> | <a control="source" href="#">source</a> | <a control="trace" href="#">trace</a> | <a control="hide" href="#">hide</a>
		</div>
	</div>
				
	<div class="debug-entry-body row-fluid">
		<div class="debug-value span10 offset1 hide">
			<pre><?php echo print_r($_smarty_tpl->tpl_vars['debug']->value['value'],true);?>
</pre>
		</div>					
		<div class="debug-source span10 offset1 hide">
			<pre><?php echo urldecode($_smarty_tpl->tpl_vars['debug']->value['srcLine']);?>
</pre>
		</div>					
		<div class="debug-trace span10 offset1 hide">
			<?php  $_smarty_tpl->tpl_vars['trace'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['trace']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['debug']->value['trace']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['trace']->key => $_smarty_tpl->tpl_vars['trace']->value){
$_smarty_tpl->tpl_vars['trace']->_loop = true;
?>
			<div class="row-fluid">
				<span class="label">>     </span><?php echo $_smarty_tpl->tpl_vars['trace']->value['message'];?>
	
			</div>
			<?php if (!empty($_smarty_tpl->tpl_vars['trace']->value['file'])&&!empty($_smarty_tpl->tpl_vars['trace']->value['line'])){?>
			<div class="row-fluid" >
				<small><span class="muted">on <b><?php echo basename($_smarty_tpl->tpl_vars['trace']->value['file']);?>
</b> in line <b><?php echo $_smarty_tpl->tpl_vars['trace']->value['line'];?>
</b></span></small>
			</div>
			<?php }?>			
			<?php } ?>
		</div>
	</div>
				
	<div class="debug-entry-footer">
		<span class="muted">triggered on <b><?php echo $_smarty_tpl->tpl_vars['debug']->value['srcFilename'];?>
</b> in line <b><?php echo $_smarty_tpl->tpl_vars['debug']->value['line'];?>
</b></span>
	</div>
</div>
 
		<?php }?>
	</div>	
	<?php } ?>
	<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['errors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
	
<div class="row-fluid error-entry" rel="<?php echo $_smarty_tpl->tpl_vars['error']->iteration;?>
">
	
	<div class="debug-entry-header">
		<div class="span7">
			<span class="label <?php echo $_smarty_tpl->tpl_vars['error']->value['class'];?>
"><?php echo $_smarty_tpl->tpl_vars['error']->value['stringToken'];?>
</span>
			<span><b><?php echo $_smarty_tpl->tpl_vars['error']->value['value'];?>
</b></span>
		</div>
		<div class="span5 debug-control" rel="<?php echo $_smarty_tpl->tpl_vars['error']->iteration;?>
">
			<a control="source" href="#">source</a> | <a control="trace" href="#">trace</a> | <a control="hide" href="#">hide</a> 
		</div>
	</div>
		
	<div class="debug-entry-body row-fluid">
			
		<div class="debug-source span10 offset1 hide">
			<pre><?php echo urldecode($_smarty_tpl->tpl_vars['error']->value['srcLine']);?>
</pre>
		</div>					
		<div class="debug-trace span10 offset1 hide">
						
			<?php  $_smarty_tpl->tpl_vars['trace'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['trace']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['error']->value['trace']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['trace']->key => $_smarty_tpl->tpl_vars['trace']->value){
$_smarty_tpl->tpl_vars['trace']->_loop = true;
?>
			<div class="row-fluid">
				<span class="label">>     </span><?php echo $_smarty_tpl->tpl_vars['trace']->value['message'];?>
	
			</div>
			<?php if (!empty($_smarty_tpl->tpl_vars['trace']->value['file'])&&!empty($_smarty_tpl->tpl_vars['trace']->value['line'])){?>
			<div class="row-fluid" >
				<small><span class="muted">on <b><?php echo basename($_smarty_tpl->tpl_vars['trace']->value['file']);?>
</b> in line <b><?php echo $_smarty_tpl->tpl_vars['trace']->value['line'];?>
</b></span></small>
			</div>
			<?php }?>			
			<?php } ?>
		</div>
	</div>
				
	<div class="debug-entry-footer">
		<span class="muted">triggered on <b><?php echo $_smarty_tpl->tpl_vars['error']->value['srcFilename'];?>
</b> in line <b><?php echo $_smarty_tpl->tpl_vars['error']->value['line'];?>
</b></span>
	</div>
			
</div>

	<?php } ?>	
	</div>
	<!-- ./CDebug-container -->
</div>
<!-- ./CDebug-console -->
<?php if ($_smarty_tpl->tpl_vars['headHTML']->value){?>
<script type="text/javascript">
	$Content = $('#content');
	$Debug = $('#CDebug-console');
	$('#CDebug-console').remove();
	$Content.after($Debug);
</script>
<?php }?>

<?php if (!$_smarty_tpl->tpl_vars['headHTML']->value){?>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?><?php }} ?>