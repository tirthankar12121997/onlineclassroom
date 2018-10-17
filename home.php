<?php
	if (isset($_COOKIE["userid"]))
	{
		include 'php/dbconnect.php';
		$hashid = $_COOKIE["userid"];
		$stmt = $con->prepare("select count(*) as num from users where hashid = ?");
		$stmt->bind_param("s", $hashid);
		$stmt->execute();
		$result = $stmt->get_result();
		$r = $result->fetch_assoc();
		if ($r["num"] != 1) {
			header("Location: http://localhost:8080/rdbms/rdbmsproject/onlineclassroom/register.html");
			exit();
		}
	}
	else
	{
		header("Location: http://localhost:8080/rdbms/rdbmsproject/onlineclassroom/register.html");
		exit();
	}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<title>Welcome!</title>
    <meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <style>
	body {
		color: #ffffff;
	}
	.hbg {
		background-color: #262626;
		color: #ffffff;
	}
	.hindent {
		text-indent: 30px;
	}
	.po {
		background-color: #e65c00;
		cursor: pointer;
	}
	.po:hover {
		box-shadow: 3px 5px 10px #888888;
	}
  </style>
  <body>
	<div class="container-fluid hbg">
		<h1 class="display-1 hindent">Online Classroom</h1>
	</div>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href="#">StayConnected</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li class="dropdown"><a href="#">Join Group</a></li>
					<li><a href="#">Create Group</a></li>
					<li id="logoutb"><a href="#"><i class="glyphicon glyphicon-user"></i> Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- home section -->
	<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3">
		<div class="panel po">
			<div class="panel-heading">
				<h3 class="display-2">Group - 1</h3>
			</div>
			<div class="panel-body">
				Group - 1 description
			</div>
		</div>
		</div>
		<div class="col-sm-3">
		<div class="panel po">
			<div class="panel-heading">
				<h3 class="display-2">Group - 2</h3>
			</div>
			<div class="panel-body">
				Group - 2 description
			</div>
		</div>
		</div>
		<div class="col-sm-3">
		<div class="panel po">
			<div class="panel-heading">
				<h3 class="display-2">Group - 3</h3>
			</div>
			<div class="panel-body">
				Group - 3 description
			</div>
		</div>
		</div>
		<div class="col-sm-3">
		<div class="panel po">
			<div class="panel-heading">
				<h3 class="display-2">Group - 4</h3>
			</div>
			<div class="panel-body">
				Group - 4 description
			</div>
		</div>
		</div>
	</div>
	</div>
	
	<!-- join group section -->
	
	
	<!-- create group section -->
	
	
  </body>
  <script>
	logout = document.getElementById("logoutb");
	logout.onclick = function () {
		var hr = new XMLHttpRequest();
		hr.onreadystatechange = function () {
			if (hr.readyState == XMLHttpRequest.DONE) {
				if (hr.status == 200) {
					window.location = "http://localhost:8080/rdbms/rdbmsproject/onlineclassroom/register.html";
				}
				else if (hr.status == 404) {
					alert("not found");
				}
			}
		}
		hr.open("GET", "php/logout.php", true);
		//hr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		hr.send(null);
	}
  
  </script>
</html>