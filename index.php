<?php require('header.php'); ?>

<body>

	<main class="container">
		<h2>Temperature (&deg;F) Every 6 Hours in Zip Code 10030</h2>
		<p>This chart updates automatically every 6 hours and displays the temperature<br>
				in Fahrenheit in Harlem, NY zip code 10030.</p>
		<div class="col-sm-12">
			<div>
				<canvas id="canvas"></canvas>
			</div>
		</div>

		<?php
			// Initiate and generate our PDO from our helper methods.
			
			try {
			    $pdo = generate_pdo();
			    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
			    echo 'Connection failed: ' . $e->getMessage();
			}

			// Prepares and executes the passed query on the PDO.
		  $query = query_pdo($pdo, 'SELECT * FROM temps');

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
		  	$temp_dates[] = '"' . date('F j, Y, g:i a', $temp['created_at']) . '"';
		  	$filtered_temps[] = $temp['temp'];
		  }

		  // Close our PDO connection now that we're done using our DB.	
		  close_pdo($pdo);
		?>

		<?php include('inc/temp_chart.php'); ?>

		<!-- Per the spec, I'm going to add the table of of the temperatures
					below the graph. -->
		<section id="table">
			
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Temp.(&deg;F)</th>
						<th>Date/Time</th>
					</tr>

					<tbody>
						<?php foreach($temps as $temp): ?>
							<tr>
								<td><?php echo $temp['temp'] . "&deg;"; ?></td>
								<td><?php echo date('F j, Y, g:i a', $temp['created_at']); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</thead>
			</table>

		</section>

	</main>

</body>

<?php require('footer.php'); ?>