<div class="container-fluid">
	<?php //$this->load->view('applications/container_control'); ?>
	<div class="row mt-2">
		<div id="notes" class="col-4" style="min-height: 250px">
			<?php loadSubTemplate('notes.php'); ?>
		</div>
		<div id="operations" class="col-8"></div>
	</div>
	<hr>
	<div id="servers" class="row mt-2 mx-1"></div>
	<div id="systems" class="row mx-1"></div>
	<div id="machines" class="row mx-1"></div>
</div>
<?php loadSubTemplate('js'); ?>