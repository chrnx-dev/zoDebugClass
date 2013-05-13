<?php
if( !class_exists('CDebug_General')):
	
	abstract class CDebug_General{
		
		protected $properties = array();
				
		public function __get($property){
			if ( isset(CDebug::getSettings()->Helpers[$property])){
				return CDebug::getSettings()->Helpers[$property];
			}	
			if ( isset($this->$property ) )
				return $this->properties[$property] ;
			
			throw new Exception("Config $property isn't declare");
			
		}
		
		public function __set($property, $value){
			$this->properties[$property] = $value;
		}
		
		public function __isset($property){
	        return isset($this->properties[$property]);
		}
		
		public function __unset($property){
	        unset($this->properties[$property]);
		}
		
		public function import($helper_name,  $settings = array() ) {
			
			if (empty($helper_name) && !file_exists(CDEBUG_HELPERS.$helper_name.'.helper.php')) throw new Exception($helper_name);
			
			require_once (CDEBUG_HELPERS.$helper_name.'.helper.php');
			$className = ucfirst($helper_name).'Helper';
			$Reference = new ReflectionClass($className);
			
			if (!$Reference->isSubclassOf('CDebug_Helpers')) throw new Exception($helper_name);
			
			$Helpers =	CDebug::getSettings()->Helpers;
			
			if (is_null($Reference->getConstructor())){
				$Helpers[ucfirst($helper_name)] = $Reference->newInstance();
			}else{
				$Helpers[ucfirst($helper_name)] = $Reference->newInstanceArgs(array($settings));	
			}
			
			CDebug::getSettings()->Helpers = $Helpers;
			
		}
		
	}
	
endif;
?>