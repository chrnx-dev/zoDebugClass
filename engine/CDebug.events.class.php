<?php
class CDebug_EventException extends Exception{};

class CDebug_Event
{
	protected $name;
	protected $callBack;

	public function __construct($name = null, $callback = null ) 
	{
		if ($name === null) throw new CDebug_EventException("Can not create a nameless event", -100001);

		if ($this->isCallBack($callback)) $this->callBack = $callback;

		$this->name = $name;
		
	}

	protected function isCallBack($callback = null)
	{
		return ($callback !== null && is_callable($callback));
	}

	public function setCallBack($callback)
	{
		if ($this->isCallBack($callback)) $this->callBack = $callback;

		throw new CDebug_EventException("Is not Valid Callback", -100002);
	}

	public function getCallBack()
	{
		if ($this->isCallBack($this->callBack)) return $this->callBack();

		throw new CDebug_EventException("Is not Valid Callback", -100002);
	}

	public function getName()
	{
		return $this->name;
	}
}

