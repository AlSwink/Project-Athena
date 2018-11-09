<input id="verify2_shipment_id" type="hidden" class="shipment_val"/>
<div class="row">
	<div class="col">
		<h4>QA Verification</h4>
	</div>
</div>
<div class="row mb-1">
	<div class="col-lg-6 col-sm-12 mb-2">
		<table class="table table-sm table-bordered mb-1">
			<tr>
				<td>Shipment</td>
				<th class="shipment text-primary"></th>
			</tr>
			<tr>
				<td>Carrier</td>
				<th class="qa_carrier text-primary"></th>
			</tr>
			<tr>
				<td>Loader</td>
				<th class="loader text-danger"></th>
			</tr>
			<tr>
				<td>QA</td>
				<th class="text-primary"><?= $this->session->userdata('user_info')['fname'].' '.$this->session->userdata('user_info')['lname']; ?></th>
			</tr>
			<tr>
				<td>Date</td>
				<td><span class="timestamps"></span></td>
			</tr>
			<tr>
				<td>Verification ID</td>
				<td class="verification_id"></td>
			</tr>
		</table>
	</div>
	<div class="col-lg-6 col-sm-12">
		<table class="table table-sm table-bordered text-center">
			<tr class="">
				<th class="w-25 bg-dark text-light"></th>
				<th class="bg-dark text-light">Expected</th>
				<th class="bg-primary text-light">Counted</th>
			</tr>
			<tr class="">
				<td>
					<i class="fas fa-pallet fa-2x text-info mt-2"></i>
					<br>Pallets
				</td>
				<td>
					<span id="pallet_expected" class="sheet_totals ">1</span>
				</td>
				<td class="text-muted">
					<span id="pallet_counted" class="sheet_totals">1</span>
				</td>
			</tr>
			<tr>
				<td>
					<i class="fas fa-boxes fa-2x text-info mt-2"></i>
					<br>Cartons
				</td>
				<td>
					<span id="carton_count_expected" class="sheet_totals">0</span>
				</td>
				<td class="text-muted">
					<span id="carton_count_counted" class="sheet_totals">0</span>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="row mb-1">
	<div class="col">
		<table class="table table-bordered table-sm text-center">
			<thead>
				<tr class="thead-dark">
					<th class="w-25">Pallet Number</th>
					<th class="w-25">Expected</th>
					<th class="w-25">Actual</th>
					<th class="w-25">QTY</th>
				</tr>
			</thead>
			<tbody id="qa_sheet">
			</tbody>
		</table>
		<div class="alert alert-warning">
			Please make sure to correct all the errors on this shipment before proceeding. If an error is not corrected the <b>QA will be accountable</b> for the issue.
		</div>
	</div>
</div>
<div class="row mb-5">

	<div class="btn-group w-100 col">
		<button type="button" class="cancel cancel_verification_btn btn btn-secondary w-50">Cancel</button>
		<button id="ready_load_btn" type="button" class="btn btn-success w-50">Submit <i class="fas fa-check"></i></button>
	</div>
</div>