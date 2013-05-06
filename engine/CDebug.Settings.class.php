<?php
class CDebug_Settings {

	private $settings  = array
	(
		'enable'             	=> CDEBUG_DISABLE,
        'catch_errors'		 	=> CDEBUG_DISABLE,
        'catch_exceptions'		=> CDEBUG_DISABLE,
        'profiling'				=> CDEBUG_DISABLE,

        'exclude_errors'		=> array(CDEBUG_TOKEN_WARNING,CDEBUG_TOKEN_NOTICE, CDEBUG_TOKEN_DEPRECATED),
       	
       	'owner'				 	=> array(),

       	'devs'					=> array(),
       	
       	'uses'				 	=> null,

        'title'				 	=> null,
        'templates'			 	=> null,
              
		'gmt_time'				=> -8,
		'date_format'			=> 'd-m-Y H:i',
		'silent_error'			=> false
	);

	public function __get($setting)
	{
		if ( isset($this->$setting ) )
			return $this->settings[$setting] ;
		
		throw new Exception("Config $setting isn't declare", CDEBUG_ERR_NOT_DECLARED_SETTING);
		
	}
	
	public function __set($setting, $value)
	{
		$this->settings[$setting] = $value;
	}
	
	public function __isset($setting)
	{
		//echo "Is '$setting' set?\n";
        return isset($this->settings[$setting]);
	}
}

?>