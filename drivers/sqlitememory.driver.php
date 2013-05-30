<?php
require_once 'CDebug.Data.interface.php';

class SqliteMemoryDriver extends CDebug_General implements CDebug_IData {
	
	private $appId;
	
	
	public function __construct() {
		
		$this -> db_data = new PDO('sqlite:'.CDEBUG_DRIVERS.'data.db');
		$this -> db_data -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$this -> appId = $this->getApplicationId('7943025fa79a44eda05083ba85ece82bfc26cb0e');	
		
		echo '<pre>'.print_r($this->appId,true).'</pre>';	
		/*$this -> db_data -> exec("CREATE TABLE sessions (sessionId TEXT PRIMARY KEY, timestamp TEXT, startTime TEXT, endTime TEXT, maxmemory TEXT, execution TEXT)");
		$this -> db_data -> exec("CREATE TABLE data (id integer  primary key ,sessionId TEXT,type integer,  data text)");*/	
		//$this -> generateSession(true);
	}
	
	public function generateSession($force = false) {
		
		$timeStamp = microtime(true);
		/*$insert = "INSERT INTO sessions (sessionId, timestamp, startTime, endTime, maxmemory, execution ) 
				   VALUES (:sessionId, :timestamp, :startTime, :endTime, :maxmemory, :execution )";*/
		
		/*$addData = $this -> db_data -> prepare($insert);
		
		$addData -> bindParam(':sessionId', $this->sessionId);
		$addData -> bindParam(':timestamp', $timeStamp);
		$addData -> bindParam(':startTime', microtime(true));
		$addData -> bindParam(':endTime',   microtime(true));
		$addData -> bindParam(':maxmemory', $this->db_data->quote('0 MB'));
		$addData -> bindParam(':execution', $this->db_data->quote('0 s'));
		
		$addData -> execute();*/
		
	}
	
	private function getApplicationId($app_id = ''){
		return $this->db_data->query("SELECT id FROM applications WHERE app_id = '{$appId}'", PDO::FETCH_OBJ)->fetch();
	}
	
	private function getSession(){
		return $this->db_data->query("SELECT * FROM sessions WHERE sessionId = '{$this->sessionId}'", PDO::FETCH_OBJ)->fetch();
	}

	public function getTrace($asObject = false) {
		$oSession = $this->getSession();
		$SQL = "SELECT * FROM data WHERE sessionId = '{$this->sessionId}'";
				
		$data = array();
		
		foreach ($this->db_data->query($SQL, PDO::FETCH_OBJ) as $oData) {
			
			array_push($data, json_decode($oData->data));
		}
		
		$oSession->data = $data;
		
		return $oSession;
	}
	
	public function saveSession() {
				
		$oSession =  $this->getSession();
		
		$oSession->endTime = microtime(true);
		$oSession->maxmemory = number_format((memory_get_peak_usage() / 1024 / 1024), 2) . ' MB';
		$oSession->execution = '0 s';
		
		if (($oSession->endTime - $oSession->startTime) != 0){
			$oSession->execution = number_format(($oSession -> endTime - $oSession -> startTime) / 1000, 4) . ' s';
		}

		$Update = 'UPDATE sessions SET endTime = :endTime, maxmemory=:maxmemory, execution = :execution WHERE sessionId = :sessionId ';
		
		$addData = $this -> db_data -> prepare($Update);
		
		
		
		$addData -> bindParam(':sessionId', $this->sessionId, PDO::PARAM_STR);
		$addData -> bindParam(':endTime',   $oSession->endTime);
		$addData -> bindParam(':maxmemory', $oSession->maxmemory, PDO::PARAM_STR );
		$addData -> bindParam(':execution', $oSession->execution, PDO::PARAM_STR);
		
		$addData -> execute();
				
		return $oSession;
	}

	private function compress($data) {
		
		
		
		//$cDataStd = gzcompress($data);
		$cDataMax = gzcompress($data, 9);

		/*echo '<pre>' . $data . '</pre><br >' . (strlen($data) / 1024) . ' KB <br />';
		echo '<pre>' . $cDataStd . '</pre><br >' . (strlen($cDataStd) / 1024) . 'KB <br />';
		echo '<pre>' . $cDataMax . '</pre><br >' . (strlen($cDataMax) / 1024) . 'KB <br />';*/
		
		return $cDataMax;
	}

	private function uncrompress($data){
		return gzuncompress($data);
	}

	public function add($data = null) {
		$addData = null;
		
		$InsertData = 'INSERT INTO data (sessionId,type,data ) 
					   VALUES (:sessionId, :type, :data)';
					   
		$addData = $this -> db_data -> prepare($InsertData);
		
		$addData -> bindParam(':sessionId', $this->sessionId, PDO::PARAM_STR);
		$addData -> bindParam(':type', $data['type'], PDO::PARAM_INT);
		$addData -> bindParam(':data', json_encode($data), PDO::PARAM_STR);
		
		$addData -> execute();		
		var_dump($data);   	
		
	}
	
	public function getBy($tokenType = CDEBUG_TOKEN_NONE){
		$data = array();
		$oData = $this->db_data->query("SELECT * FROM data WHERE sessionId = '{$this->sessionId}' 
										AND type={$tokenType}", PDO::FETCH_OBJ);
		foreach ($oData as $row	){		
			array_push($data, json_decode($row->data));
		}
		return $data;
	}

}
?>
