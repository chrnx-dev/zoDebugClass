<?php

class Wordpress extends CDebug_Module
{
	public function end($TOKEN)
	{
		if (!CDebug::isEnabled()) return false;
		
		
		
		$smarty = new Smarty();
		
		$smarty->setTemplateDir(CDEBUG_VENDORS.'smarty'.DS.'templates'.DS);
		$smarty->setCompileDir(CDEBUG_VENDORS.'smarty'.DS.'templates_c'.DS);
		$smarty->setConfigDir(CDEBUG_VENDORS.'smarty'.DS.'configs'.DS);
		$smarty->setCacheDir(CDEBUG_VENDORS.'smarty'.DS.'cache'.DS);
		
		$debugs = array();
		$errors = array();
		
		foreach ($TOKEN['debugs'] as $debug){
			$debugs[] = $this->format($debug);
		}
		
		foreach ($TOKEN['errors'] as $error){
			$errors[] = $this->format($error);
		}
		

		
		$smarty->assign('headHTML', !CDebug::hasHTML());
		
		
		$smarty->assign('debugs', $debugs);
		$smarty->assign('errors', $errors);
		if ( !$this->isAjax() || ( !empty($debugs) || !empty($errors) )	){
			$smarty->display('extends:console.tpl|message.tpl');
		}	
		

	}
	protected function isAjax(){
		return ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' );
	}
	protected function format($data = array()){
		$stringToken = CDebug::stringToken($data['type']);
		
		if (!empty($data['file'])){
			$srcFile = @fopen($data['file'], "r");
			$from =  ($data['line']-6 > 0)?($data['line']-6):0;
			$to = $data['line']+5;
			$line = 0;
			$source = '';
			$buffer = '';
			
			while (($buffer = fgets($srcFile)) !== FALSE) {
			   if ($line >=$from && $line <=$to) {
				  $buffer = htmlentities($buffer, ENT_QUOTES);			   	
			      if ( $line == $data['line']-1){
			      	$source .=   '<strong>'.trim($buffer).'</strong><br />';
			      }else {
			      	$source .= trim($buffer).'<br />';
			      }	
			      
			   }   
			   $line++;
			}
			fclose($srcFile);
		}
		
		if ( $data['type'] == CDEBUG_TOKEN_STRING ){
			$data['value'] = htmlentities($data['value'], ENT_QUOTES);
		}
		$data['trace'] = $this->formatTrace($data['trace']);
		
		$data['class'] = 'label-'.str_replace(' ', '-', $stringToken);
		$data['stringToken'] = $stringToken;
		$data['srcDir'] = dirname($data['file']);
		$data['srcFilename'] = basename($data['file']);
		$data['srcLine'] = urlencode(trim($source));
		
		
		
		return $data;
	}

	
	
	protected function formatTrace($traces = array()){
		$format = array();
		$preFunction = '';	
		
		foreach ($traces as $trace) {
		
			
			$preFunction = '';
			$function = $trace['function'];	
			
			if (in_array($trace['function'], array('include', 'include_once'))){
				$action = " included ";
				$function = basename($trace['args'][0]);	
			} elseif (in_array($trace['function'], array('require', 'require_once'))){
				$action = " required ";
				$function = basename($trace['args'][0]);
			} else {
				$action = " executed ";
			}
			
			if (isset($trace['class'])){
				$preFunction = $trace['class'].$trace['type'];
			}
			$format[] = array(
				'message' => '<b>'.$preFunction.$function.'</b>' . ' has been '. $action,
				'file' => $trace['file'],
				'line' => $trace['line']
			);
		}
		
		return $format;
	}	
		
}
?>