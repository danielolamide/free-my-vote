<?php
	session_start();
	$con = new mysqli('localhost','root','','election');
	if(!isset($_SESSION['userName'])){
		header("location: ./index.php");
		exit();
	}
	$y_vote = "y"; 
	if (!($_SESSION['uVoted']== $y_vote)) {
				$id = $_SESSION['idNo']; 
				$p_candidateQuery = "SELECT name FROM p_candidates";
				$result =  mysqli_query($con,$p_candidateQuery);
				$vp_candidateQuery = "SELECT name FROM vp_candidates";
				$vp_result = mysqli_query($con,$vp_candidateQuery);
				$pm_candidateQuery = "SELECT name FROM pm_candidates";
				$pm_result = mysqli_query($con,$pm_candidateQuery);
		if (isset($_POST['submit'])) {
				$president =$con->real_escape_string($_POST['p-vote']);
				$vpresident = $con->real_escape_string($_POST['vp-vote']);
				$pminister = $con->real_escape_string($_POST['pm-vote']);
				$pSQL = "UPDATE p_candidates SET votes = votes + 1 WHERE name ='$president'";
				$vpSQL = "UPDATE vp_candidates SET votes = votes + 1 WHERE name = '$vpresident'";
				$pmSQL = "UPDATE pm_candidates SET votes = votes + 1 WHERE name = '$pminister'";
				$ifvoted = "y";
				$voteSQL = "UPDATE voterRegistrationDetails SET voted = '$ifvoted' WHERE id_number = '$id'";
				$pQuery = $con->query($pSQL);
				$vpQuery = $con->query($vpSQL);
				$pmQuery = $con->query($pmSQL);
				$voteQuery = $con->query($voteSQL);
				// session_start();
				$_SESSION['uVoted'] = $ifvoted;
		}

	}
	else {
				echo "<script>
					alert('You have already voted');
					window.location.href = 'voting-results.php';
				</script>";
				// header("location: voting-results.php");

				
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cast your vote</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link rel="icon" type="image/png" href="./images/favicon.png">
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
 	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
 	<!-- <link rel="stylesheet" type="text/css" href="./css/hide.css"> -->
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
					<a href="voting-dashboard.php">Free My Vote</a>
				</div>
				<div id="user-icon">
					<div class="drop-down">
						<button onclick="dropFunction()" class="dropbtn"><i class="fas fa-user-circle"></i><?php echo " ". $_SESSION['userName']." ";  ?><i class="fas fa-sort-down"></i></button>
						<div id="myDropButton" class="drop-content">
							<a href="./settings.php"><i class="fas fa-wrench"></i> Settings</a>
							<a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="banner-bar" style="background-color: black;"></div>
	</div>
	<div id="vote-pg">
		<form id="vote-form" method="post" action="vote.php">
			<h1>Cast your vote</h1>
			<div id="form-content">
				President:
				<p>
					<select id="vote-choice1" name="p-vote" required>
						<option value="" disabled selected>Select your option</option>
						<?php while($row= mysqli_fetch_assoc($result)){
							?>
						<option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
					<?php } ?>
					</select>
				</p>
				Vice President:
				<p>
					<select id="vote-choice2" name="vp-vote" required>
						<option value=""disabled selected>Select your option</option>
						<?php while($vp_row= mysqli_fetch_assoc($vp_result)){
							?>
						<option value="<?php echo $vp_row['name'];?>"><?php echo $vp_row['name'];?></option>
					<?php } ?>
					</select>
				</p>
				Prime Minister:
				<p>
					<select id="vote-choice3" name="pm-vote" required>
						<option value=""disabled selected>Select your option</option>
					<?php while($pm_row= mysqli_fetch_assoc($pm_result)){
							?>
						<option value="<?php echo $pm_row['name'];?>"><?php echo $pm_row['name'];?></option>
					<?php } ?>	
						
					</select>
				</p>
				<br>
				<input type="submit" value="Submit" name="submit" id="cast-vote">
				<br>
				<!-- <span id="voteCast" class="hidden" style="font-family: 'Montserrat',sans-serif; font-size: 20px; text-align: center; color: white;">Vote Cast</span><br> -->
				<a id="result-link" class="hidden" href="./voting-results.php" style="text-decoration: none; color: gold; font-size: 20px;">See Results</a>
			</div>
		</form>
	</div>
	</div>
</body>
</html>