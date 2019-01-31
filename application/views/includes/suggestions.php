<?php foreach($suggestions as $suggestion){ ?>
	<div class="card shadow">
		<div class="card-body">
			<h5 class="card-title"><?= $suggestion['type']; ?></h5>
			<h6 class="card-subtitle">Dock #<?= $suggestion['dock']; ?></h6>
			<p class="card-text"><?= $suggestion['msg']; ?></p>
		</div>
	</div>
<?php } ?>