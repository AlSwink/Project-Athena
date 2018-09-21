<?php foreach($complete as $cmp){ ?>
<div class="col-4 mb-2">
	<div class="card changeStatus" data-id="<?=$cmp['id'];?>" data-status='1'>
		<div class="card-body p-1">
			<?php echo $cmp['task']; ?>
		</div>
	</div>
</div>
<?php } ?>