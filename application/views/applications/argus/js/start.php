<script>
	var	 shipment = $('#start_shipment_id').val();

	function start_shipment()
	{
		shipLock(shipment,1);
		socket.emit('command','/do-argus-lock-'+shipment);
		$('#start_shipment').modal({backdrop:'static',keyboard:false});
		$('#start_shipment').modal('show');
	}

	$('#start_shipment_btn').click(function(){
		data = {
				'shipment' : shipment,
				'stage' : 2,
				'button_id' : this.id,
				'type' : 'start'
			}

		updateShipment(data);
		socket.emit('command','/do-argus-started-'+shipment);
		$('.modal').modal('hide');
		socket.emit('command','/do-argus-unlock-'+shipment);
		notifyAll(shipment,'started');
	});
</script>