<?php
	if (isset($_GET['email']) && isset($_GET['hash']))
	{
		$email = $_GET['email'];
		$hashed = $_GET['hash'];
		$verified = 1;
		include 'dbconnect.php';
		
		$stmt = $con->prepare("update users set verified = ? where email = ? and password = ?");
		$stmt->bind_param("iss", $verified, $email, $hashed);
		$stmt->execute();
		echo "Email verified successfully !";
	}
?>