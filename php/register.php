<?php
	include 'dbconnect.php';
	
	$fullname = $_POST["fullname"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$hashed = password_hash($password, PASSWORD_DEFAULT);
	$dob = $_POST["dob"];
	$gender = $_POST["gender"];
	$verified = 0;
	
	$stmt = $con->prepare("select count(*) as num from users where email = ?");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();
	$r = $result->fetch_assoc();
	if ($r['num'] == 0)
	{
		$stmt2 = $con->prepare("insert into users(email, password, full_name, dob, gender, verified) values(?, ?, ?, ?, ?, ?)");
		$stmt2->bind_param("sssssi", $email, $hashed, $fullname, $dob, $gender, $verified);
		$stmt2->execute();
		$result = $stmt2->get_result();

		echo "User created successfully!";
	}
	else
	{
		echo "User with the email-id already present! Try logging in.";
	}
	
	
?>