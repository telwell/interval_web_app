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

	// I built this app out locally first, which required connecting to my local
	// mysql db. So as to not release my secure info to the world I included the
	// db creds in a config file saved to my local machine. Some of this code is 
	// dup'ed in the prod function below and further refactoring would include 
	// taking away this duplication.
	function generate_pdo_local(){
		$dbopts = include('config.php');
		$pdo_dsn = 'mysql:dbname='.$dbopts['dbname'].';host='.$dbopts['host'];
    $pdo_username = $dbopts['user'];
    $pdo_password = $dbopts['pass'];
		return new PDO($pdo_dsn, $pdo_username, $pdo_password);
	}

	// Similar to the comment above, this sets up a PDO on our production environment.
	// On heroku, the DB info is obtained by parsing the DATABASE_URL env var. 
	function generate_pdo_prod(){
		$dbopts = parse_url(getenv('DATABASE_URL'));
    $pdo_dsn = 'pgsql:dbname='.ltrim($dbopts["path"],'/').';port='.$dbopts["port"].';host='.$dbopts["host"];
    $pdo_username = $dbopts["user"];
    $pdo_password = $dbopts["pass"];
		return new PDO($pdo_dsn, $pdo_username, $pdo_password);
	}

	// Query the PDO with the passed query string. This just prepares the PDO 
	// it still needs to execute() outside of this function.
	function query_pdo($pdo, $query){
		return $pdo->prepare($query);
	}

	// To secure our app we always want to make sure we close the PDO connection
	// when we're done querying the DB.
	function close_pdo($pdo){
		$pdo = null;
	}

	// Return the results array after querying the DB for a passed SQL query.
	function fetch_query_rows($query){
		$results = array();
	  while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	    $results[] = $row;
	  }
	  return $results;
	}

?>