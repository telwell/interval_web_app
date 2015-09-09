<?php 
	// Let's add some helpful functions to refactor our code and 
	// take some of the logic out of the views.
	
	// For when we want to connect to our DB. We'll grab the DB 
	// login information from our server environment and then return 
	// the PDO object after we create.
	function generate_pdo(){
		$dbopts = parse_url(getenv('DATABASE_URL'));
    $pdo_dsn = 'pgsql:dbname='.ltrim($dbopts["path"],'/').';port='.$dbopts["port"].';host='.$dbopts["host"];
    $pdo_username = $dbopts["user"];
    $pdo_password = $dbopts["pass"];
		return new PDO($pdo_dsn, $pdo_username, $pdo_password);
	}

	function query_pdo($pdo, $query){
		$pdo->prepare($query);
	  $query->execute();
	  return $query;
	}

	function close_pdo($pdo){
		$pdo = null;
	}

	function fetch_query_rows($query){
		$results = array();
	  while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	    $results[] = $row;
	  }
	  return results;
	}


?>