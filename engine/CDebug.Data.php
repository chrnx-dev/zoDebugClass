<?php
class CDebug_Data{
	
	private $data = array(
		'debugs' => array(),
		'errors' => array(),
		'headers' => array(),
	);

	
	private $sessionId = null;
	private $timestamp = null;
	private $startTime = null;
	private $endTime = null;
	private $maxmemory = null;
	private $execution = null;

	public function __construct()
	{
		$this->generateSession(true);

	}

	private function generateSession($force = false){
		if ($force)	
		{
			$this->timestamp = microtime(true);
			$this->sessionId = sha1('Debug-'.$this->timestamp);
			$this->startTime = microtime(true);
		}

		if (isset($_COOKIE['x-debug-session']) && ( $debug = json_decode($_COOKIE['x-debug-session'],true) ) )
		{
			//echo 'x-debug-session <pre>'.print_r($debug,true).'</pre>';
			$this->data = $debug['data'];
			$this->timestamp = $debug['timestamp'];
			$this->sessionId = $debug['sessionId'];
			$this->startTime = $debug['startTime'];
		}

		
	}

	public function Trace(){
		//echo  'Data <pre>'.print_r($this->data,true).'</pre>';
		return $this->data;
	}

	public function saveSession()
	{

		$this->endTime = microtime(true);
        $this->maxmemory= number_format( (memory_get_peak_usage()/1024/1024), 2 ).' MB';
        $this->execution = number_format(($this->endTime - $this->startTime)/1000,2). ' s';
        
        
		
		$oSession = new stdClass;
		$oSession->data = $this->data;
		$oSession->sessionId = $this->sessionId;
		$oSession->timestamp = $this->timestamp;
		$oSession->startTime = $this->startTime;
		$oSession->endTime = $this->endTime;
		$oSession->maxmemory = $this->maxmemory;
		$oSession->execution = $this->execution;



		setcookie('x-debug-session', json_encode($oSession),0, '/');
		$_COOKIE['x-debug-session'] =json_encode($oSession);

		return $oSession;
	}

	public function test_compress()
    {
        $this->endTime = microtime(true);
        $this->maxmemory= number_format( (memory_get_peak_usage()/1024/1024), 2 ).' MB';
        $this->execution = number_format(($this->endTime - $this->startTime)/1000,2). ' s';
        
        
		
		$oSession = new stdClass;
		$oSession->data = $this->data;
		$oSession->sessionId = $this->sessionId;
		$oSession->timestamp = $this->timestamp;
		$oSession->startTime = $this->startTime;
		$oSession->endTime = $this->endTime;
		$oSession->maxmemory = $this->maxmemory;
		$oSession->execution = $this->execution;
        $data = json_encode($oSession);
        $cDataStd = gzcompress($data);
        $cDataMax = gzcompress($data,9);

        echo '<pre>'.$data.'</pre><br >'.(strlen($data)/1024).' KB <br />';
        echo '<pre>'.$cDataStd.'</pre><br >'.(strlen($cDataStd)/1024).'KB <br />';
        echo '<pre>'.$cDataMax.'</pre><br >'.(strlen($cDataMax)/1024).'KB <br />';
    }


	public function add($data)
	{
		if ($data['type'] == CDEBUG_TOKEN_NONE) return;

		if (($data['type'] >= CDEBUG_TOKEN_ERROR ) && ($data['type'] <= CDEBUG_TOKEN_EXCEPTION))
			$this->data['errors'][] = $data;
		else
			$this->data['debugs'][] = $data;
	}

	public function addHeader($header, $value)
	{
		if (empty($header) || empty($value)) return false;

		$this->data['headers'][$header] = $value;
	}


}