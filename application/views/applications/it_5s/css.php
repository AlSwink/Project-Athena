<style>

#complete{
	background-image: url(<?=base_url('assets/img/it_5s/after.jpg');?>);
	height: 250px;
	width: 500px;
	position: fixed;
	z-index: 5;
	background-size: cover;
	clip: rect(0px,<?=$percent*500;?>px,500px,0px);
	border-bottom: 5px solid green;
	
}
#incomplete{
	
	background-image: url(<?=base_url('assets/img/it_5s/before.jpg');?>);
	height: 250px;
	width: 500px;
	position: fixed;
	z-index: 4;
	background-size: cover;
	border-bottom: 5px solid red;
	
}
</style>