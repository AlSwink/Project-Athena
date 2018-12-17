
<div class="card shadow mt-1">
	<div class="card-body p-3">
		<h5 class="mb-0"><?= $line['sku']; ?> <span class="text-secondary"><?= $line['pkg']; ?></span><span class="float-right">NEED : <b class="text-danger"><?= $line['need']; ?></b></span></h5>
		<span class="badge badge-info"><?= $line['commodity']; ?></span>
		<input type="hidden" name="qty[]" value="<?= $line['need']; ?>"/>
		<input type="hidden" name="commodity[]" value="<?= $line['commodity']; ?>"/>
		<table class="table table-sm table-bordered mt-1 template_table mb-0">
			<thead>
				<tr class="bg-dark text-light">
				<?php
					$keys = array_keys($line['loc_info']);
					foreach($keys as $key){ ?>
						<td><?= $key; ?></td>
				<?php } ?>
				</tr>
			</thead>
			<tr>
				<?php 
					foreach($line['loc_info'] as $key => $loc){ ?>
					<td><?= $loc; ?><input type="hidden" name="<?= $key; ?>[]" value="<?= $loc; ?>"/></td>
				<?php } ?>
			</tr>
		</table>
	</div>
</div>