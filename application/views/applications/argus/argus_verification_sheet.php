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
				<th>Shipment</th>
				<th class="shipment text-primary"></th>
			</tr>
			<tr>
				<th>Carrier</th>
				<th class="carrier text-primary"></th>
			</tr>
			<tr>
				<td>Loader</td>
				<td class="text-primary"><b><?= $this->session->userdata('user_info')['fname'].' '.$this->session->userdata('user_info')['lname']; ?></b></td>
			</tr>
			<tr>
				<td>Date</td>
				<td><span class="timestamps"></span></td>
			</tr>
		</table>
		<div class="btn-group w-100">
			<button type="button" class="cancel cancel_verification_btn btn btn-secondary w-50">Cancel</button>
			<button id="ready_qa_btn" type="button" class="btn btn-success w-50">Ready for QA <i class="fas fa-check"></i></button>
		</div>
	</div>
	<div class="col-lg-6 col-sm-12">
		<table class="table table-sm table-bordered text-center">
			<thead>
				<tr class="thead-info">
					<th class="w-50">Total Pallets</th>
					<th class="w-50">Total Cartons</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<span id="pallet_number" class="sheet_totals">1</span> <i class="fas fa-pallet fa-3x text-info"></i>
					</td>
					<td>
						<span id="carton_count" class="sheet_totals">0</span> <i class="fas fa-boxes fa-3x text-info"></i>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row mb-5">
	<div class="col">
		<table class="table table-bordered table-sm text-center">
			<thead>
				<tr class="thead-dark">
					<th class="w-50">Pallet Number</th>
					<th class="w-50">Cartons</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr class="pallet_row">
					<td><h1 class="pallet_num mb-0">1</h1></td>
					<td class="carton_control">
						<div class="input-group input-group-lg">
							<div class="input-group-prepend">
								<button class="btn btn-secondary minus check" type="button"><i class="fas fa-minus fa-lg"></i></button>
							</div>
							<input type="number" class="form-control carton_count text-center" value="0" min="0" max="1000" step="1" readonly="" />
							<div class="input-group-append">
								<button class="btn btn-dark add check" type="button"><i class="fas fa-plus fa-lg"></i></button>
							</div>
						</div>
					</td>					
				</tr>
			</tbody>
		</table>
		<button type="button" class="add_pallet_row btn btn-md btn-info w-100 check">Add New Pallet <i class="fas fa-plus-circle"></i>
	</div>
</div>