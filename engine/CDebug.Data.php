<?php
class CDebug_Data {
	
	public static function Create($Driver = CDEBUG_DEFAULT_DRIVER){
		
		switch ($Driver) {
			case CDEBUG_SQLITEMEMORY_DRIVER:
				require_once CDEBUG_DRIVERS.'sqlitememory.driver.php';
				return new SqliteMemoryDriver;
				break;
			case CDEBUG_DEFAULT_DRIVER:
			default:
				require_once CDEBUG_DRIVERS.'default.driver.php';
				return new DefaultDriver;
				break;
		}	
	}
	
}
