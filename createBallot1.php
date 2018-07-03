<?php
	session_start();
	$con = new mysqli('localhost','root','','election');
	if ((!isset($_SESSION['userName']))||($_SESSION['uType']==="user")) {
		header("location: voting-dashboard.php");
		}
	else{
		if(isset($_POST['submit'])){
			$candi1 = $con->real_escape_string($_POST['cand1']);
			$candi2 = $con->real_escape_string($_POST['cand2']);
			$candi3 = $con->real_escape_string($_POST['cand3']);
			$votes =0;
			$insert2 = $con->query("INSERT INTO vp_candidates(name,votes) VALUES('$candi1','$votes')");
			$insert3 = $con->query("INSERT INTO vp_candidates(name,votes) VALUES('$candi2','$votes')");
			$insert4 = $con->query("INSERT INTO vp_candidates(name,votes) VALUES('$candi3','$votes')");

			header("location: createBallot2.php");

		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Create A Ballot</title>
	<link rel="icon" type="image/png" href="./images/favicon.png">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link rel="stylesheet" type="text/css" href="./css/ballot.css"> 
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
	<script src="./scripts/script.js"></script>
</head>
<body>
	<div id = "side-menu" class="side-nav">
		<div id="closebtn-div"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></div>
		<div id="sm-wrapper">
			<a href="./admin-dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
			<a href="./createBallot.php"><i class="fas fa-archive"></i> Create a ballot</a>
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
					<a href="./admin-dashboard.php">Free My Vote</a>
				</div>
				<div id="user-icon">
					<div class="drop-down">
						<button onclick="dropFunction()" class="dropbtn"><i class="fas fa-user-circle"></i><?php echo " ". $_SESSION['userName']." ";  ?><i class="fas fa-sort-down"></i></button>
						<div id="myDropButton" class="drop-content">
							<a href="./settings.php"><i class="fas fa-wrench"></i> Settings</a>
							<a href="./logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="banner-bar"></div>
	</div>
	<div id="ballot-div">
		<form id="create-ballot-form" method="post" action="createBallot1.php">
			<h1>Create a ballot -Set Vice Presidents</h1>
			<div id="ballot-form-content">
				Candidate 1:
				<p>
				<input class= "ballotDetail" type="text" name="cand1" required>
				</p>
				Candidate 2:
				<p>
				<input class= "ballotDetail" type="text" name="cand2" required>
				</p>
				Candidate 3:
				<p>
				<input class= "ballotDetail" type="text" name="cand3" required>
				</p>
				<p>
					<input type="submit" name="submit" value="Continue">
				</p>
			</div>
		</form>
	</div>
</body>
</html>