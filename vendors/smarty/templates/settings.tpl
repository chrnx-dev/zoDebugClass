<div id="CDebug-Settings" class="container">
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
</div> <!-- /CDebug-Settings -->