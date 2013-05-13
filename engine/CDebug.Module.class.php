<?php

abstract class CDebug_Module 
{
	private $parameters = array();
	
	private $event_table = array(
		CDEBUG_EVENT_NONE		=> 'none',
		CDEBUG_EVENT_MESSAGE	=> 'message',
		CDEBUG_EVENT_LOG		=> 'log',
		CDEBUG_EVENT_END		=> 'end',
		CDEBUG_EVENT_ERROR		=> 'error',
		CDEBUG_EVENT_EXCEPTION  => 'exception'
	);

	public function __construct($params = array()){
		if ( !empty($params) ){
			foreach ($params as $key => $value){
				$this->$key = $value;
			}
		}
	}

	public function __set($name, $value){
		$this->parameters[$name] = $value;
	}

	public function __get($name){
		if (isset($this->parameters[$name])){
			return $this->parameters[$name];
		} 
		else {
			trigger_error("Parameter <b>$name</b> does not exists", E_USER_NOTICE);
		}
	}

	public function __isset($name){
		return isset($this->parameters[$name]);
	}

	public function setEvent($event = CDEBUG_EVENT_NONE, $method = null){
		if ($event && !empty($method)){
			$this->event_table[$event] = $method;
		}
	}

	public function trigger( $event = CDEBUG_EVENT_NONE, $TOKEN = array()){
		if (method_exists($this, $this->event_table[$event] ) && !empty($TOKEN) ){
			call_user_func(array($this, $this->event_table[$event]), $TOKEN);
		}
	}
}