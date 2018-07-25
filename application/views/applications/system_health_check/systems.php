<?php 
	if(isset($systems)){
		foreach($systems as $system){ ?>
		<div class="col-2 p-0">
			<div class="card text-white bg-<?= $system['color']; ?> mb-3">
			  <div class="card-header"><?= $system['name']; ?></div>
			  <div class="card-body text-right">
			    <h5 class="card-title"><?= $system['ip']; ?></h5>
			  </div>
			</div>
		</div>
<?php } } ?>
