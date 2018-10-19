<?php
	if (isset($_COOKIE["userid"]))
	{
		include 'dbconnect.php';
		
		$hashid = $_COOKIE["userid"];
		$stmt = $con->prepare("update users set hashid = NULL where hashid = ?");
		$stmt->bind_param("s", $hashid);
		$stmt->execute();

		setCookie("userid", $hashid, time() - 60, "/");
	}
?>