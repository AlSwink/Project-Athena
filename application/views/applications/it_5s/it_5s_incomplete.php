<?php foreach($incomplete as $ncmp){ ?>
<div class="col-4 mb-2">
	<div class="card changeStatus" data-id="<?=$ncmp['id'];?>" data-status='0' >
		<div class="card-body p-1">
			<?php echo $ncmp['task']; ?>
		</div>
	</div>
</div>
<?php } ?>