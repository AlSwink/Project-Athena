<html>
	<head>
		<?php $this->load->view('includes/head',$dependencies = null); ?>
		<!-- this will load the head template enabling the dependencies provided from the referring controller -->
	</head>
	<body style="margin-bottom: 29.6px" onLoad="templater('includes/announcements','.ticker',[item=>'announcements']);">
		<?php 
			$this->load->view('includes/navigation');
			$this->load->view($page);
			$this->load->view('includes/footer_nav');
			$this->load->view('includes/bootstrap');
			$this->load->view('includes/credits');
		?>
	</body>
</html>