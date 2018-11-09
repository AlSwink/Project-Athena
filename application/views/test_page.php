<div class="container-fluid">
	<div class="row">
		<div class="col">
			<h4 class="display-4"><?= $wave; ?></h4>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<table class="table table-sm table-hover table-bordered">
				<thead>
					<tr class="thead-dark">
						<th>SKU</th>
						<th>PKG</th>
						<th>Commodity</th>
						<th>Needed</th>
						<th colspan="12"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($prod_locs as $pl){ ?>
						<tr class="bg-dark text-light">
							<th><?= $pl['sku']; ?> </th>
							<th><?= $pl['pkg']; ?></th>
							<th><?= $pl['commodity']; ?></th>
							<th><?= $pl['need']; ?></th>
							<th colspan="12"></th>
						</tr>
						<tr class="table-info">
							<th colspan="16">Replenish Location Info</th>
						</tr>
						<tr>
							<?php
								$keys = array_keys($pl['loc_info']);
								foreach($keys as $key){ ?>
									<td><?= $key; ?></td>
							<?php } ?>
						</tr>
						<tr>
							<?php 
								foreach($pl['loc_info'] as $loc){ ?>
								<td><?= $loc; ?></td>
							<?php } ?>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<!--div class="col">
			<table class="table table-hover table-sm table-bordered">
				<thead>
					<tr class="thead-dark">
						<th>Loc (<?= count($cresting_locs); ?>)</th>
						<th>Loc Type</th>
						<th>Zone</th>
						<th>Empty</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($cresting_locs as $loc){ ?>
						<tr>
							<td><?= trim($loc['loc']); ?></td>
							<td><?= trim($loc['loc_type']); ?></td>
							<td><?= trim($loc['zone']); ?></td>
							<td><?= trim($loc['empty']); ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div-->
	</div>
</div>