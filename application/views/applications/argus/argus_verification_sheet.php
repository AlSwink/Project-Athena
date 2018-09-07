<input id="verify_shipment_id" type="hidden" class="shipment_val"/>
<div class="row">
	<div class="col">
		<h4>Verification Sheet</h4>
	</div>
</div>
<div class="row mb-1">
	<div class="col-lg-6 col-sm-12">
		<table class="table table-sm table-bordered mb-1">
			<tr>
				<th>Carrier</th>
				<th>FDXG</th>
			</tr>
			<tr>
				<td>Date</td>
				<td><span class="timestamps"></span></td>
			</tr>
			<tr>
				<td>Loader</td>
				<td><?= $this->session->userdata('user_info')['fname'].' '.$this->session->userdata('user_info')['lname']; ?></td>
			</tr>
			<tr>
				<td>Trailer</td>
				<td><input type="text" class="form-control form-control-sm" placeholder="Scan/Enter Trailer here"></td>
			</tr>
			<tr>
				<td>Door Number</td>
				<td><input type="text" class="form-control form-control-sm" placeholder="Scan/Enter Door here"></td>
			</tr>
			<tr>
				<td>Total Pallets</td>
				<td>0</td>
			</tr>
			<tr>
				<td>Total Cartons</td>
				<td>0</td>
			</tr>
		</table>
		<div class="btn-group w-100">
			<button id="cancel_verification_btn" type="button" class="btn btn-secondary w-50">Cancel</button>
			<button id="ready_qa_btn" type="button" class="btn btn-success w-50">Ready for QA <i class="fas fa-check"></i></button>
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<table class="table table-borderd table-sm">
			<thead>
				<tr>
					<th>WR NUMBER</th>
					<th>SHIP ID NUMBER</th>
					<th>PALLET COUNT</th>
					<th>CARTONS</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="text" class="form-control form-control-sm"/></td>
					<td><input type="text" class="form-control form-control-sm"/></td>
					<td><input type="text" class="form-control form-control-sm"/></td>
					<td><input type="text" class="form-control form-control-sm"/></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>