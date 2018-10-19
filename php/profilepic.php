<?php
	if (isset($_COOKIE["userid"]))
	{
		include 'dbconnect.php';
		$hashid = $_COOKIE["userid"];
		$stmt = $con->prepare("select id, url, count(*) as num from users where hashid = ?");
		$stmt->bind_param("s", $hashid);
		$stmt->execute();
		$result = $stmt->get_result();
		$r = $result->fetch_assoc();
		if ($r["num"] != 1) {
			header("Location: http://localhost:8080/rdbms/rdbmsproject/onlineclassroom/register.html");
			exit();
		}
		else
		{
			if (isset($_FILES["uploads"]))
			{
				$name = $_FILES["uploads"]["name"];
				$tmpname = $_FILES["uploads"]["tmp_name"];
				$size = $_FILES["uploads"]["size"];
				$tmpext = explode(".", $name);
				$ext = end($tmpext);
			
				if ($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "gif")
				{
					if ($size > 1000000)
					{
						echo 0;
					}
					else
					{	
						if ($r["url"] != "profile/party.jpg")
						{
							if (file_exists($r["url"]))
								unlink($r["url"]);
						}
						
						$id = $r["id"];
						$url = "profile/".$id.time().".".$ext;
						move_uploaded_file($tmpname, $url);
						$stmt2 = $con->prepare("update users set url = ? where id = ?;");
						$stmt2->bind_param("si", $url, $id);
						$stmt2->execute();
						echo $url;
					}
				}
				else
				{
					echo 0;
				}
			}
			else
			{
				header("Location: http://localhost:8080/rdbms/rdbmsproject/onlineclassroom/home.php");
				exit();
			}
				
		}
	}
	else
	{
		header("Location: http://localhost:8080/rdbms/rdbmsproject/onlineclassroom/register.html");
		exit();
	}	
?>