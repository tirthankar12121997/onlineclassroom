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
		echo $fullname.$dob.$oldpass.$nepass;
	}
	else
	{
		echo $fullname.$dob;
	}
	
	
	
?>