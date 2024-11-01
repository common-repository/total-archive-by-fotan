<?php
	// Use the $_GET in case global vars is turned off in PHP
	$del = $_GET['del'];
	$ret = $_GET['ret'];
	
	if($del != "")
		{
			
			unlink($del);
		}
		
	header("Location: $ret");
?>