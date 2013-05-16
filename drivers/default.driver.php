<?php
require_once 'CDebug.Data.interface.php';

class DefaultDriver extends CDebug_General implements CDebug_IData {
	
	private $session = null;
	
	
	public function __construct() {
		$this -> session = new stdClass;	
		$this -> generateSession(true);
	}
	
	

	public function generateSession($force = false) {
			
		$this -> session -> timestamp = microtime(true);
		$this -> session -> sessionId = sha1('Debug-' . $this -> session-> timestamp);
		$this -> session -> startTime = microtime(true);
		$this -> session -> endTime = microtime(true);
		$this -> session -> data = array();
		$this -> session -> maxmemory = '0 MB'; 
		$this -> session -> execution = '0 s';
	}

	public function getTrace($asObject = false) {
		return $this -> session -> data;
	}

	public function saveSession() {

		$this -> session -> endTime = microtime(true);
		$this -> session -> maxmemory = number_format((memory_get_peak_usage() / 1024 / 1024), 2) . ' MB';
		$this -> session -> execution = number_format(($this -> session -> endTime - $this->session -> startTime) / 1000, 4) . ' s';

		return $this->session;
	}

	public function compress() {
		
		
		$data = json_encode($this -> session);
		$cDataStd = gzcompress($data);
		$cDataMax = gzcompress($data, 9);

		echo '<pre>' . $data . '</pre><br >' . (strlen($data) / 1024) . ' KB <br />';
		echo '<pre>' . $cDataStd . '</pre><br >' . (strlen($cDataStd) / 1024) . 'KB <br />';
		echo '<pre>' . $cDataMax . '</pre><br >' . (strlen($cDataMax) / 1024) . 'KB <br />';
	}

	public function add($data) {
		array_push($this->session->data, $data);
	}
	
	public function getBy($tokenType = CDEBUG_TOKEN_NONE){
		return array_filter($this -> session -> data , function($element) use ($tokenType){
			return ($element['type'] == $tokenType);
		});
	}

	
	
}
?>
