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
			$pdo = generate_pdo();

			// Prepares and executes the passed query on the PDO.
		  $query = query_pdo($pdo, 'SELECT * FROM interval');

		  // Collect our query rows and add them to an array.
		  $temps = fetch_query_rows($query);

		  // Set these as empty arrays for the time being
		  // so that they are available outside of the scope of 
		  // the foreach loop below.
		  $temp_dates = array();
		  $filtered_temps = array();

		  foreach($temps as $temp){
		  	$temp_dates[] = '"' . date('F j, Y, g:i a', $temp['created_at']) . '"';
		  	$filtered_temps[] = $temp['temp'];
		  }

		  // Close our PDO connection now that we're done using our DB.	
		  close_pdo();
		?>

		<script>
		var lineChartData = {
			labels : [
				<?php echo implode(',',$temp_dates); ?>
			],
			datasets : [
				{
					label: "Temperature in Zip Code 10030",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [<?php echo implode(',',$filtered_temps); ?>]
				},
			]

		}

	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
	}
	</script>

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