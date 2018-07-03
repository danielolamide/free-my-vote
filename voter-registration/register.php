<?php
	$msg= "";

	$con = new mysqli('localhost','root','','election');

	// if ($con->connect_error){
	// 	die("Connection Failed". $con->connect_error);
	// }

	if(isset($_POST['submit'])){
		$first_name =$con->real_escape_string($_POST['fName']);
		$second_name =$con->real_escape_string($_POST['lName']);
		$userName = $first_name . " " . $second_name;
		$completeName = $con->real_escape_string($userName);
		$email = $con->real_escape_string($_POST['email']);
		$id = $con->real_escape_string($_POST['idNumber']);
		$password = $con->real_escape_string($_POST['uPass']);
		$cPassword = $con->real_escape_string($_POST['cUpass']);
		$date_of_birth =$con->real_escape_string($_POST['dob']);
		$gender = $con->real_escape_string($_POST['sex']);
		$userType = "user";
		$voteCheck = "n";

		if($password!= $cPassword){
			$msg="Passwords do not match";
		}
		else {
			$userExists= $con->query("SELECT * FROM voterRegistrationDetails WHERE id_number='$id'");

			if ($userExists->num_rows>0) {
				echo "<script language='javascript'>
					alert('User with this email exists');
				</script>";

			}
			else{
				$hash = password_hash($password,PASSWORD_BCRYPT);
			$query=$con->query("INSERT INTO voterRegistrationDetails(id_number,user_name,email_address,password,user_gender,date_of_birth,user_type,voted) VALUES ('$id','$completeName','$email','$hash','$gender','$date_of_birth','$userType','$voteCheck')");
			if($query){
				header("location: ../index.php");
				echo "<script>alert('Successful Registration');</script>";
			}
			
			}
			
		}

	} 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Voter Registration</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="./images/favicon.png">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet"> 
	<script src="../scripts/script.js"></script>
</head>
<body>
	<div id="main">
		<!-- <?php if($msg!="") echo $msg . "<br>";  ?> -->
		<form  name= "rgstForm" method="post" action="register.php">
			<div id= "formHeader">
				<img src="./images/user.png">
				<br>
				<span >Voter Registration</span>
			</div>
			<hr>
			<div style="padding-top: 15px; padding-left: 40px">
				<input  type="text" id="fName" name="fName" class="inputField" required="required" minlength="3" placeholder="First Name">
			</div>
			<div class = "iconName">
					<img src="./images/accountName.png">
			</div>
			<div class="bar"></div>
			<div style="padding-top: 15px; padding-left: 40px">
				<input type="text" id="lName" name="lName" class="inputField" required="required" minlength="3" placeholder="Last Name">
			</div>
			<div class = "iconName1">
					<img src="./images/accountName.png">
			</div>
			<div class="bar"></div>
			<div style="padding-top: 15px; padding-left: 40px">
				<input type="email" id="email" name="email" class="inputField" required="required" placeholder="Email">
			</div>
			<div class = "iconEmail">
					<img src="./images/emailIcon.png">
			</div>
			<div class="bar"></div>
			<div style="padding-top: 15px; padding-left: 40px">
				<input type="text" id="idNumber" name="idNumber"class="inputField" required="required" placeholder="ID Number">
			</div>
			<div id = "iconID">
					<img src="./images/idNumber.png">
			</div>
			<div class="bar"></div>
			<div style="padding-top: 15px; padding-left: 40px">
				<input type="password" id="uPass" name="uPass" class="inputField" required="required" placeholder="Password">
			</div>
			<div id = "iconPassword">
					<img src="./images/password.png">
			</div>
			<div class="bar"></div>
			<div style="padding-top: 15px; padding-left: 40px">
				<input type="password"  style="font-size: 18px;"id="uPassConfirm" class="inputField" name="cUpass"  required="required" placeholder="Re-type Password">
			</div>
			<div id = "iconPassword1">
					<img src="./images/password.png">
			</div>
			<div class="bar"></div>
			<div style="padding-top: 24px; padding-right:120px">
				<span style="font-family:'Montserrat',sans-serif;  font-size: 18px;">Select your date of birth</span>
			</div>
			<div id="calendarIcon">
				<img src="./images/calendar.png">
			</div>
			<div style="padding-top: 20px; margin-right: 180px;">
				<input type="date" name="dob" max="2000-01-01" required>
			</div>
			<div style="padding-top: 24px; padding-right:170px">
				<span style="font-family:'Montserrat',sans-serif;  font-size: 18px;">Select your gender</span>
			</div>
			<div id = "iconGender">
					<img src="./images/gender.png">
			</div>
			<div style="padding-top: 15px; padding-right: 100px; margin-bottom: 15px;">
					<label class="radio inline"><input type="radio" name="sex" value="male" id="male">
						<span>Male</span>
					</label>
					<label class="radio inline"><input type="radio" name="sex" value="female" id="female">
						<span>Female</span>
					</label>
					<label class="radio inline"><input type="radio" name="sex" value="other" id="other">
						<span>Other</span>
					</label>
			</div>
			<div style="padding-top: 15px;">
				<label style="font-family: 'Montserrat', sans-serif">
					<input type="checkbox" name="agreement" required>
					I agree to the terms and conditions
				</label>	
				
			</div>
			<div style="margin-bottom: 10px; padding-top: 10px; ">
				<input type ="submit" name="submit" value="Register" style="font-family: 'Montserrat',sans-serif; font-size: 18px; width: 200px; height:30px;">
				<a href="../index.php">Sign In</a>
			</div>

		</form>
	</div>
</body>
</html>