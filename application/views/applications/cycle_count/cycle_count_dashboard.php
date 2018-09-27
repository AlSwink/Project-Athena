<div class="container-fluid mt-3">
	<div class="row">
		<div class="col-3">
			<div class="row">
				<div class="col">
					<h4 class="display-4 mb-0 master_counted" style="line-height: 53px"><?= $totals['master']['counted']; ?></h4> 
					<span class="sub-header float-right">counted</span>
					<div class="progress progress-bar-vertical" style="width: 100%;height: 65%">
						<div class="progress-bar progress-bar-striped bg-success master_progress"  style="height: <?= $totals['master']['progress'];?>%"><h4><?= $totals['master']['progress'];?></h4></div>
					</div>
					Round 1
				</div>
				<div class="col">
					<h4 class="display-4 mb-0" style="line-height: 53px">0</h4> 
					<span class="sub-header float-right">counted</span>
					<div class="progress progress-bar-vertical" style="width: 100%;height: 65%">
						<div class="progress-bar progress-bar-striped bg-success"  style="height: 0%"></div>
					</div>
					Round 2
				</div>
			</div>
		</div>
		<div class="col-9">
			<div class="row ml-2 border-bottom pb-3">
				<div class="col">
					<h4 class="display-4 mb-0"><?= date('F d, Y'); ?></h4>
					<span class="sub-header"><?php echo getShift('display'); ?> Shift</span>
				</div>
			</div>
			<div class="row text-center border-bottom py-3">
				<div class="col border-right">
					<h4 class="display-4 mb-0 master_all"><?= $totals['master']['all']; ?></h4>
					<span class="sub-header">Total Locations</span>
				</div>
				<div class="col">
					<h4 class="display-4 mb-0 master_pending"><?= $totals['master']['pending']; ?></h4>
					<span class="sub-header">Pending Locations</span>
				</div>
			</div>
			<div class="row mt-3 ml-2 text-center border-bottom pb-3">
				<div class="col">
					<h4 class="display-4 mb-0 border-right total_created"><?= $totals['today']['created']; ?></h4>
					<span class="sub-header">Assigned Today</span>
				</div>
				<div class="col">
					<h4 class="display-4 mb-0 border-right total_counted"><?= $totals['today']['counted']; ?></h4>
					<span class="sub-header">Completed Today</span>
				</div>
				<div class="col">
					<h4 class="display-4 mb-0 border-right">0</h4>
					<span class="sub-header">Remainder from Yesterday</span>
				</div>
				<div class="col">
					<h4 class="display-4 mb-0 total_remainder"><?= $totals['today']['remainder']; ?></h4>
					<span class="sub-header">Remainder Today</span>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col">
					<div class="row">
						<div class="col-2 mt-5">
							<span class="sub-header">Net Adjustment</span>
							<hr>
							<h4 class="display-4 mb-0 text-right total_net_adj"><?= $totals['today']['units']['net_adj']; ?></h4>
						</div>
						<div class="col-4 text-center">
							<canvas id="netpercentage" height="175px"></canvas>
						</div>
						<div class="col-2 mt-5">
							<span class="sub-header">Absolute Adjustment</span>
							<hr>
							<h4 class="display-4 mb-0 text-right total_abs_adj"><?= $totals['today']['units']['abs_adj']; ?></h4>
						</div>
						<div class="col-4 text-center">
							<canvas id="abspercentage" height="175px"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>