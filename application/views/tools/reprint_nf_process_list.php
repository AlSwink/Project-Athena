<label>Process List</label>
<ul class="list-group">
	<?php foreach($conts as $cont){ ?>
		<?php if($cont['status'] == 'ok'){ ?>
			<li class="list-group-item list-group-item-success"><?= $cont['cont']; ?><br><small><i><?= $cont['cont_pdf']; ?></i></small>
			<input type="hidden" name="conts[]" class="containers" value="<?= $cont['cont_pdf']; ?>"/>
		</li>
		<?php }else{ ?>
			<li class="list-group-item list-group-item-danger d-flex justify-content-between align-items-center">
			    <b><?= $cont['cont']; ?></b>
			    <span class="badge badge-dark badge-pill"><?= $cont['status']; ?></span>
			</li>
		<?php } ?>
	<?php } ?>
</ul>