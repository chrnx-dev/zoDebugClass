<?php
Class CoreHelper extends CDebug_Helpers {
	public $error_table = array(
		E_ERROR 			=> CDEBUG_TOKEN_ERROR, 
		E_WARNING 			=> CDEBUG_TOKEN_WARNING, 
		E_PARSE 			=> CDEBUG_TOKEN_ERROR, 
		E_NOTICE 			=> CDEBUG_TOKEN_NOTICE, 
		E_CORE_ERROR 		=> CDEBUG_TOKEN_ERROR, 
		E_CORE_WARNING 		=> CDEBUG_TOKEN_WARNING, 
		E_COMPILE_ERROR 	=> CDEBUG_TOKEN_ERROR, 
		E_COMPILE_WARNING 	=> CDEBUG_TOKEN_WARNING, 
		E_USER_ERROR 		=> CDEBUG_TOKEN_USER_ERROR, 
		E_USER_WARNING 		=> CDEBUG_TOKEN_USER_WARNING, 
		E_USER_NOTICE 		=> CDEBUG_TOKEN_USER_NOTICE, 
		E_STRICT 			=> CDEBUG_TOKEN_NOTICE, 
		E_RECOVERABLE_ERROR => CDEBUG_TOKEN_ERROR
	);
	
	public function stringToken($type) {
		switch ($type) {
			case CDEBUG_TOKEN_NONE :
				return 'None';
				break;
			case CDEBUG_TOKEN_ERROR :
				return 'Error';
				break;
			case CDEBUG_TOKEN_USER_ERROR :
				return 'User Error';
				break;
			case CDEBUG_TOKEN_WARNING :
				return 'Warning';
				break;
			case CDEBUG_TOKEN_USER_WARNING :
				return 'User Warning';
				break;
			case CDEBUG_TOKEN_NOTICE :
				return 'Notice';
				break;
			case CDEBUG_TOKEN_USER_NOTICE :
				return 'User Notice';
				break;
			case CDEBUG_TOKEN_DEPRECATED :
				return 'Deprecated';
				break;
			case CDEBUG_TOKEN_USER_DEPRECATED :
				return 'User Deprecated';
				break;
			case CDEBUG_TOKEN_EXCEPTION :
				return 'Exception';
				break;
			case CDEBUG_TOKEN_MESSAGE :
				return 'Message';
				break;
			case CDEBUG_TOKEN_CHECKPOINT :
				return 'Checkpoint';
				break;
			case CDEBUG_TOKEN_OBJECT :
				return 'Object';
				break;
			case CDEBUG_TOKEN_STRING :
				return 'String';
				break;
			case CDEBUG_TOKEN_ARRAY :
				return 'Array';
				break;
			case CDEBUG_TOKEN_NUMERIC :
				return 'Numeric';
				break;
			case CDEBUG_TOKEN_BOOLEAN :
				return 'Boolean';
				break;
			case CDEBUG_TOKEN_RESOURCE :
				return 'Resource';
				break;
			case CDEBUG_TOKEN_UNKNOW :
				return 'Unknown';
				break;
			case CDEBUG_TOKEN_UNDEFINED :
			default :
				return 'Undefined';
				break;
		}
	}

	public function varType($var) {
		if (is_object($var))
			return CDEBUG_TOKEN_OBJECT;
		if (is_null($var))
			return CDEBUG_TOKEN_UNDEFINED;
		if (is_string($var))
			return CDEBUG_TOKEN_STRING;
		if (is_array($var))
			return CDEBUG_TOKEN_ARRAY;
		if (is_int($var) || is_float($var))
			return CDEBUG_TOKEN_NUMERIC;
		if (is_bool($var))
			return CDEBUG_TOKEN_BOOLEAN;

		if (is_resource($var))
			return CDEBUG_TOKEN_RESOURCE;

		return CDEBUG_TOKEN_UNKNOW;
	}
}	

?>
