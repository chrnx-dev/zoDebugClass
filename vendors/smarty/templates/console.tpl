<div id="CDebug-console" class="container-fluid">
	<div id="CDebug-container" class="container-fluid">
	<div class="row-fluid">
		<div class="span10">
			<h1><small>Debug Console</small></h1>
		</div>
		<div class="span2">
			<h5><small>{date('Y-m-d H:i:s')}</small></h5>
		</div>
	</div>
	{foreach $debugs as $debug}
	<div class="row-fluid">
		{if ( ($debug.type == $smarty.const.CDEBUG_TOKEN_MESSAGE) || ($debug.type == $smarty.const.CDEBUG_TOKEN_CHECKPOINT) ) }
		{block name="message"} {/block}
		{else}
		{block name="variable"}{/block} 
		{/if}
	</div>	
	{/foreach}
	{foreach $errors as $error}
	{block name="errors"}{/block}
	{/foreach}	
	</div>
	<!-- ./CDebug-container -->
</div>
<!-- ./CDebug-console -->

