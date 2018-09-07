<script>
	var argus = {
			started: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-clipboard-list').removeClass('text-muted');
				$(card).find('.fa-clipboard-list').addClass('text-success');
				$(card).data('stage','verification');
				$(card).find('.card-subtitle').html('Under Verification').removeClass('text-light').css('color','#19e0ff');
			},
			ready_qa: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-pallet').removeClass('text-muted');
				$(card).find('.fa-pallet').addClass('text-warning');
				$(card).data('stage','verification_pass2');
				$(card).find('.card-subtitle').html('Waiting for QA').css('color','').addClass('text-warning');
			},
			verified: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-pallet').removeClass('text-warning');
				$(card).find('.fa-pallet').addClass('text-success');
				$(card).data('stage','verified');
				$(card).find('.card-subtitle').html('Waiting for Door/Pickup number').css('color','').addClass('text-warning');
			},
			loading: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-truck-loading').removeClass('text-muted');
				$(card).find('.fa-truck-loading').addClass('text-success');
				$(card).data('stage','loading');
				$(card).find('.card-subtitle').html('Waiting for BOL signature').css('color','').addClass('text-warning');
			},
			loaded: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-clipboard-check').removeClass('text-muted');
				$(card).find('.fa-clipboard-check').addClass('text-success');
				$(card).find('.card-subtitle').html('Signed and being released').css('color','').removeClass().addClass('card-subtitle text-success');
				$(card).data('stage','signed');
			},
			release: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-truck').removeClass('text-muted');
				$(card).find('.fa-truck').addClass('text-success');
				$(card).find('.card-subtitle').html('Released').css('color','').addClass('text-success');
				$(card).data('stage','ship_complete');
			},
			ship_complete: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).remove();
			}
	};
	

	$(document).ready(function(){
		app_name = '<?= $method = $this->router->fetch_method(); ?>';
	});

	$('.shipment_item').click(function(){
		stage = $(this).data('stage');
		shipment = $(this).data('shipment').toString();
		shipment_type = shipment.substr(0,2);
		$('.shipment').html(shipment);
		$('.shipment_val').val(shipment);

		switch(stage){
			case 'waiting':
				start_shipment();
				break;
			case 'verification':
				start_verification();
				break;
			case 'verification_pass2':
				start_qa(shipment);
				break;
			case 'verified':
				start_load(shipment_type);
				break;
			case 'loading':
				start_bol_sign();
				break;
			case 'signed':
				start_security_sign();
				break;
			case 'ship_complete':
				socket.emit('command','/do-argus-ship_complete-'+shipment);
				break;
		}
	});
</script>