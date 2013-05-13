<?php
class CDebug_ErrorManagement extends CDebug_General{
	private $config = null;

	public function __construct() {
		if (CDebug::getSettings() -> catch_errors & 15) {
			ini_set('display_errors', 0);
			set_error_handler(array($this, 'error_handler'));
		}

		if (CDebug::getSettings() -> catch_exceptions & 15)
			set_exception_handler(array($this, 'exception_handler'));
	}

	public function reset() {

		restore_error_handler();
		restore_exception_handler();

		if (CDebug::getConfig() -> catch_errors & 15) {
			ini_set('display_errors', 0);
			error_reporting(0);
			set_error_handler(array($this, 'error_handler'));
		}

		if (CDebug::getConfig() -> catch_exceptions & 15)
			set_exception_handler(array($this, 'exception_handler'));
	}

	public function exception_handler($exception) {
		print_r($exception);
		$bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		$data = array(
			'value' => $exception -> getMessage(), 
			'line' => $exception -> getLine(), 
			'file' => $exception -> getFile(), 
			'trace' => $bt
		);

		$TOKEN = new TOKEN($data, CDEBUG_TOKEN_EXCEPTION);
		CDebug::getTrace() -> add($TOKEN -> returnToken());
		//CDebug::propagate(CDEBUG_EVENT_EXCEPTION, $TOKEN -> returnToken());
		//CDebug::setStatus(CDEDUG_END_POINT);
	}

	public function error_handler($errno, $errmsg, $filename, $linenum, $vars) {
		
		
		if (in_array($this->Core->error_table[$errno], CDebug::getSettings() -> exclude_errors))
			return false;
		$bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		
		$data = array(
			'value' => $errmsg, 
			'line' => $linenum, 
			'file' => $filename, 
			'trace' => $bt
		);
		
		
		
		$TOKEN = new TOKEN($data, $this->Core->error_table[$errno]);
		
		CDebug::getTrace() -> add($TOKEN -> returnToken());
		
		//CDebug::propagate(CDEBUG_EVENT_ERROR, $TOKEN -> returnToken());

		if (in_array($this->Core->error_table[$errno], array(CDEBUG_TOKEN_ERROR, CDEBUG_TOKEN_USER_ERROR))) {
			//CDebug::setStatus(CDEDUG_END_POINT);
			exit ;
		}
	}

}
?>