<div class="container-fluid">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<ul class="nav nav-tabs d-none" id="tabs" role="tablist">
	  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#shipment_list" >Shipment List</a></li>
	  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#verification_sheet" >Verification</a></li>
	  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#verification2_sheet" >QA</a></li>
	</ul>
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
	</div>
</div>
<?php
	loadSubTemplate(['modals','js/index','js/start','js/verification','js/qa','js/load','js/signature','js/release']);
?>