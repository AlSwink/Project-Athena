<div class="mt-2" style="max-height: 45%;overflow: auto;">
	<div class="row col mt-2 mx-0 px-0">
	<?php foreach($shipment['unnested'] as $cont){ ?>
		<div class="card text-center col-2 mb-1 px-0 containers">
			<?= $cont; ?>
		</div>
	<?php } ?>
	</div>
</div>