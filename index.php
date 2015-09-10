<?php require('header.php'); ?>

	<body>

		<main class="container">
			<h2>Temperature (&deg;F) Every Hour in Zip Code 10030</h2>
			<p>This chart updates automatically every hour and displays the temperature<br>
					in Fahrenheit in Harlem, NY zip code 10030. See below for the data in table form.</p>
			<div class="col-sm-12">
				<div>
					<canvas id="canvas"></canvas>
				</div>
			</div>
			
			<!-- We'll want to connect to our DB and set 
						our temp arrays to use in our views -->
			<?php require('inc/set_temp_arrays.php'); ?>

			<!-- Render the JS line chart -->
			<?php require('inc/temp_chart.php'); ?>

			<section id="table" class="col-sm-6 col-sm-offset-3">
				<h2>Table Statistics</h2>
				<p>Per the spec let's display the information we've saved in<br>
						a handy table!</p>
				<!-- Render the table containing the various times and temps
							which we've saved. -->
				<?php require('inc/temp_table.php'); ?>

			</section>

		</main>

	</body>

<?php require('footer.php'); ?>