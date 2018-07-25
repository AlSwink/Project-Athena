<?php 
	if(isset($machines)){
		foreach($machines as $machine){ ?>
		<div class="col-1 p-0">
			<div class="card">
				<div class="card text-white bg-<?= $machine['color']; ?>">
				  <div class="card-body">
				    <h5 class="card-title"><?= $machine['name']; ?></h5>
				    	<small class="card-text"><?= $machine['ip']; ?></small>
				  </div>
				</div>
			</div>
		</div>
<?php } } ?>
