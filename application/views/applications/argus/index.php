<div class="container-fluid">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<div class="row">
		<div class="col-6">
			<div class="form-group">
				<label>Search WR/Shipment</label>
				<input type="text" class="form-control"/>
			</div>
		</div>
		<div class="col">
			
		</div>
	</div>
	<?php loadSubTemplate('argus_shipment_list'); ?>
</div>
<?php
	loadSubTemplate('js/index');
?>