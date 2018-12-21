<div class="row">
	<div class="col-lg-2 col-xs-12">
		<div class="card shadow">
			<div class="card-body">
				<form id="shift_setting_form">
				<h5 class="card-title"><i class="fas fa-cog"></i> <?= $data['shift_title']; ?> Shift Settings</h5>
				<h6 class="card-subtitle mb-2 text-muted">Please set your shift setting for the day to reflect accurate calculations.</h6>
				<label><i class="fas fa-clock"></i> Scheduled Hours</label>
				<input type="number" class="form-control mb-2" name="sched_hours" value="<?= $data['sched_hrs']; ?>">
				<label><i class="fas fa-users"></i> No. of Operators</label>
				<input type="number" class="form-control" name="oprs" value="<?= $data['oprs']; ?>">
				<input type="hidden" name="shift_id" value="<?= (isset($data['shift_id']) ? $data['shift_id'] : null); ?>">
				<input type="hidden" id="shift_type" name="shift_type" value="<?= $type; ?>">
				<button type="button" class="btn btn-primary w-100 mt-2 save_shift">Save Settings <i class="fas fa-save"></i></button>
				<button type="button" class="btn btn-info w-100 mt-2 send_email">Send Email <i class="fas fa-envelope"></i></button>
				</form>
			</div>
		</div>
	</div>
	<div id="update_section" class="col-lg-10 col-xs-12 ">
		<?= loadSubTemplate(['productivity_admin_cards','productivity_hour_lines']); ?>
	</div>
</div>