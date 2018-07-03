<?php
	session_start();
	if (isset($_POST['submit'])){
		$con = new mysqli('localhost','root','','election');

		$id = $con->real_escape_string($_POST['idNumber']);
		$email =$con->real_escape_string($_POST	['email']);
		$f_Name =$con->real_escape_string($_POST['fName']);
		$l_Name =$con->real_escape_string($_POST['lName']);
		$uPassword = $con->real_escape_string($_POST['password']);
		$sql = $con->query("SELECT * FROM voterRegistrationDetails WHERE id_number='$id'");
		if ($sql->num_rows>0) {
				$data= $sql->fetch_array();
				if((password_verify($uPassword, $data['password']))&&($email==$data['email_address'])){
					if($data['user_type']=="user"){
						$_SESSION['userName']= $data['user_name'];
					$_SESSION['email']= $data['email_address'];
					$_SESSION['idNo']= $data['id_number'];
					$_SESSION['dob']= $data['date_of_birth'];
					$_SESSION['gender'] = $data['user_gender'];
					$_SESSION['uType'] = $data['user_type'];
					$_SESSION['uVoted'] = $data['voted'];
					header("location: voting-dashboard.php");
					}
					else{
						$_SESSION['userName']= $data['user_name'];
					$_SESSION['email']= $data['email_address'];
					$_SESSION['idNo']= $data['id_number'];
					$_SESSION['dob']= $data['date_of_birth'];
					$_SESSION['gender'] = $data['user_gender'];
					$_SESSION['uType'] = $data['user_type'];
					$_SESSION['uVoted'] = $data['voted'];
					header("location: admin-dashboard.php");
					}
				}
				else{
					$incorrectDetails = "Incorrect Login Details";
					echo "No login";
				}
				
		}
		else{
			$userNotExisting=  "User doesn't exist";
			echo $userNotExisting;
		}	
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Free My Vote</title>
	<link rel="icon" type="image/png" href="./images/favicon.png">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Inconsolata:400,700" rel="stylesheet">
</head>
<body>
	<section id="navigation">
		<div id="topnav">
			<div id="logo">
				<img src="./images/logo.png">
				<span>Free My Vote</span>	
			</div>
			<div id="sign-up-div">
				<button id="sign-up-btn" onclick="location.href='./voter-registration/register.php';"><i class="fas fa-plus"> Sign Up</i></button>
			</div>
		</div>
		<div id="main">
			<div id="login-div">
				<form method="post" id="loginForm">
					<div id="form-Header">
						<img src="./images/user.png">
						<br>
						<span>Voter Sign-In</span>
					</div>
					<hr>
					<div style="padding-top: 10px; padding-left: 40px">
						<input  type="text" id="idNumber" class="inputField" required="required" name ="idNumber" placeholder="ID Number">
					</div>
					<div id = "iconID">
						<img src="./images/idNumber.png">
					</div>
					<div class="bar"></div>
					<div style="padding-top: 10px; padding-left: 40px">
						<input  type="text" id="fName" name="fName" class="inputField" required="required" placeholder="First Name">
					</div>
					<div id = "iconName">
						<img src="./images/accountName.png">
					</div>
					<div class="bar"></div>
					<div style="padding-top: 10px; padding-left: 40px">
						<input  type="text" id="lName" name="lName" class="inputField" required="required" placeholder="Last Name">
					</div>
					<div id = "iconName1">
						<img src="./images/accountName.png">
					</div>
					<div class="bar"></div>
					<div style="padding-top: 10px; padding-left: 40px">
						<input  type="text" id="email" name="email" class="inputField" required="required" placeholder="Email">
					</div>
					<div id = "emailIcon">
						<img src="./images/emailIcon.png">
					</div>
					<div class="bar"></div>
					<div style="padding-top: 10px; padding-left: 40px">
						<input type="password" id="uPass" class="inputField" name="password" required placeholder="Password">
					</div>
					<div id = "iconPassword">
							<img src="./images/password.png">
					</div>
				<div class="bar"></div>
				<div style="padding-top:30px; padding-left:20px;">
					<button id="btn-login" name="submit" formmethod="post" form="loginForm"><i class="fas fa-sign-in-alt"></i> Login</button>
				</div>
				</form>
			</div>
			<div id="about-div">
				<div>
					<span>Secure, Blockchain-based voting</span>
					<br>
					<p>Create an election for your school, organization<br>or country in seconds.Your voters can 	vote from<br>any location on any device.
					</p>
				</div>
			</div>
		</div>
	</section>
</body>
</html>