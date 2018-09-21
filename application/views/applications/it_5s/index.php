<div class="container-fluid">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<div id="incompleteList" class="row border-bottom" style="max-height:30%; overflow:auto;">
		
		<?php loadSubTemplate('it_5s_incomplete');?>
		
	</div>
	<div class="row">
	<?php loadSubTemplate('it_5s_picture');?>
	</div>
	<div id="completeList" class="row border-top" style="max-height:30%; overflow:auto">
	<?php loadSubTemplate('it_5s_complete');?>
	</div>
	
	
</div>
<?=loadSubTemplate(['css','modals','js']);?>