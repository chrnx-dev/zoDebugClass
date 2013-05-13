<?php
class CDebug_Settings extends CDebug_General{

	protected $properties  = array
	(
		'enable'             	=> CDEBUG_DISABLE,
        'catch_errors'		 	=> CDEBUG_ENABLE,
        'catch_exceptions'		=> CDEBUG_ENABLE,
        'profiling'				=> CDEBUG_DISABLE,

        'exclude_errors'		=> array(CDEBUG_TOKEN_WARNING,CDEBUG_TOKEN_NOTICE, CDEBUG_TOKEN_DEPRECATED, CDEBUG_TOKEN_USER_NOTICE),
       	
       	'owner'				 	=> array(),

       	'devs'					=> array(),
       	
       	'uses'				 	=> null,

        'title'				 	=> null,
        'Blocks'				=> array('__MAIN__'),
        'Modules'				=> array(),
        'helper_autoload'		=> array('core'),
        'Helpers'				=> array(),
        'templates'			 	=> null,
              
		'gmt_time'				=> -8,
		'date_format'			=> 'd-m-Y H:i',
		'hasFatalError'			=> false
	);

	
}

?>