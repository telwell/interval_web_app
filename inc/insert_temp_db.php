<?php 
	
	// Initiate and generate our PDO from our helper methods.
	$pdo = generate_pdo();

	// Prepares and executes the passed query on the PDO.
  $query = query_pdo($pdo, 'INSERT INTO interval(temp, created_at)
	    											VALUES(:temp, :created_at)');
		
	$query->execute(array(
	  "temp" => $current_temp,
	  "created_at" => time()
	));

	// Close our PDO connection now that we're done using our DB.	
  close_pdo($pdo);

?>