<div class="container-fluid">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<div id="incompleteList" class="row" style="max-height:30%; overflow:auto; margin:25px;">
		
		<?php loadSubTemplate('it_5s_incomplete');?>
		
	</div>
	<div class="row" style="background-color:gray;">
	<?php loadSubTemplate('it_5s_picture');?>
	</div>
	<div id="completeList" class="row" style="max-height:30%; overflow:auto; margin:25px;">
	<?php loadSubTemplate('it_5s_complete');?>
	</div>
	
	
</div>
<?=loadSubTemplate(['css','modals','js']);?>