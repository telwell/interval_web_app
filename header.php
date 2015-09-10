<?php 
	// Otherwise php throws us a nasty error.
	date_default_timezone_set('America/New_York');

	// Requiring our composer includes and our functions file.
	require 'vendor/autoload.php';
	require 'functions.php'; 
?>

<html>
	<head>
	
		<title>Interval Code Challenge</title>
		
		<!-- Including Bootstrap via CDN -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<!-- Include Chart.js for our charting -->
		<script src="js/Chart.min.js"></script>
		<!-- Include jQuery for Bootstrap -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	</head>


