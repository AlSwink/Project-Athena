<html>
	<head>
		<?php $this->load->view('includes/head',$dependencies = null); ?>
		<!-- this will load the head template enabling the dependencies provided from the referring controller -->
	</head>
	<body>
		<?php $this->load->view($page); ?>
		<?php $this->load->view('includes/bootstrap'); ?>
	</body>
</html>