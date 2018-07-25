<ul class="list-group">
	<?php for($x=0;$x<count($notes);$x++){ ?>
  		<li class="list-group-item list-group-item-<?= $notes[$x]->color; ?>"><?= $notes[$x]->announcement; ?></li>
  	<?php } ?>
</ul>