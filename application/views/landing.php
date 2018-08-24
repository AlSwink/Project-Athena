<html>
	<head>
		<?php $this->load->view('includes/head',$dependencies = null); ?>
		<!-- this will load the head template enabling the dependencies provided from the referring controller -->
	</head>
	<body onLoad="templater('<?=$template;?>','#view_template');templater('includes/footer','#footer')">
		<div id="accent" class="row layer"></div>
		<div id="backdrop" class="row layer"></div>
		<div id="content-section" class="row layer justify-content-md-center">
			<div id="middle" class="col-sm-10 col-md-10 col-lg-6 col-12">
				<div class="container">
					<div class="row">
						<div class="col-5">
							<br>
							<img src="<?= base_url('/assets/img/xpo_logo_trans.png'); ?>" class="img-fluid" alt="Responsive image">
						</div>
					</div>
					<hr>
					<div id="view_template"></div>
					<div id="footer"></div>
				</div>
			</div>
		</div>
		<?php 
			$this->load->view('includes/credits');
		 	$this->load->view('includes/bootstrap');
		 ?>
	</body>
</html>