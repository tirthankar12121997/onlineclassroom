<?php
	include 'dbconnect.php';
	
	$email = $_POST["username"];
	$password = $_POST["password"];
	
	$stmt = $con->prepare("select id, count(*) as num, password as hashed from users where email = ?");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();
	$r = $result->fetch_assoc();
	if ($r['num'] == 1)
	{
		if (password_verify($password, $r['hashed']))
		{
			if (isset($_COOKIE["userid"]))
			{
				$stmt2 = $con->prepare("update users set hashid = NULL where hashid = ?");
				$stmt2->bind_param("s", $_COOKIE["userid"]);
				$stmt2->execute();
			}
			$hashid = password_hash($r['id'], PASSWORD_DEFAULT);
			$stmt1 = $con->prepare("update users set hashid = ? where id = ?");
			$stmt1->bind_param("si", $hashid, $r["id"]);
			$stmt1->execute();
			setCookie("userid", $hashid, time() + (60 * 60 * 24 * 30), "/");
			echo "logging in";
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