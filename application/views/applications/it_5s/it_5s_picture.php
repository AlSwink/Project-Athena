<div class="col-4 text-center">
	<h4 class="display-4" >PERCENT COMPLETE: <br><span id="percentComplete"><?=round($percent*100);?></span>%</h4>
</div>
<div class="col-4 text-center" style="height:250px">
	<!--<img src="<?=base_url('assets/img/it_5s/before.jpg');?>"  height="250px" alt="Responsive image">-->
	
		<div id='complete'></div>
		<div id='incomplete'></div>
	
</div>
<div class="col-4 text-center">
	<h4 class="display-4">PERCENT INCOMPLETE: <br><span id="percentIncomplete"><?=round((1-$percent)*100);?></span>%</h4>
</div>