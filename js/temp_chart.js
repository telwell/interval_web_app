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