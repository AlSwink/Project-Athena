<ul class="nav nav-tabs nav-fill" id="tabs" role="tablist">
  <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#nested_conts" >Nested <span class="badge badge-secondary"><?= count($shipment['nested']); ?></span></a></li>
  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#unnested_conts" >Un-Nested <span class="badge badge-secondary"><?= count($shipment['unnested']); ?></span></a></li>
</ul>
<div class="tab-content">
	<div id="nested_conts" class="tab-pane active">
		<?php loadSubTemplate('argus_nested_containers'); ?>
	</div>
	<div id="unnested_conts" class="tab-pane">
		<?php loadSubTemplate('argus_unnested_containers'); ?>
	</div>
</div>
