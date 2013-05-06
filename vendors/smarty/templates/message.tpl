
{extends file="console.tpl"}
{block name="message"}
<div class="row-fluid debug-entry " rel="{$debug@iteration}">
	<div class="debug-entry-header">
		<span class="label {$debug.class}">{$debug.stringToken}</span>
		<span class="muted"> {$debug.value}</span>
	</div>
	<div class="debug-entry-footer">
		<span class="muted">triggered on <b>{$debug.srcFilename}</b> in line <b>{$debug.line}</b></span>
	</div>
</div>
{/block}

{block name="variable"}
<div class="row-fluid debug-entry" rel="{$debug@teration}">
	<div class="debug-entry-header">

		<div class="span7">
			<span class="label {$debug.class}">{$debug.stringToken}</span>
			<span><b>${$debug.name}</b></span>
		</div>
		<div class="span5 debug-control" rel="{$debug@iteration}">
			<a control="value" href="#">value</a> | <a control="source" href="#">source</a> | <a control="trace" href="#">trace</a> | <a control="hide" href="#">hide</a>
		</div>
	</div>
				
	<div class="debug-entry-body row-fluid">
		<div class="debug-value span10 offset1 hide">
			<pre>{print_r($debug.value,true)}</pre>
		</div>					
		<div class="debug-source span10 offset1 hide">
			<pre>{urldecode($debug.srcLine)}</pre>
		</div>					
		<div class="debug-trace span10 offset1 hide">
			{foreach $debug.trace as $trace}
			<div class="row-fluid">
				<span class="label">>     </span>{$trace.message}	
			</div>
			{if !empty($trace.file) && !empty($trace.line)}
			<div class="row-fluid" >
				<small><span class="muted">on <b>{basename($trace.file)}</b> in line <b>{$trace.line}</b></span></small>
			</div>
			{/if}			
			{/foreach}
		</div>
	</div>
				
	<div class="debug-entry-footer">
		<span class="muted">triggered on <b>{$debug.srcFilename}</b> in line <b>{$debug.line}</b></span>
	</div>
</div>
{/block}

{block name="errors"}
<div class="row-fluid error-entry" rel="{$error@iteration}">
	
	<div class="debug-entry-header">
		<div class="span7">
			<span class="label {$error.class}">{$error.stringToken}</span>
			<span><b>{$error.value}</b></span>
		</div>
		<div class="span5 debug-control" rel="{$error@iteration}">
			<a control="source" href="#">source</a> | <a control="trace" href="#">trace</a> | <a control="hide" href="#">hide</a> 
		</div>
	</div>
		
	<div class="debug-entry-body row-fluid">
			
		<div class="debug-source span10 offset1 hide">
			<pre>{urldecode($error.srcLine)}</pre>
		</div>					
		<div class="debug-trace span10 offset1 hide">
						
			{foreach $error.trace as $trace}
			<div class="row-fluid">
				<span class="label">>     </span>{$trace.message}	
			</div>
			{if !empty($trace.file) && !empty($trace.line)}
			<div class="row-fluid" >
				<small><span class="muted">on <b>{basename($trace.file)}</b> in line <b>{$trace.line}</b></span></small>
			</div>
			{/if}			
			{/foreach}
		</div>
	</div>
				
	<div class="debug-entry-footer">
		<span class="muted">triggered on <b>{$error.srcFilename}</b> in line <b>{$error.line}</b></span>
	</div>
			
</div>
{/block}

