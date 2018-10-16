<?php
	
	$con = new mysqli("localhost", "root", "", "alpha");
	
	if (!$con)
		echo "error in connecting to db"; 
?>