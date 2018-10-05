<div class="container-fluid">

	<?=loadInclude('app_container_control',$this->app_info); ?>
	<div class="row">
		<div class="col-lg-9">
			<?=loadSubTemplate('my_employees');?>
			<?=loadSubTemplate('training_modules');?>
		</div>
		<div class="col-lg-3">
			<?=loadSubTemplate('e_roster_menu');?>
			<?=loadSubTemplate('system_configuration');?>
		</div>
	</div>

</div>
<?=loadSubTemplate(['css','modals','js']);?>