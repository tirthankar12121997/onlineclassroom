<?php
	$fullname = $_POST["fullname"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$dob = $_POST["dob"];
	$gender = $_POST["gender"];
	
	echo "Name = ".$fullname."\nEmail = ".$email."\npassword = ".$password."\nDate of Birth = ".$dob."\nGender = ".$gender;
?>