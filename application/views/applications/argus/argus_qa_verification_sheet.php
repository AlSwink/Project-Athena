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
				<th>Shipment</th>
				<th class="shipment text-primary"></th>
			</tr>
			<tr>
				<th>Carrier</th>
				<th class="carrier text-primary"></th>
			</tr>
			<tr>
				<td>Loader</td>
				<td class="text-primary"><b></b></td>
			</tr>
			<tr>
				<td>QA</td>
				<td class="text-primary"><b><?= $this->session->userdata('user_info')['fname'].' '.$this->session->userdata('user_info')['lname']; ?></b></td>
			</tr>
			<tr>
				<td>Date</td>
				<td><span class="timestamps"></span></td>
			</tr>
		</table>
		<div class="btn-group w-100">
			<button type="button" class="cancel cancel_verification_btn btn btn-secondary w-50">Cancel</button>
			<button type="button" class="reset_sheet btn btn-danger w-50">Not Ready <i class="fas fa-times"></i></button>
			<button id="ready_qa_btn" type="button" class="btn btn-success w-50">Ready <i class="fas fa-check"></i></button>
		</div>
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
					<span id="pallet_number" class="sheet_totals ">1</span>
				</td>
				<td class="bg-success text-light">
					<span id="pallet_number" class="sheet_totals bg-success">1</span>
				</td>
			</tr>
			<tr>
				<td>
					<i class="fas fa-boxes fa-2x text-info mt-2"></i>
					<br>Cartons
				</td>
				<td>
					<span id="carton_count" class="sheet_totals">0</span>
				</td>
				<td class="bg-success text-light">
					<span id="carton_count" class="sheet_totals">0</span>
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
					<th>Pallet Number</th>
					<th>Expected</th>
					<th>Actual</th>
					<th>Comments</th>
				</tr>
			</thead>
			<tbody>
				<tr class="pallet_row">
					<td><h1 class="pallet_num mb-0">1</h1></td>
					<td class="carton_control">
						
					</td>
					<td>
						<select name="reason[]" class="form-control from-control-lg mt-1 text-center">
							<option>Good <i class="fas fa-check"></i></option>
							<option>Short</option>
							<option>Over</option>
						</select>
					</td>		
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row mb-5">
	<div class="btn-group w-100 col">
		<button type="button" class="cancel cancel_verification_btn btn btn-secondary w-50">Cancel</button>
		<button type="button" class="reset_sheet btn btn-danger w-50">Not Ready <i class="fas fa-times"></i></button>
		<button id="ready_qa_btn" type="button" class="btn btn-success w-50">Ready <i class="fas fa-check"></i></button>
	</div>
</div>