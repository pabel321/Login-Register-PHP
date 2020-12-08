<?php
$filepath=realpath(dirname(__FILE__));
include_once $filepath. '/../lib/Session.php';
Session::init();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Register System PHP</title>
	<link rel="stylesheet" href="inc/bootstrap.min.css">
	<script src="inc/jquery.min.js"></script>
	<script src="inc/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">Login Register PHP</a>
			</div>
			<ul class="nav navbar-nav pull-right">
				<li><a href="profile.php">Profile</a></li>
				<li><a href="">Logout</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Register</a></li>
			</ul>
		</div>
	</nav>