<?php $client_info = get_client_machine_info(); ?>
<div id="credits" class="modal fade">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header" style="background-image: url('<?= base_url('/assets/img/'.getSiteSetting('credit_header').'')?>');background-size: cover;background-position-y: -9px;background-repeat: no-repeat;"">
				<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
			</div>
			<div class="modal-body text-center">
				<h5>Project Athena&trade; <?= date('Y'); ?> <span class="text-muted">ver. 1β</span></h5>
				<small>Product of <span class="text-info"><?= getSiteSetting('site_name'); ?></span></small><br>
				<small class="text-muted">Developer : Paul Gillo</small>
				<hr>
				<div class="table-responsive">
					<table class="table table-sm table-borderless text-center">
						<thead>
							<th colspan="2">Client Info</th>
						</thead>
						<tbody>
							<?php foreach($client_info as $k => $v){ ?>
							<tr>
								<td class="text-muted"><small><?= strtoupper($k); ?></small></td>
								<td class="text-lead"><small><?= $v; ?></small></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>