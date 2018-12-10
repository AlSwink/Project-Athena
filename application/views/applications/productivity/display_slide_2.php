<div class="row">
	<div class="col">
		<table class="table table-bordered totals shadow">
	        <tr>
	            <th></th>
	            <th>Picks</th>
	            <th>Units</th>
	        </tr>
	        <tr class="table-success">
	            <th>Completed</th>
	            <th><?= $data['cmp_picks']; ?></th>
	            <th><?= $data['cmp_units']; ?></th>
	        </tr>
	        <tr class="table-warning">
	            <th>Remaining</th>
	            <th><?= $data['available_picks']; ?></th>
	            <th><?= $data['available_units']; ?></th>
	        </tr>
	    </table>
	</div>
</div>