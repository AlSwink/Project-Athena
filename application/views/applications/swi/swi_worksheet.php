<?php if(isset($this->kiosk)){ ?>
	<div id="assign_print" class="d-none d-print-block"></div>
<?php } ?>
<div class="container-fluid mt-3 d-print-none">
	<div class="row">
		<div class="col">
			<ul class="nav nav-tabs nav-fill dashboard_tabs">
				<li class="nav-item">
			    	<a class="nav-link active" data-toggle="tab" href="#swi_input"><i class="fas fa-pen-square"></i>  Input SWI</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link " data-toggle="tab" href="#swi_resolution"><i class="fas fa-diagnoses"></i> Resolution</a>
			  	</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="tab-content col">
			<div class="tab-pane active" id="swi_input" role="tabpanel">
			  	<?php loadSubTemplate('swi_input'); ?>
			</div>
			<div class="tab-pane " id="swi_resolution" role="tabpanel">
			  	<?php loadSubTemplate('swi_resolution'); ?>
			</div>
		</div>
	</div>
</div>

