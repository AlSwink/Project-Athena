<div class="container-fluid">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<hr>
	<div class="row">
		<div class="col-6 mt-3">
			<?= loadSubTemplate('acv_employee_info'); ?>
		</div>
		<div class="col-6">
			<?= loadSubTemplate('acv_status'); ?>
		</div>
	</div>
</div>

<?php loadSubTemplate(['css','js']); ?>