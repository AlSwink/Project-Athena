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
				$(card).find('.fa-pallet').removeClass('text-muted');
				$(card).find('.fa-pallet').addClass('text-success');
			},
			loaded: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-truck-loading').removeClass('text-muted');
				$(card).find('.fa-truck-loading').addClass('text-success');
			},
			signed: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-clipboard-check').removeClass('text-muted');
				$(card).find('.fa-clipboard-check').addClass('text-success');
			},
			release: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-truck').removeClass('text-muted');
				$(card).find('.fa-truck').addClass('text-success');
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
		shipment = $(this).data('shipment');
		$('.shipment').html(shipment);
		$('.shipment_val').val(shipment);

		switch(stage){
			case 'waiting':
				start_shipment(shipment);
				break;
			case 'verification':
				start_verification(shipment);
				break;
		}
	});
</script>