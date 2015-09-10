<?php
	
	// Initiate and generate our PDO from our helper methods.
	$pdo = generate_pdo();

	// Prepares and executes the passed query on the PDO. Still 
  // needs to be executed.
  $query = query_pdo($pdo, 'SELECT * FROM temps');
  $query->execute();

  // Collect our query rows and add them to an array.
  $temps = fetch_query_rows($query);


  // Set these as empty arrays for the time being
  // so that they are available outside of the scope of 
  // the foreach loop below.
  $temp_dates = array();
  $filtered_temps = array();

  // Now we need to actually fill our temp_dates and filtered_temps
  // arrays with data! temp_dates fills with the dates and times of the
  // API calls and filtered_temps fills with the actual temperatures.
  // TODO: Should look into changing these variable names.
  foreach($temps as $temp){
  	$temp_dates[] = '"' . date('F j, Y, g a', $temp['created_at']) . '"';
  	$filtered_temps[] = $temp['temp'];
  }

  // Close our PDO connection now that we're done using our DB.	
  close_pdo($pdo);
  
?>