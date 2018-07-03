<?php 
	session_start();
	session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Logout</title>
	<link rel="icon" type="image/png" href="./images/favicon.png">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
	<style type="text/css">
		a{
			border-radius: 20px;
			text-decoration: none;
			font-family:'Montserrat',sans-serif;
			font-size: 20px; 
			padding: 5px 10px;
			background-color: #2A3542;
			color: white;
			display: inline-block;
		}
		a:hover{
			cursor: pointer;
			box-shadow: 1px 3px #87CEEB;
		}
	</style>
</head>
<body>
	<center>
		<div style="border-style: solid; width: 50%; margin-top: 200px; border-radius: 10px; padding-bottom: 20px;">
			<h1>Thank you for carrying out your civic rights</h1>
			<a href="./index.php">Return to Login</a>
		</div>
	</center>>
</body>
</html>