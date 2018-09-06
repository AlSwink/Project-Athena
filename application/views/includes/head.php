<!-- 
	this is the head section for each page loaded
	to increase performance and security. this dependency option has been added to be selective on which resources to use.
	for more info on currently available dependency check knowledgebase/dependency.
-->
<!-- metadata start -->
<title>Project Athena <?= getCurrentPage($this->router->fetch_class()); ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Paul Gillo">
<!-- metadata end -->

<!-- icon start -->
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url('/assets/img/icon/android-icon-192x192.png'); ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('/assets/img/icon/favicon-32x32.png'); ?>">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('/assets/img/icon/favicon-96x96.png'); ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('/assets/img/icon/favicon-16x16.png'); ?>">
<link rel="manifest" href="<?php echo base_url('/assets/img/icon/manifest.json'); ?>">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo base_url('/assets/img/icon/ms-icon-144x144.png'); ?>">
<meta name="theme-color" content="#ffffff">
<!-- icon end -->


<!-- css stylesheet start -->
<link rel="stylesheet" href="<?= base_url('/assets/css/bootstrap.min.css'); ?>"/>
<link rel="stylesheet" href="<?= base_url('/assets/css/fontawesome-all.css'); ?>"/>
<link rel="stylesheet" href="<?= base_url('/assets/css/flipclock.css'); ?>"/>
<link rel="stylesheet" href="<?= base_url('/assets/datatables/datatables.css'); ?>"/>
<link rel="stylesheet" href="<?= base_url('/assets/css/xpo.css'); ?>"/>
<?php 
	if(isset($dependencies['css'])):
	foreach($dependencies['css'] as $css): ?>
		<link rel="stylesheet" href="<?= base_url('/assets/css/'.$css.'.css'); ?>"></script>
<?php 	
	endforeach;
	endif;
?>
<!-- css stylesheet end -->


<!-- js start-->
<script src="<?= base_url('/assets/js/jquery-2.2.4.min.js'); ?>"></script>
<script src="<?= base_url('/assets/js/fontawesome-all.min.js'); ?>"></script>
<script src="<?= base_url('/assets/js/moment.js'); ?>"></script>
<script src="<?= base_url('/assets/js/main.js'); ?>"></script>
<script src="<?= base_url('/assets/datatables/datatables.js'); ?>"></script>
<script src="<?= 'http://'.$_SERVER['HTTP_HOST'].':3000/socket.io/socket.io.js'; ?>"></script>
<script>
  var socket = io.connect("<?= 'http://'.$_SERVER['HTTP_HOST'].':3000';?>");
</script>
<?php
	if(isset($dependencies['js'])):
	foreach($dependencies['js'] as $js): ?>
		<script type="text/javascript" src="<?= base_url('/assets/js/'.$js.'.js'); ?>"></script>
<?php 	
	endforeach;
	endif; ?>
<!-- js end-->