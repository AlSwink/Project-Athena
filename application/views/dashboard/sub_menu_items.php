<?php
	foreach($submenu as $item){ ?>
	<?php if(!$item['controller']){ ?>
		<div class="col">
		<h6 class="text-muted" data-tooltip="<?= $item['description']; ?>"><?= $item['name']; ?></h6>
	<?php }else{ ?>
		<div class="col">
			<small><a href="<?= $item['controller']; ?>" class="text-white sub_menu_items"><?= $item['name']; ?> <i class="fas fa-caret-right"></i></a></small>
		
	<?php
		}
		if($item['submenu']){
			$this->load->view('dashboard/sub_menu_items',$item);
	} ?>
	</div>
<?php } ?>
