<?php
	session_start();
	if(!isset($_SESSION['userName'])){
		header("location: ./index.php");
		exit();
	}
	else{
		$con = new mysqli('localhost','root','','election');
		if(isset($_POST['submit'])){
			$id = $con->real_escape_string($_SESSION['idNo']);
			$newPassConfirm =$con->real_escape_string($_POST['uPassConfirm']);
			$newPass = $con->real_escape_string($_POST['uPass']);
			$newEmail = $con->real_escape_string($_POST['vote-Email']);

			if($newPass!=$newPassConfirm){
				$msg ="Passwords don't match";
			}	
			else{
				$newHash = password_hash($newPass,PASSWORD_BCRYPT);
				$sql = "UPDATE voterRegistrationDetails SET password= '$newHash', email_address='$newEmail' WHERE id_number ='$id'";
				$query= $con->query($sql);
				echo "<script language ='javascript'>
						alert('Password and Email Changed Successfully');
						</script>";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Account Settings</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link rel="icon" type="image/png" href="./images/favicon.png">
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
 	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
	<script src="./scripts/script.js"></script>
	<script src="./scripts/jquery.js"></script>
</head>
<body>
	<div id = "side-menu" class="side-nav">
		<div id="closebtn-div"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></div>
		<div id="sm-wrapper">
			<a href="./voting-dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
			<a href="./vote.html"><i class="fas fa-archive"></i> Cast a vote</a>
			<a href="./settings.php"><i class="fas fa-wrench"></i> Settings</a>
		</div>
	</div>
	<div id="wrapper">
		<div id="top-panel-dashboard">
		<div id="top-banner">
			<div id="banner-content">
				<button id="side-menu-btn" style="background-color: #2A3542; color: white; border-style: hidden;" onclick="openNav()"><i class="fas fa-bars"></i></button>
				<div id="logo-image">
					<img src="./images/logo.png">
				</div>
				<div id="logo-text">
					<a href="./voting-dashboard.php">Free My Vote</a>
				</div>
				<div id="user-icon">
					<div class="drop-down">
						<button onclick="dropFunction()" class="dropbtn"><i class="fas fa-user-circle"></i> <?php echo " ". $_SESSION['userName']." ";  ?><i class="fas fa-sort-down"></i></button>
						<div id="myDropButton" class="drop-content">
							<a href="./settings.php"><i class="fas fa-wrench"></i> Settings</a>
							<a href="./logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="banner-bar" style="background-color: black;"></div>
	</div>
	<div id="settings-pg">
		<div id="user-image-content">
			<div id = image-frame>
				<img src="./images/id-image.png">
			</div>
			<div style="margin-top:	30px; margin-left:120px;">
					<span style="font-family: 'Montserrat',sans-serif; text-align: center; font-weight: bold; font-size: 20px; color: #2A3542; background-color: white;"><?php echo $_SESSION['userName'];?></span><br>
			</div>
		</div>
		<div id="settings-content">
			<form id="edit-user-details" method="post" action="./settings.php">
				<h1 class="setting-header">Personal Details</h1>
				<h2 class="setting-labels">Name:</h2><input type="text" name="name"  id ="setName" value="<?php echo $_SESSION['userName'] ?>" readonly><br>
				<h2 class="setting-labels">Date of Birth:</h2>
				<input type="date" id="userDOB" value="<?php echo $_SESSION['dob'] ?>" readonly><br>
				<h2 class="setting-labels">Voter ID:</h2>
				<input type="text" name="vote-id" id="setID" value="<?php echo $_SESSION['idNo'] ?>" readonly><br>
				<h2 class="setting-labels">Email <i class="fas fa-edit"></i>:</h2>
				<input type="email" name="vote-Email" id="setEmail" value="<?php echo $_SESSION['email'] ?>"><br>
				<h2 class="setting-labels">Password <i class="fas fa-edit"></i>:</h2>
				<input type="password" id="setPass" name="uPass" value="12345678"><br>
				<h2 class="setting-labels">Re-type Password <i class="fas fa-edit"></i>:</h2>
				<input type="password" id="setRe-Type" name="uPassConfirm" value="12345678">
				<input type="submit" id="save-settings" name="submit" value="Save Changes">
			</form>
		</div>
	</div>
</body>
</html>