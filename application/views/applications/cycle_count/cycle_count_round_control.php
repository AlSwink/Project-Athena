<div class="row">
	<div class="col-5">
		<div class="card w-100">
			<div class="card-body">
				<h5 class="card-title">Progress Check</h5>
				<h6 class="card-subtitle mb-2 text-muted">Click check progress to update progress</h6>
				<div class="card-text">
					Round 1 : <span class="r1_counted"><?= $totals['r1_today']['counted']; ?></span> / <span class="r1_assigned"><?= $totals['r1_today']['assigned']; ?></span>
					<div class="progress">
					  <div class="progress-bar r1_progress" role="progressbar" style="width: <?= $totals['r1_today']['progress']; ?>;"><?= $totals['r1_today']['progress']; ?></div>
					</div>
					<hr>
					Round 2 : <span class="r2_counted"><?= $totals['r2_today']['counted']; ?></span> / <span class="r2_assigned"><?= $totals['r2_today']['assigned']; ?></span>
					<div class="progress">
					  <div class="progress-bar r2_progress" role="progressbar" style="width: <?= $totals['r2_today']['progress']; ?>;"><?= $totals['r2_today']['progress']; ?></div>
					</div>
				</div>
				<br>
				<button type="button" class="check_progress btn btn-sm btn-info">Check Progress <i class="fas fa-sync-alt"></i></button>
				<button type="button" class="btn btn-sm btn-secondary" disabled>Force Close Cycle Count<i class="fas fa-power-off"></i></button>
			</div>
		</div>
	</div>
</div>