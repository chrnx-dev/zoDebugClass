<?php
interface CDebug_IData{
	public function generateSession($force = false);
	
	public function getTrace($asObject = false);
	public function add( $data );
	public function getBy($tokenType = CDEBUG_TOKEN_NONE);
	public function saveSession();
	
}
?>