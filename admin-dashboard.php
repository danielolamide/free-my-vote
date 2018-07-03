<?php
	session_start();
	$con = new mysqli('localhost','root','','election');
	if ((!isset($_SESSION['userName']))||($_SESSION['uType']==="user")) {
		header("location: voting-dashboard.php");
		}
	else{
		$result = mysqli_query($con,"SELECT * FROM voterRegistrationDetails");
		$num_users = mysqli_num_rows($result);
		$ballot_result= mysqli_query($con, "SELECT * FROM ballot");
		$num_ballot = mysqli_num_rows($ballot_result);
		$num_votes_president =mysqli_query($con,"SELECT SUM(votes) as pSum FROM p_candidates");
		$p_rows = mysqli_fetch_assoc($num_votes_president);
		$p_sum= $p_rows['pSum'];
		$num_votes_vpresident =mysqli_query($con,"SELECT SUM(votes) AS vpSum FROM vp_candidates");
		$vp_rows = mysqli_fetch_assoc($num_votes_vpresident);
		$vp_sum =  $vp_rows['vpSum'];
		$num_votes_pm =mysqli_query($con,"SELECT SUM(votes) AS pmSum FROM pm_candidates");
		$pm_rows = mysqli_fetch_assoc($num_votes_pm);
		$pm_sum = $pm_rows['pmSum'];
		$sum = $pm_sum + $p_sum + $vp_sum;

		}
		


	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="./css/admin-dashboard.css">
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
			<a href="./admin-dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
			<a href="./createBallot.php"><i class="fas fa-archive"></i> Create a ballot</a>
			<a href="./admin-settings.php"><i class="fas fa-wrench"></i> Settings</a>
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
					<a href="./index.php">Free My Vote</a>
				</div>
				<div id="user-icon">
					<div class="drop-down">
						<button onclick="dropFunction()" class="dropbtn"><i class="fas fa-user-circle"></i><?php echo " ". $_SESSION['userName']." ";  ?><i class="fas fa-sort-down"></i></button>
						<div id="myDropButton" class="drop-content">
							<a href="./admin-settings.php"><i class="fas fa-wrench"></i> Settings</a>
							<a href="./logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="banner-bar"></div>
	</div>
	<div id="admin-page-content">
		<div style="background-color: #EDEDED;display: inline-block; margin-top: 20px; margin-left:5px; border-radius: 10px; width: 90%;">
			<div style="float: left; padding: 5px 30px; width: 25%; border-right: 1px solid grey;">
				<small style="font-family: 'Montserrat',sans-serif; font-size: 12px; font-weight: bold;">Total Number of Registered Voters</small>
				<br>
				<span style="font-family: 'Montserrat',sans-serif; font-size: 30px;"><?php echo" $num_users";?></span>
			</div>
			<div style="float: left; padding: 5px 30px; width: 25%;border-right: 1px solid grey;">
				<small style="font-family: 'Montserrat',sans-serif; font-size: 12px; font-weight: bold;">Total Number of Active Elections</small>
				<br>
				<span style="font-family: 'Montserrat',sans-serif; font-size: 30px;"><?php echo" $num_ballot";?></span>
			</div>
			<div style="float: left; padding-top : 5px; padding-bottom: 5px; padding-left: 5px;width: 30%;">
				<small style="font-family: 'Montserrat',sans-serif; font-size: 12px; font-weight: bold;">Total Number of Votes Cast</small>
				<br>
				<span style="font-family: 'Montserrat',sans-serif; font-size: 30px;"><?php echo "$sum"; ?></span>
			</div>
		</div>
		<div id="admin-card">
			<div id="admin-card-details">
				<div id="admin-header-img">
					<img src="./images/user.png">
				</div>
				<div id="admin-header-txt">
					<span>Administrator Details</span>
				</div>
				<div id="admin-icon">
					<img src="./images/id-image.png">
				</div>
				<div id="admin-details">
					<ul>
						<li>Name:<b><?php echo " ". $_SESSION['userName'];?></b></li>
						<li>ID Number:<b><?php echo " ".$_SESSION['idNo']; ?></b></li>
						<li>Date of Birth:<b><?php echo " ". $_SESSION['dob'];  ?></b></li>
						<li>Gender:<b><?php echo " ". $_SESSION['gender']; ?></b></li>
					</ul>
				</div>
				<div style="margin-left: 300px; margin-top: 60px;"><button onclick="location.href='./admin-settings.php'" id="edit-settings-btn"><i class="fas fa-wrench"></i> Edit Details</button></div>
			</div>
		</div>
		<div id="createBallot">
			<div id="ballot-details">
				<span>Create a ballot</span>
			</div>	
			<div id="ballotBtn"><a href="./createBallot.php">Create Ballot</a></div>
		</div>
		<div id="admin-faq-card">
			<div id="admin-faq-detail"><a href= "#">FAQ</a></div>
			<div style="margin-left: 230px; margin-top: 20px;"><span style="font-family: 'Montserrat',sans-serif; font-size: 14px; font-weight: bold; color: white; background-color: #7CFC00; border-radius: 5px; padding: 2px 4px;">Coming Soon</span></div>
		</div> 
		<div id="admin-settings-card">
			<div id="admin-setting-detail">
				<a href="./admin-settings.php">Settings</a>
			</div>
		</div>
	</div>
</body>
</html>