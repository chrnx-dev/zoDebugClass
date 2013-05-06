<?php
class Test extends CDebug_Module
{
	public function end($TOKEN)
	{
		$ticket =  md5(time()); 
		foreach ($TOKEN['errors'] as $error) 
		{
			$body .= $this->format($error);
		}

		foreach ($TOKEN['headers'] as $error) 
		{
			$body .= $this->format($error);
		}

		foreach ($TOKEN['debugs'] as $error) 
		{
			$body .= $this->format($error);
		}

		$body .= '<br/><b>Memory Real: </b>'.(memory_get_peak_usage(true)/1024/1024).' MB';
		$body .= '<br/><b>Memory: </b>'.(memory_get_peak_usage()/1024/1024).' MB';
		$subject = "[TMO|DEMOUNLOCK|T] - Error Module Response";

		$to = implode(',', CDebug::getConfig()->owner);

		// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Cabeceras adicionales
		$headers .= 'From: Debbug Class <no-reply@gameloft.com>' . "\r\n";
			
		// Mail it
		//mail($para, $subject, $mensaje, $cabeceras);
		mail('diego.resendez@gameloft.com',"[TMO|DEMOUNLOCK|T][$ticket] - Error Module Response", 
				$body, $headers);
	}

	protected function format($data = array())
	{
		if (empty($data)) return false;

		$msg = '';

		switch ($data['type']) 
		{
			case CDEBUG_TOKEN_USER_ERROR:
			case CDEBUG_TOKEN_ERROR:
				$msg = '<span style="color:red; width: 200px">ERROR: </span>';
				break;

			case CDEBUG_TOKEN_USER_WARNING:
			case CDEBUG_TOKEN_WARNING:
				$msg = '<span style="color:#ff8000; width: 200px">WARNING: </span>';
				break;
			
			case CDEBUG_TOKEN_USER_NOTICE:
			case CDEBUG_TOKEN_NOTICE:
				$msg = '<span style="color:#21610B; width: 200px">NOTICE: </span>';
				break;

			case CDEBUG_TOKEN_USER_DEPRECATED:
			case CDEBUG_TOKEN_DEPRECATED:
				$msg = '<span style="color:#045FB4; width: 200px">DEPRECATED: </span>';
				break;

			case CDEBUG_TOKEN_EXCEPTION:
				$msg = '<span style="color:red; width: 200px">EXCEPTION: </span>';
				break;
			default:
				$msg = '<span style="color:red; width: 200px">'.$data['value'].' </span>';
				break;
		}
		$msg .= '<pre>'.print_r($data['value'],true).'</pre><br />';
		return $msg;
	}
}
?>