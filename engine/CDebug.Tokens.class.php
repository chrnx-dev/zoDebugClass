<?php

# Status Table
define ('CDEBUG_DISABLE'				,0);
define ('CDEBUG_ONLY_ERRORS'			,1);
define ('CDEBUG_ENABLE'					,2);

# Catch Errors Table
define ('CDEBUG_SHOW_ERROR_NONE'		,0);
define ('CDEBUG_SHOW_ERROR_LOCAL'		,1);
define ('CDEBUG_SHOW_ERROR_OWNER'		,2);
define ('CDEBUG_SHOW_ERROR_DEVS'		,4);
define ('CDEBUG_SHOW_ERROR_ALL'			,6);


/**
 *  Token Types
 **/ 
# Default Token
define('CDEBUG_TOKEN_NONE'					,-1); 

# Errors Token
define('CDEBUG_TOKEN_ERROR'					,0);
define('CDEBUG_TOKEN_USER_ERROR'			,1);
define('CDEBUG_TOKEN_WARNING'				,2);
define('CDEBUG_TOKEN_USER_WARNING'			,3);
define('CDEBUG_TOKEN_NOTICE'				,4);
define('CDEBUG_TOKEN_USER_NOTICE'			,5);
define('CDEBUG_TOKEN_DEPRECATED'			,6);
define('CDEBUG_TOKEN_USER_DEPRECATED'		,7);

# Exception Token
define('CDEBUG_TOKEN_EXCEPTION'				,8);

# Special Tokens
define('CDEBUG_TOKEN_MESSAGE'				,9);
define('CDEBUG_TOKEN_CHECKPOINT'			,10);

# Var Type Tokens
define('CDEBUG_TOKEN_OBJECT'				,11);
define('CDEBUG_TOKEN_STRING'				,12);
define('CDEBUG_TOKEN_ARRAY'					,13);
define('CDEBUG_TOKEN_NUMERIC'				,14);
define('CDEBUG_TOKEN_BOOLEAN'				,15);
define('CDEBUG_TOKEN_RESOURCE'				,16);
define('CDEBUG_TOKEN_UNKNOW'				,17);
define('CDEBUG_TOKEN_UNDEFINED'				,18);

# Profiling Token
define('CDEBUG_TOKEN_PROFILING'				,19);

# Header Tokens
define('CDEBUG_TOKEN_HEADER'				,20);




# Module Events Table
define('CDEBUG_EVENT_NONE', 			0);
define('CDEBUG_EVENT_MESSAGE', 			1);
define('CDEBUG_EVENT_LOG', 				2);
define('CDEBUG_EVENT_END', 				3);
define('CDEBUG_EVENT_ERROR', 			4);
define('CDEBUG_EVENT_EXCEPTION', 		5);


# Flow Tokens Table
define('CDEBUG_START_POINT'					,0);
define('CDEBUG_FLOW_POINT'					,1);
define('CDEBUG_END_POINT'					,2);

# Errors Code Table
define ('CDEBUG_INTERNAL_ERROR', 						10001);
define ('CDEBUG_ERR_NOT_DECLARED_SETTING', 				20001);


# Drivers Table
define ('CDEBUG_DEFAULT_DRIVER', 						-1);
define ('CDEBUG_SQLITEMEMORY_DRIVER', 					 0);

class TOKEN
{
	protected $TOKEN = array
	(
		'type'		=> null,
		'name'		=> null,
		'msg'		=> null,
		'file'		=> null,
		'line'		=> null,
		'block'		=> null,
		'value'		=> null,
		'trace'		=> null
	);

	public function __construct($data = array(), $type = CDEBUG_TOKEN_NONE ) {
			
		if ( isset($data['trace']) )	$this->TOKEN['trace'] = $data['trace'];
		
		if ( isset($data['name']) )	$this->TOKEN['name'] = $data['name'];

		if ( isset($data['msg']) )	$this->TOKEN['msg'] = $data['msg'];

		if ( isset($data['file']) )	$this->TOKEN['file'] = $data['file'];

		if ( isset($data['line']) )	$this->TOKEN['line'] = $data['line'];

		if ( isset($data['block']) ) $this->TOKEN['block'] = $data['block'];

		if ( isset($data['value']) ) $this->TOKEN['value'] = $data['value'];
		
		$this->TOKEN['type']= $type;
	}

	public function returnToken(){
		return $this->TOKEN;
	}

	public function toJSON(){
		return json_encode($this->TOKEN);
	}
}



?>