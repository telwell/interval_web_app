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
					<td><?php echo date('F j, Y, g a', $temp['created_at']); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</thead>
</table>