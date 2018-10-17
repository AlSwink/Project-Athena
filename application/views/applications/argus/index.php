<div class="container-fluid">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<input type="hidden" name="mode" value="<?= $stage; ?>"/>
	<div class="tab-content">
		<div id="shipment_list" class="tab-pane active">
			<?php loadSubTemplate('argus_shipment_list'); ?>
		</div>
		<div id="verification_sheet" class="tab-pane">
			<?php loadSubTemplate('argus_verification_sheet'); ?>
		</div>
		<div id="verification2_sheet" class="tab-pane">
			<?php loadSubTemplate('argus_qa_verification_sheet'); ?>
		</div>
		<div id="change_log" class="tab-pane">
			<?php loadSubTemplate('argus_changelog'); ?>
		</div>
	</div>
	<ul class="nav nav-tabs d-none" id="tabs" role="tablist">
	  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#shipment_list" >Shipment List</a></li>
	  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#verification_sheet" >Verification</a></li>
	  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#verification2_sheet" >QA</a></li>
	  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#change_log" >QA</a></li>
	</ul>
</div>
<?php
	loadSubTemplate([
				'css',
				'modals',
				'js/index',
				'js/start',
				'js/verification',
				'js/qa',
				'js/load',
				'js/signature',
				'js/release'
			]);
?>