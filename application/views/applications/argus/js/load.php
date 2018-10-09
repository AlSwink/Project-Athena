<script>
	var shipment = $('.start_load_id:visible').html();
	function start_load(shipment_type)
	{
		socket.emit('command','/do-argus-lock-'+shipment);
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
		socket.emit('command','/do-argus-loading-'+shipment);
		$('.modal').modal('hide');
		socket.emit('command','/do-argus-unlock-'+shipment);
	});
</script>