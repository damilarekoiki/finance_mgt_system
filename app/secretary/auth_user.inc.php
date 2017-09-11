<?php
	if(!$secretary->is_login()){
		echo "<html><body bgcolor='brown'>
		<div style='color:white;width:100%'>
	
		OOPS! You have to login
	
		</div></body></html>";
	
		$secretary->redirect("../../index.php");
	  }

?>
