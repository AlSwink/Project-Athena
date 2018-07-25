<div class="row mb-4">
	<div class="col">
		<h5>Having Troubles logging in?</h5>
		<small>Please provide the issue you are experiencing.</small>
	</div>
	<div class="col text-right">
		<a href="#" class="text-right" onClick="templater('landing/login','#view_template')">
		<i class="fas fa-caret-left"></i> Return to Login</a>
	</div>
</div>
<div class="row mb-3">
	<div class="col-8">
		<label>Issue</label>
		<select id="issue" name="problem" class="form-control">
			<option value="0">-Please Chooose-</option>
			<option value="locked">My account is locked out</option>
			<option value="forgot">I forgot my username or password</option>
			<option value="other">Other, Please specify</option>
		</select>
	</div>
</div>
<div id="locked" class="row collapse mb-3 items">
	<div class="col-6">
		<input type="text" class="form-control" name="username" placeholder="Enter your WMS username"/>
	</div>
</div>
<div id="forgot" class="row collapse mb-3 items">
	<div class="col-6">
		<input type="email" class="form-control" name="email" placeholder="Enter your email"/>
	</div>
</div>
<div id="other" class="items collapse mb-3">
	<div class="row mb-2">
		<div class="col-6">
			<input type="text" class="form-control" name="contact_person" placeholder="Enter the contact person"/>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<textarea class="form-control" rows="6" placeholder="Describe your issue"></textarea>
		</div>
	</div>
</div>
<div id="submit_div" class="collapse row items">
	<div class="col">
		<button type="button" class="btn btn-sm btn-primary">Request Help</button>
	</div>
</div>
<hr>