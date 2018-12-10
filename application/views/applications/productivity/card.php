<div class="card shadow" title="<?= $desc; ?>">
	<div class="card-body">
	    <h6><i class="fas fa-<?= $icon; ?>"></i> <?= $label; ?></h6>
	    <h5 class="text-right <?= $logic; ?>"><?= $value; ?> <?php if(isset($sub_label)){ ?><small class="text-muted"><em><?= $sub_label; ?></em></small><?php } ?></h5>
	</div>
</div>