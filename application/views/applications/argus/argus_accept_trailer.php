<div class="container-fluid">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<div class="row">
		<div class="col">
			<h4 class="display-4"><i class="fas fa-truck"></i> Accept Outbound Trailer</h4>
		</div>
		<div class="col">
			<div class="row text-right">
				<div class="col">
					<img id="carrier_logo" src="<?= base_url('assets/img/carrier_logos/xpo.png'); ?>" height="60px" />
				</div>
			</div>
		</div>
	</div>
	<div id="live_container" class="row mt-3">
		<?= loadSubTemplate('argus_carrier_select'); ?>
	</div>
</div>

<?= loadSubTemplate(['js/accept_outbound_trailer']); ?>