<?php
/**
 * Main Bootsrap for CDebug Class configuration
 * @author  : Diego Resendez <diego.resendez@zero-oneit.com>
 * @version : 1.0
 * @package : Bootstrap
 **/
ini_set('memory_limit', '256M');

define('DS', DIRECTORY_SEPARATOR);
define ('CDEBUG_PATH', dirname(__FILE__).DS );

define ('CDEBUG_ENGINE', CDEBUG_PATH.'engine'.DS);
define ('CDEBUG_MODULES', CDEBUG_PATH.'modules'.DS );
define ('CDEBUG_VENDORS', CDEBUG_PATH.'vendors'.DS);
define ('CDEBUG_HELPERS', CDEBUG_PATH.'helpers'.DS);
define ('CDEBUG_DRIVERS', CDEBUG_PATH.'drivers'.DS);


require_once CDEBUG_ENGINE.'CDebug.Tokens.class.php';
require_once CDEBUG_ENGINE.'CDebug.General.class.php';
require_once CDEBUG_ENGINE.'CDebug.Helpers.class.php';
require_once CDEBUG_ENGINE.'CDebug.Module.class.php';
require_once CDEBUG_ENGINE.'CDebug.ErrorManagement.class.php';
require_once CDEBUG_ENGINE.'CDebug.Settings.class.php';
require_once CDEBUG_ENGINE.'CDebug.Data.php';
require_once CDEBUG_ENGINE.'CDebug.class.php';

CDebug::init();
?>
