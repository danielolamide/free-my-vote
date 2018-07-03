<?php
	session_start();  
	$con = new mysqli('localhost','root','','election');
	if(!isset($_SESSION['userName'])){
		header("location: ./index.php");
		exit();
	}
	else {
		$pendingSQL = $con->query("SELECT * FROM ballot");

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Voter Dashboard</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link rel="icon" type="image/png" href="./images/favicon.png">
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
	<script src="./scripts/script.js"></script>
</head>
<body>
	<div id = "side-menu" class="side-nav">
		<div id="closebtn-div"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></div>
		<div id="sm-wrapper">
			<a href="./voting-dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
			<a href="./vote.php"><i class="fas fa-archive"></i> Cast a vote</a>
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
	<div class="pg-content">
		<div id="dash-header">
			<div style="padding-left: 15px; padding-top: 18px;"><span>Dashboard</span></div>
		</div>
		<div id="pending-elections">
			<div id="pending-elections-content">
				<div id="election-icon">	
					<span><img src="./images/ballot.png"></span>
				</div>
				<div id="pending-elections-text"><span>Pending Elections</span></div>
				<div id="if-pending-elections-no"><span><?php if(($pendingSQL->num_rows>0)&&($_SESSION['uVoted']=='n')){
			$num_elections = mysqli_num_rows($pendingSQL);
				echo $num_elections;
			}
			else{
				$noElection  = 0;
				echo $noElection;
			}	

			?></span></div>
			</div>
		</div>
		<div id="voter-card">
			<div id="voter-card-details">
				<div id="card-header-img">
					<img src="./images/user.png">
				</div>
				<div id="card-header-txt">
					<span>Voter Details</span>
				</div>
				<div id="id-icon">
					<img src="./images/id-image.png">
				</div>
				<div id="user-details">
					<ul>
						<li>Name:<b><?php echo " ". $_SESSION['userName']; ?></b></li>
						<li>ID Number:<b><?php echo " ". $_SESSION['idNo'];  ?></b>	</li>
						<li>Date of Birth:<b><?php echo " ". $_SESSION['dob'];  ?></b></li>
						<li>Gender:<b><?php echo " ". $_SESSION['gender']; ?></b></li>
					</ul>
				</div>
				<div style="margin-left: 300px; margin-top: 60px;"><button onclick="location.href='./settings.php'" id="edit-settings-btn"><i class="fas fa-wrench"></i> Edit Details</button></div>
			</div>
		</div>
		<div id="cast-a-vote-card">
			<div id="cast-details">
				<span>Cast your vote today</span>
			</div>
			<div id="vote-now-btn"><a href="./vote.php">Vote Now</a></div>
		</div>
		<div id="faq-card">
			<div id="faq-detail"><a href= "#">FAQ</a></div>
			<div style="margin-left: 230px; margin-top: 20px;"><span style="font-family: 'Montserrat',sans-serif; font-size: 14px; font-weight: bold; color: white; background-color: #7CFC00; border-radius: 5px; padding: 2px 4px;">Coming Soon</span></div>
		</div> 
		<div id="settings-card">
			<div id="setting-detail">
				<a href="./settings.php">Settings</a>
			</div>
		</div>
	</div>
	</div>
	<!-- <div>Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div> -->
</body>
</html>