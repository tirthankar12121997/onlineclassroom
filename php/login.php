<?php
	include 'dbconnect.php';
	
	$email = $_POST["username"];
	$password = $_POST["password"];
	
	$stmt = $con->prepare("select count(*) as num, password as hashed from users where email = ?");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();
	$r = $result->fetch_assoc();
	if ($r['num'] == 1)
	{
		if (password_verify($password, $r['hashed']))
		{
			echo "Logged in";
		}
		else
		{
			echo "Incorrect Username/password";
		}
	}
	else
	{
		echo "User does'nt exist! Try signing up.";
	}
?>