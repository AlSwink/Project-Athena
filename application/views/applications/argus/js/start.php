<script>
	var	 shipment = $('#start_shipment_id').val();

	function start_shipment()
	{
		shipLock(shipment,1);
		socket.emit('command','/do-argus-lock-'+shipment);
		
		$.ajax({
			type : 'POST',
			url : '<?= site_url("argus/verifyNesting"); ?>',
			dataType : 'json',
			data : { shipment : shipment },
			beforeSend : function(){
				$('body').append(<?= getFullLoading('Nesting Check in progress.<br>Please wait'); ?>);
				$('#unnest_count').html(0);
				$('#unnested_container_alert').html('');
				$('#unnestalert').addClass('d-none');
			},
			success : function(res){
				
				if(res){
					cards = '';
					$(res).each(function(k,v){
						cards += '<div id="unnested_container_alert" class="card text-center col-2 mb-1 px-0 containers">';
						cards += v;
						cards += '</div>';
					});
					$('#unnest_count').html(res.length);
					$('#unnested_container_alert').html(cards);
					$('#unnestalert').removeClass('d-none');
				}
			},
			complete : function(){
				$('#full-loader').remove();		
				$('#start_shipment').modal({backdrop:'static',keyboard:false});
				$('#start_shipment').modal('show');
			}
		});
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