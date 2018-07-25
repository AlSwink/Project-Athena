<div class="row">
	<div class="col">
		<h4><?= $tool_info->title; ?> <small><?= $tool_info->version; ?></small></h4>
	</div>
	<div class="col text-right">
		<a href="tools/<?= $tool_info->method_name ?>" class="refresh_me text-secondary"><i class="fas fa-sync fa-xs"></i></a>
		<a href="#" class="remove_me text-secondary"><i class="fas fa-times"></i></a>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="alert alert-warning" role="alert">
		  <?= $tool_info->description; ?>
		</div>
	</div>
</div>