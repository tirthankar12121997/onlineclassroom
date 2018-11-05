<?php
	if (isset($_COOKIE["userid"]))
	{
		include 'php/dbconnect.php';
		$hashid = $_COOKIE["userid"];
		$stmt = $con->prepare("select *, count(*) as num from users where hashid = ?");
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
			$id = $r["id"];
			$name = $r["full_name"];
			$email = $r["email"];
			$gender = $r["gender"];
			$dob = $r["dob"];
			$url = $r["url"];
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
	#home {
		display: none;
	}
	.ppic {
		box-shadow: 3px 5px 10px #888888;
		cursor: pointer;
	}
	.editc {
		display: none;
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
					<li><a href="#"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
					<li id="logoutb"><a href="#"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- home section -->
	<div id="home" class="container-fluid">
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
	
	
	<!-- profile section -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<div class="panel">
					<div class="panel-body">
						<img id="pic" src="<?php echo "php/".$url; ?>" class="img-responsive img-rounded ppic" />
					</div>
					<div class="panel-body">
						<input id="fileupload" type="file" />
					</div>
					<div class="panel-body">
						<button id="uploadb" class="btn btn-primary">Upload Image</button>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="panel panel-info">
					<div class="panel-heading">
					<h3 class="display-2">PROFILE DETAILS <button id="editb" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</button></h3>
					</div>
					<div class="panel-body">
						<label>NAME</label> : <span id="namefield"><?php
							echo $name;
						?></span>
						<input id="editname" type="text" class="form-control editc" placeholder="Enter the Full name to edit"/>
						<span id="namespan"></span>
					</div>
					<div class="panel-body">
						<label>EMAIL</label> : <?php
							echo $email;
						?>
					</div>
					<div class="panel-body">
						<label>PASSWORD</label> : Click on edit to change password
						<input id="editoldpass" type="password" class="form-control editc" placeholder="Old password"/>
						<br/><br/>
						<input id="editnepass" type="password" class="form-control editc" placeholder="New password"/>
						<span id="passspan"></span>
					</div>
					<div class="panel-body">
						<label>PROFESSION</label> : 
					</div>
					<div class="panel-body">
						<label>DATE OF BIRTH(AGE)</label> : <span id="dobfield"><?php
							echo $dob;
						?></span>
						<input id="editdob" type="date" class="form-control editc" placeholder="Enter your birthday"/>
						<span id="dobspan"></span>
					</div>
					<div class="panel-body">
						<label>GENDER</label> : <?php
							echo $gender;
						?>
					</div>
					<div class="panel-body">
						<label>MEMBER</label> : 
					</div>
					<div class="panel-body">
						<label>ADMIN</label> : 
					</div>
					<div class="panel-body">
						<button id="saveb" class="btn btn-primary editc">Edit and Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script>
	logout = document.getElementById("logoutb");
	upload = document.getElementById("uploadb");
	fileupload = document.getElementById("fileupload");
	editb = document.getElementById("editb");
	editc = document.getElementsByClassName("editc");
	saveb = document.getElementById("saveb");
	editname = document.getElementById("editname");
	editoldpass = document.getElementById("editoldpass");
	editnepass = document.getElementById("editnepass");
	editdob = document.getElementById("editdob");
	//editmale = document.getElementById("editmale");
	//editfemale = document.getElementById("editfemale");
	
	for (var i = 0; i < editc.length; i++)
		editc[i].style.display = "none";
	
	logout.onclick = function () {
		var hr = new XMLHttpRequest();
		hr.onreadystatechange = function () {
			if (hr.readyState == XMLHttpRequest.DONE) {
				if (hr.status == 200) {
					alert(hr.responseText);
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
	
	upload.onclick = function () {
		file = new FormData();
		if (fileupload.files.length === 0)
			alert("select a file for profile picture");
		else
		{
			ftype = fileupload.files[0].name;
			fsize = fileupload.files[0].size;
			ftype = ftype.split(".");
			ftype = ftype[ftype.length - 1].toLowerCase();
			if (ftype == "png" || ftype == "jpg" || ftype == "jpeg" || ftype == "gif")
			{
				if (fsize > 1024000) {
					alert("file size should be under 1 MB");
				}
				else
				{
					file.append("uploads", fileupload.files[0]);
					//alert(fileupload.files[0].value);
					var hr = new XMLHttpRequest();
					hr.onreadystatechange = function () {
						if (hr.readyState == XMLHttpRequest.DONE) {
							if (hr.status == 200) {
								if (hr.responseText != "0"){
									var image = "php/" + hr.responseText;
									document.getElementById("pic").src = image;
								}
								else
									alert("Error");
								//window.location = "http://localhost:8080/rdbms/rdbmsproject/onlineclassroom/register.html";
							}
							else if (hr.status == 404) {
								alert("not found");
							}
						}
					}
					hr.open("POST", "php/profilepic.php", true);
					//hr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					hr.send(file);
					
				}
			}
			else
			{
				alert("Not a supported file type");
			}
		}
		
		
	}
	
	editb.onclick = function () {
		if (editc[0].style.display == "none") {
			for (var i = 0; i < editc.length; i++)
			{
				editc[i].style.display = "inline-block";
			}
			this.innerHTML = "<i class='glyphicon glyphicon-remove'></i> Close";
		} else {
			for (var i = 0; i < editc.length; i++)
			{
				editc[i].style.display = "none";
			}
			this.innerHTML = "<i class='glyphicon glyphicon-edit'></i> Edit";
		}
	}
	
	saveb.onclick = function () {
		if (editname.value != "" && editname.value.length < 5)
			alert("Enter a valid name !");
		else if (editoldpass.value != "" && editoldpass.value.length < 5)
			alert("Enter a valid old password");
		else if (editnepass.value != "" && editnepass.value.length < 5)
			alert("Enter a valid new password");
		else
		{
			var hr = new XMLHttpRequest();
			hr.onreadystatechange = function () {
			if (hr.readyState == XMLHttpRequest.DONE) {
				if (hr.status == 200) {
					if (hr.responseText == "2")
					{
						editb.click();
						if (editname.value.length != 0 && editname.value.length >= 5)
							document.getElementById("namefield").innerHTML = editname.value;
						if (editdob.value.length != 0)
							document.getElementById("dobfield").innerHTML = editdob.value;
						alert("Made the changes");
					}
					else if (hr.responseText == "1")
					{
						editb.click();
						if (editname.value.length != 0 && editname.value.length >= 5)
							document.getElementById("namefield").innerHTML = editname.value;
						if (editdob.value.length != 0)
							document.getElementById("dobfield").innerHTML = editdob.value;
						alert("Made the changes");
					}
					else
					{
						alert("old password is incorrect");
					}
				}
				else if (hr.status == 404) {
					alert("not found");
				}
			}
			}
			hr.open("POST", "php/editprofile.php", true);
			hr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			hr.send("fullname=" + editname.value + "&oldpassword=" + editoldpass.value + "&nepassword=" + editnepass.value + "&dob=" + editdob.value);
		}
			
	}
	
  </script>
  </body>
  
</html>