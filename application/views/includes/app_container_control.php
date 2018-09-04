<div class="row">
	<div class="col">
		<h4 class="<?= ($this->session->userdata('test') ? 'text-danger' : NULL); ?>"><?= $title; ?> <small><span id="app_version"><?= $version; ?></span></small></h4>
	</div>
	<div class="col text-right">
		<a href="<?= $method_name ?>" class="refresh_me text-secondary"><i class="fas fa-sync fa-xs"></i></a>
		<a href="#" class="remove_me text-secondary"><i class="fas fa-times"></i></a>
	</div>
</div>