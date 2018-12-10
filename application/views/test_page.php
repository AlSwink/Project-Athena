<div class="container-fluid">
	<div class="row">
		<div class="col">
			<h4 class="display-4"><i class="fas fa-box"></i> Pending Cartons</h4>
		</div>
	</div>
	<div class="row">
		<?php foreach($cartons as $carton){ ?>
		<div class="col-2 mb-2">
			<div class="card shadow">
				<div class="card-body">
					<h4><?= $carton['type']; ?></h4>
					<hr>
					<h3 class="display-3 text-right"><?= $carton['count']; ?></h3>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>