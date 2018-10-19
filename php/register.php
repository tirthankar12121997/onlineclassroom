<?php
	include 'dbconnect.php';
	
	$fullname = $_POST["fullname"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$hashed = password_hash($password, PASSWORD_DEFAULT);
	$dob = $_POST["dob"];
	$gender = $_POST["gender"];
	$verified = 0;
	$url = "profile/party.jpg";
	
	$stmt = $con->prepare("select count(*) as num from users where email = ?");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();
	$r = $result->fetch_assoc();
	if ($r['num'] == 0)
	{
		$stmt2 = $con->prepare("insert into users(email, password, full_name, dob, gender, verified, url) values(?, ?, ?, ?, ?, ?, ?)");
		$stmt2->bind_param("sssssis", $email, $hashed, $fullname, $dob, $gender, $verified, $url);
		$stmt2->execute();
		$result = $stmt2->get_result();
		$m = mail($email, 'Verification Mail for joining Classroom', 'This is a verification mail.
Click on the link below to verify your mail-id 
http://localhost:8080/rdbms/rdbmsproject/onlineclassroom/php/verify.php?email='.$email.'&hash='.$hashed,
"From: tirthankar.nayak@gmail.com");
		if ($m)
			echo "User created successfully!\nA verification link is sent to your email-id";
		else
			echo "error sending mail";
	}
	else
	{
		echo "User with the email-id already present! Try logging in.";
	}
	
	
?>