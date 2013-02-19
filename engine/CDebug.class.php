<?php
class CDebug 
{
	private static $settings = null;
    private static $data = null;
    private static $profile = null;
    private static $e_handling = null;
    private static $status = CDEBUG_FLOW_POINT;

    private static $Blocks = array('__MAIN__');
    private static $Modules = array();
   

    public static $errorTable = array
    (
            E_ERROR                 => CDEBUG_TOKEN_ERROR,
            E_WARNING               => CDEBUG_TOKEN_WARNING,
            E_PARSE                 => CDEBUG_TOKEN_ERROR,
            E_NOTICE                => CDEBUG_TOKEN_NOTICE,
            E_CORE_ERROR            => CDEBUG_TOKEN_ERROR,
            E_CORE_WARNING          => CDEBUG_TOKEN_WARNING,
            E_COMPILE_ERROR         => CDEBUG_TOKEN_ERROR,
            E_COMPILE_WARNING       => CDEBUG_TOKEN_WARNING,
            E_USER_ERROR            => CDEBUG_TOKEN_USER_ERROR,
            E_USER_WARNING          => CDEBUG_TOKEN_USER_WARNING,
            E_USER_NOTICE           => CDEBUG_TOKEN_USER_NOTICE,
            E_STRICT                => CDEBUG_TOKEN_NOTICE,
            E_RECOVERABLE_ERROR     => CDEBUG_TOKEN_ERROR
    );
	
    
	public static function init( $configs = null )
    {
		if (defined('E_DEPRECATED'))
        {
            self::$errorTable[E_DEPRECATED] = CDEBUG_TOKEN_DEPRECATED;
        }

        if (defined('E_USER_DEPRECATED'))
        {
            self::$errorTable[E_USER_DEPRECATED] = CDEBUG_TOKEN_USER_DEPRECATED;
        }

        self::$settings = new CDebug_Settings();
		
		if (!empty($configs)) 
        {
			foreach ($configs as $config => $value) 
            {
				self::$settings->$config = $value;
			}
		}
        self::$e_handling = new CDebug_ErrorManagement();
        self::$data = new CDebug_Data();

        register_shutdown_function('CDebug::_END');
	}

    public static function _END()
    {
        /**
         * Only Fatal Errors Catched
         **/
        if (!is_null($e = error_get_last()) && !in_array( self::$errorTable[$e['type']], array(CDEBUG_TOKEN_WARNING,CDEBUG_TOKEN_NOTICE,CDEBUG_TOKEN_DEPRECATED)))
        {
            $bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);	
            $data = array(
                'value' => $e['message'],
                'line'  => $e['line'],
                'file'  => $e['file'],
                'block' => CDebug::getBlock(),
                'trace' => $bt
            );
            $TOKEN = new TOKEN($data, self::$errorTable[$e['type']]);
            self::getTrace()->add($TOKEN->returnToken());

        }
		//echo 'Trace: <pre>'.print_r(self::getTrace(),true).'</pre><br />';
        //echo 'Cookies: <pre>'.print_r($_COOKIE,true).'</pre><br />';
        //echo 'Config: <pre>'.print_r(CDebug::getConfig(),true).'</pre><br />';
        //echo 'Include Files: <pre>'.print_r(get_included_files(),true).'</pre><br />';
        //self::getTrace()->saveSession();
        self::propagate(CDEBUG_EVENT_END, self::getTrace()->Trace());
        

        
    }

    public static function log($variable, $name) 
    {
        if (!self::isEnabled()) return false;

        $bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $caller = array_shift($bt);
        $file =  $caller['file'];

        $data = array(
            'value' => $variable,
            'line'  => $caller['line'],
            'file'  => $file,
            'block' => self::getBlock(),
            'name'  => $name,
            'trace' => $bt
        );
        
		
       
        $TOKEN = new TOKEN($data, self::varType($variable));
		self::$data->add($TOKEN->returnToken());
		self::propagate(CDEBUG_EVENT_LOG, $TOKEN->returnToken());
		
    }

    /**
     * Add a Message to debug report
     * @param string $message
     */
    public static function message($message)
    {
        if (!self::isEnabled()) return false;

        $bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $caller = array_shift($bt);
        $file =  $caller['file'];

        $data = array(
            'value' => $message,
            'line'  => $caller['line'],
            'file'  => $file,
            'block' => self::getBlock(),
            'trace' => $bt
        );
        $TOKEN = new TOKEN($data, CDEBUG_TOKEN_MESSAGE);
        self::$data->add($TOKEN->returnToken());
        self::propagate(CDEBUG_EVENT_MESSAGE, $TOKEN->returnToken());
    }


    public static function __callStatic($name, $arguments)
    {
        self::propagate($name, self::getTrace()->Trace() );
    }

    public static function setStatus($status= CDEBUG_FLOW_POINT)
    {
        if (!in_array($status, array(CDEBUG_FLOW_POINT, CDEBUG_START_POINT, CDEBUG_END_POINT))) $status = CDEBUG_FLOW_POINT;
        self::$status = $status;
    }

    public static function getStatus()
    {
        return self::$status;
    }

    public static function startBlock($name='')
    {
        if (empty($name)) return false;

        array_push(self::$Blocks, $name);
    }

    public static function endBlock()
    {
        array_pop(self::$Blocks);
    }

    public static function getBlock()
    {
        return end(self::$Blocks);
    }

    public static function set($config, $value)
    {
        if(empty($config) && empty($value)) return false;

        self::$settings->$config = $value;
    }

	public static function getConfig()
    {
    	return self::$settings;
    }

    public static function getTrace()
    {
        return self::$data;
    }


    public static function saveSession()
    {
        self::$data->saveSession();
    }
   
    public static function isEnabled()
    {
        return ((bool)self::$settings->enable & 255) && (self::$settings->enable == CDEBUG_ENABLE);
    }

    public static function Uses( $name, $file = null, $params = array() )
    {
        
        if ( empty($file ) ) {
            $file = $name.'.module.php';
        }

        if ( file_exists($file) )        
        {
            $rootModule = $file;
        }
        elseif (defined('CDEBUG_USER_MODULES') && file_exists(CDEBUG_USER_MODULES.$file))
        {
            $rootModule = CDEBUG_USER_MODULES.$file;
        }
        elseif ( file_exists(CDEBUG_MODULES.$file) )
        {
            $rootModule = CDEBUG_MODULES.$file;
        }
        else
        {
            $rootModule = false;
            trigger_error("Module <b>$name</b> doesn't valid or not exists");
        }

        if ($rootModule)
        {
            $data = new stdClass;
            $data->file = $rootModule;
            $data->params = $params;
            self::$Modules[$name] = $data;
        }


        
            
    }

    public static function propagate($event = CDEBUG_EVENT_NONE, $data = array() )
    {
        $mods = self::$Modules;
       
        if ( !empty(self::$Modules) ) 
        {
           
            foreach (self::$Modules as $name => $module) 
            {
               
               try 
               {
                   require_once $module->file;
                   $REF = new ReflectionClass( ucfirst($name) );
                   if ($REF->getShortName() !==  ucfirst($name) ) throw new Exception();
                        
                   if ($REF->isSubclassOf('CDebug_Module'))
                   {
                        $oReference = $REF->newInstanceArgs(array($module->params));
                        $oReference->trigger($event, $data);    
                       
                   }
                   else
                   {
                        trigger_error("Class: <b>".$REF->getShortName()."</b> isn't a CDebugModule class");
                   }
                        
               } 
               catch( Exception $Exception )
               {
                    print_r($Exception->getMessage());
                    trigger_error("Class Module: <b>$name</b> doesn't exists verify that class is perfect declared");
               }
            
            }
        }
    }


	public static function stringToken($type){
		switch ($type) {
			case CDEBUG_TOKEN_NONE:
				return 'None';
				break;
			case CDEBUG_TOKEN_ERROR:
				return 'Error';
				break;
			case CDEBUG_TOKEN_USER_ERROR:
				return 'User Error';
				break;
			case CDEBUG_TOKEN_WARNING:
				return 'Warning';
				break;
			case CDEBUG_TOKEN_USER_WARNING:
				return 'User Warning';
				break;
			case CDEBUG_TOKEN_NOTICE:
				return 'Notice';
				break;
			case CDEBUG_TOKEN_USER_NOTICE:
				return 'User Notice';
				break;
			case CDEBUG_TOKEN_DEPRECATED:
				return 'Deprecated';
				break;
			case CDEBUG_TOKEN_USER_DEPRECATED:
				return 'User Deprecated';
				break;
			case CDEBUG_TOKEN_EXCEPTION:
				return 'Exception';
				break;
			case CDEBUG_TOKEN_MESSAGE:
				return 'Message';
				break;
			case CDEBUG_TOKEN_CHECKPOINT:
				return 'Checkpoint';
				break;
			case CDEBUG_TOKEN_OBJECT:
				return 'Object';
				break;
			case CDEBUG_TOKEN_STRING:
				return 'String';
				break;
			case CDEBUG_TOKEN_ARRAY:
				return 'Array';
				break;
			case CDEBUG_TOKEN_NUMERIC:
				return 'Numeric';
				break;
			case CDEBUG_TOKEN_BOOLEAN:
				return 'Boolean';
				break;
			case CDEBUG_TOKEN_RESOURCE:
				return 'Resource';
				break;
			case CDEBUG_TOKEN_UNKNOW:
				return 'Unknown';
				break;
			case CDEBUG_TOKEN_UNDEFINED:
			default:
				return 'Undefined';				
				break;
		}
	}
	
    public static function varType($var)
    {
        if (is_object ( $var ))
        return CDEBUG_TOKEN_OBJECT;
        if (is_null ( $var ))
        return CDEBUG_TOKEN_UNDEFINED;
        if (is_string ( $var ))
        return CDEBUG_TOKEN_STRING;
        if (is_array ( $var ))
        return CDEBUG_TOKEN_ARRAY;
        if (is_int ( $var ) || is_float ( $var ))
        return CDEBUG_TOKEN_NUMERIC;
        if (is_bool ( $var ))
        return CDEBUG_TOKEN_BOOLEAN;
        
        if (is_resource ( $var ))
        return CDEBUG_TOKEN_RESOURCE;
    
        return CDEBUG_TOKEN_UNKNOW;
    }



    
}
?>