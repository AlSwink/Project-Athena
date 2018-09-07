<script>
	function start_load(shipment_type)
	{
		if(shipment_type == 'WR'){
			$('#start_load_wr').modal('show');
		}else{
			$('#start_load_reg').modal('show');
		}
		/*now = moment().format('MM/DD/YYYY');
		$('#tabs a[href="#verification2_sheet"]').tab('show');
		$('.timestamps').text(now);*/
	}

	$('.start_loading_btn').click(function(){
		shipment = $('.start_load_id:visible').html();
		socket.emit('command','/do-argus-loading-'+shipment);
		$('.modal').modal('hide');
	});
</script>