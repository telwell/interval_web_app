<?php

	require 'vendor/autoload.php';

	use GuzzleHttp\Client;

	$client = new Client([
			// make sure we don't hit the API too many times.
	    'timeout'  => 2.0
	]);

	// I'm hitting the Wunderground API to get the current whether information for 
	// my ZIP code in Harlem! I need to specify the units as imperial b/c #America.
	$response = $client->get('http://api.openweathermap.org/data/2.5/weather?zip=10030,US&units=imperial&mode=json');

	// This is the returned body from the Wunderground API
	$weather_info = json_decode($response->getBody(), true);
	// Set our current temp, this is what we'll be saving into the DB
	$current_temp = $weather_info['main']['temp'];

	require('inc/insert_temp_db.php');

?>