<div class="row mb-4">
	<div class="col">
		<h5>Request Login</h5>
		<small>To request access to this site please complete the below fields.</small>
	</div>
	<div class="col text-right">
		<a href="#" class="text-right templater-btn" onClick="templater('landing/login','#view_template')">
		<i class="fas fa-caret-left"></i> Return to Login</a>
	</div>
</div>
<div class="row justify-content-start mb-3">
	<div class="col-6">
		<label>This login is for?</label>
		<select id="purpose" name="login_for" class="form-control form-control-sm">
			<option value="0">-Please Chooose-</option>
			<option value="temporary">Temporary Employee</option>
			<option value="xpo">XPO Employee</option>
			<option value="guest">Guest</option>
		</select>
	</div>
	<div id="agency_section" class="col-6 collapse">
		<label>Agency</label>
		<select id="agency" name="temp_agency" class="form-control form-control-sm">
			<option value="0">-Please Choose-</option>
			<option value="paramount">Paramount Staffing</option>
			<option value="randstad">Randstad Technologies</option>
		</select>
	</div>
</div>
<div id="details" class="collapse mb-3">
	<div class="row mb-3">
		<div class="col">
			<input type="text" class="form-control form-control-sm" name="fname" placeholder="First Name" maxlength="16" required/>
		</div>
		<div class="col">
			<input type="text" class="form-control form-control-sm" name="lname" placeholder="Last Name" maxlength="16" required/>
		</div>
		<div class="col">
			<input type="text" class="form-control form-control-sm alpha-no" name="ssn" placeholder="Last 4 SSN" maxlength="4" required/>
		</div>
	</div>
	<div class="row mb-2">
		<div class="col">
			<small><i>Upon hitting the submit button you agree to the <a href="#">terms and agreement</a> on using this page</i></small>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<button type="button" class="btn btn-sm btn-primary">Send Request</button>
		</div>
	</div>
</div>
<hr>