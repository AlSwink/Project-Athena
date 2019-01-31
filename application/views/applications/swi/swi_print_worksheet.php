<div class="worksheet">
	<div class="row text-center">
		<div class="col-1">
			<u><?= $data[0]->assignment_id; ?></u><br>
			<small>Assignment ID</small>
		</div>
		<div class="col">
			<u><?= $data[0]->e_fname.' '.$data[0]->e_lname; ?></u><br>
			<small>Auditor</small>
		</div>
		<div class="col">
			<u><?= $data[0]->doc_name; ?></u><br>
			<small>Document Name</small>
		</div>
		<div class="col">
			<u><?= $data[0]->doc_number; ?></u><br>
			<small>Document Number</small>
		</div>
		<div class="col-2">
			<u><?= date('m/d/Y'); ?></u><br>
			<small>Date</small>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col">
			<table class="table table-sm table-bordered table-striped text-center">
				<thead>
					<tr>
						<th>Process</th>
						<th>Lead Principle</th>
						<th>Standard</th>
						<th style=>Comments</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $item){ ?>
						<tr>
							<td style="width:30%"><?= $item->process; ?></td>
							<td style="width:25%"><?= $item->principle; ?></td>
							<td style="width:10%"></td>
							<td style="width:35%"></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-6">
			<b>Employee being audited :</b> __________________________________ <br>
			<b>Employee signature :</b> _______________________________________ <br><br>
			<b>Auditor signature :</b> _________________________________________
		</div>
		<div class="col-6">
			<small>
			Fill out the standard column using the below legend and make sure to fill out comments if Not applicable<br>
			<i class="fas fa-check"></i> Standard met<br>
			<i class="fas fa-times"></i> Did not meet standard<br>
			<i class="fas fa-ban"></i> Not Applicable
			</small>
		</div>
	</div>
</div>
<?php
	$this->load->view('applications/swi/css');
?>