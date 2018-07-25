<div class="card-group">
	<?php 
		if(isset($cards)){
			foreach($cards as $card){ ?>
			<div class="card text-white bg-<?= $card['color']; ?>">
			  <div class="card-body">
			    <h5 class="card-title"><?= $card['title']; ?></h5>
			    <div class="text-right">
			    	<h6 class="card-subtitle"><?= $card['field_to_show']; ?></h6>
			    	<small class="card-text"><?= $card['subtext']; ?></small>
				</div>
			  </div>
			</div>
	<?php } } ?>
</div>
