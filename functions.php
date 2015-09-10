<?php 
	// Let's add some helpful functions to refactor our code and 
	// take some of the logic out of the views.
	
	// For when we want to connect to our DB. We'll grab the DB 
	// login information from our server environment and then return 
	// the PDO object after we create.
	function generate_pdo(){
		// If we're on local then allow us to connect to our local MySQL db
		// otherwise create connection on heroku's pgsql db.
		return ($_SERVER['REMOTE_ADDR'] == '::1') ? generate_pdo_local() : generate_pdo_prod();		
	}

	function generate_pdo_local(){
		$dbopts = include('config.php');
		$pdo_dsn = 'mysql:dbname='.$dbopts['dbname'].';host='.$dbopts['host'];
    $pdo_username = $dbopts['user'];
    $pdo_password = $dbopts['pass'];
		return new PDO($pdo_dsn, $pdo_username, $pdo_password);
	}

	function generate_pdo_prod(){
		$dbopts = parse_url(getenv('DATABASE_URL'));
    $pdo_dsn = 'pgsql:dbname='.ltrim($dbopts["path"],'/').';port='.$dbopts["port"].';host='.$dbopts["host"];
    $pdo_username = $dbopts["user"];
    $pdo_password = $dbopts["pass"];
		return new PDO($pdo_dsn, $pdo_username, $pdo_password);
	}

	function query_pdo($pdo, $query){
		$exec = $pdo->prepare($query);
	  return $exec;
	}

	function close_pdo($pdo){
		$pdo = null;
	}

	function fetch_query_rows($query){
		$results = array();
	  while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	    $results[] = $row;
	  }
	  return $results;
	}

?>