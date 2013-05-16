<?php
Class WordpressHelper extends CDebug_Helpers {
	public function __construct(){
		
	}
	
	public function output_analizer(){
		return '<script type="text/javascript">
			
			var zoConsole = $("<div />");
			zoConsole.attr("id","zoConsole");
			$("body").append(zoConsole);
		</script>';
	}
}	

?>
