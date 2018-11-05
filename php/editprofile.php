<?php
	include 'dbconnect.php';
	
	$hashid = $_COOKIE["userid"];
	$stmt = $con->prepare("select * from users where hashid = ?");
	$stmt->bind_param("s", $hashid);
	$stmt->execute();
	$result = $stmt->get_result();
	$r = $result->fetch_assoc();
	$fullname = $r["full_name"];
	$dob = $r["dob"];
	if (isset($_POST["fullname"]) && strlen($_POST["fullname"]) >= 5)
		$fullname = $_POST["fullname"];
	if (isset($_POST["dob"]) && strlen($_POST["dob"]) != 0)
		$dob = $_POST["dob"];
	if (isset($_POST["oldpassword"]) && strlen($_POST["oldpassword"]) >= 5 && isset($_POST["nepassword"]) && strlen($_POST["nepassword"]) >= 5)
	{
		$oldpass = $_POST["oldpassword"];
		$nepass = $_POST["nepassword"];
		
		if (password_verify($oldpass, $r["password"]))
		{
			$hash = password_hash($nepass, PASSWORD_DEFAULT);
			$stmt2 = $con->prepare("update users set full_name = ?, dob = ?, password = ? where id = ?");
			$stmt2->bind_param("sssi", $fullname, $dob, $hash, $r["id"]);
			$stmt2->execute();
			echo 1;
		}
		else
			echo 3; 
		
	}
	else
	{
		$stmt2 = $con->prepare("update users set full_name = ?, dob = ? where id = ?");
		$stmt2->bind_param("ssi", $fullname, $dob, $r["id"]);
		$stmt2->execute();
		echo 2;
	}
	
	
	
?>