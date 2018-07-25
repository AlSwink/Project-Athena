<?php 
	if(isset($servers)){
		foreach($servers as $server){ ?>
		<div class="col-3 p-1">
			<div class="card text-white bg-<?= $server['color']; ?> mb-3">
			  <div class="card-header"><?= $server['name']; ?></div>
			  <div class="card-body text-right">
			    <h5 class="card-title"><?= $server['ip']; ?></h5>
			  </div>
			</div>
		</div>
<?php } } ?>
