<?php $this->load->view('includes/error_messages'); ?>
<div class="row">
	<div class="col">
		<h5>Welcome to XPO-KNT Internal Site!</h5>
		<br/>
		<p>By logging in you will be able to:</p>
		<ul>
			<li><small>Access KNT's in-house tools.</small></li>
			<li><small>Create Reports and Monitor Activity.</small></li>
			<li><small>View Internal events and announcements.</small></li>
			<li><small>Request assistance and learn through our knowledgebase.</small></li>
		</ul>
	</div>
	<div class="col">
		<div class="card shadow p-3 mb-5 bg-white rounded">
		  <div class="card-body">
		  	<h5 class="card-title">Please Login to continue</h5>
		  	<form action="<?= site_url('auth/login'); ?>" method="POST">
		  		<div class="form-group">
		  			<input type="text" class="form-control" name="wms_user" placeholder="Enter WMS username" required>
		  		</div>
		  		<div class="form-group">
		  			<input type="password" class="form-control" name="wms_pass" placeholder="Enter password" required>
		  		</div>
			    <button class="btn btn-primary">Login <i class="fas fa-sign-in-alt"></i></button>
			    <button class="btn btn-secondary" onClick="templater('landing/having_troubles','#view_template')">Having Troubles?</button>
			</form>
				<small><a href="#" class="templater-btn" onClick="templater('landing/request_login','#view_template')">Need to request a login?</a></small>
		  </div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="card shadow-none mb-3 bg-light rounded">
			<div class="card-body">
			  	<h6>Up Next : Mother's Day</h6>
				<p>News Goes here</p>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card shadow-none mb-3 bg-light rounded">
			<div class="card-body">
			  	<h6>XPO Director is Visiting</h6>
				<p>News Goes here</p>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card shadow-none mb-3 bg-light rounded">
			<div class="card-body">
			  	<h6>New Updated Site!</h6>
				<p>News Goes here</p>
			</div>
		</div>
	</div>
</div>