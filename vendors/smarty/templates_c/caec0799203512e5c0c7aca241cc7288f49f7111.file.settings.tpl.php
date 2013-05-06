<?php /* Smarty version Smarty-3.1.13, created on 2013-02-25 22:50:05
         compiled from "/var/www/sites/inhabitat_trunk/html/wp-content/plugins/CDebug/vendors/smarty/templates/settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:485297268512bcdcf402a18-01573829%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'caec0799203512e5c0c7aca241cc7288f49f7111' => 
    array (
      0 => '/var/www/sites/inhabitat_trunk/html/wp-content/plugins/CDebug/vendors/smarty/templates/settings.tpl',
      1 => 1361830959,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '485297268512bcdcf402a18-01573829',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_512bcdcf57c6a9_23881211',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_512bcdcf57c6a9_23881211')) {function content_512bcdcf57c6a9_23881211($_smarty_tpl) {?><div id="CDebug-Settings" class="container">
<h1><small>zoDebug Tool Settings</small></h1>

<form>
<fieldset>
<legend>Active mode</legend>
<label class="radio">
  <input type="radio" name="enableType" id="enableType" value="all"> Active for all - <span class="muted">This mean active for all site without conditions.</span>
</label>
<label class="radio">
  <input type="radio" name="enableType" id="enableType" value="admin_users"> Active for admin users - <span class="muted">This mean active just for logged admin users.</span>
</label>
<label class="radio ">
  <input type="radio" name="enableType" id="enableType" value="owner"> Active for a single user - <span class="muted">This mean active for one user.</span>
</label>
<label class="radio ">
  <input type="radio" name="enableType" id="enableType" value="disable"> Disabled
</label>
</fieldset>
<div class="form-actions">
  <button type="submit" class="btn btn-primary">Save changes</button>
  <button type="button" class="btn">Reset</button>
</div>
</form> 
</div> <!-- /CDebug-Settings --><?php }} ?>