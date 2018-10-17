<script>
	var filter = [];
	var argus = {
			started: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-clipboard-list').removeClass('text-muted');
				$(card).find('.fa-clipboard-list').addClass('text-success');
				$(card).attr('data-stage','verification');
				$(card).find('.card-subtitle').html('Under Verification').removeClass('text-light').css('color','#19e0ff');
			},
			ready_qa: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-boxes').removeClass('text-muted');
				$(card).find('.fa-boxes').addClass('text-success');
				$(card).attr('data-stage','verification_pass2');
				$(card).find('.card-subtitle').html('Waiting for QA').css('color','').addClass('text-warning');
			},
			verified: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-pallet').removeClass('text-muted');
				$(card).find('.fa-pallet').addClass('text-success');
				$(card).attr('data-stage','verified');
				$(card).find('.card-subtitle').html('Waiting for Door/Pickup number').css('color','').addClass('text-warning');
			},
			loading: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-truck-loading').removeClass('text-muted');
				$(card).find('.fa-truck-loading').addClass('text-success');
				$(card).attr('data-stage','loading');
				$(card).find('.card-subtitle').html('Waiting for BOL signature').css('color','').addClass('text-warning');
			},
			loaded: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-clipboard-check').removeClass('text-muted');
				$(card).find('.fa-clipboard-check').addClass('text-success');
				$(card).find('.card-subtitle').html('Signed and being released').css('color','').removeClass().addClass('card-subtitle text-success');
				$(card).attr('data-stage','signed');
			},
			release: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-truck').removeClass('text-muted');
				$(card).find('.fa-truck').addClass('text-success');
				$(card).find('.card-subtitle').html('Released').css('color','').addClass('text-success');
				$(card).attr('data-stage','ship_complete');
			},
			ship_complete: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).remove();
				updateCounts();
			},
			carrier_change: function(carrier){
				params = carrier.split('%');
				card = $('#shipment_list').find("div[data-shipment="+params[0]+"]");
				$(card).find('td.carrier').html(params[1]);
			},
			lock: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.card').addClass('bg-secondary');
				$(card).removeClass('shipment_item');
				updateCounts();
			},
			unlock: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.card').removeClass('bg-secondary');
				$(card).addClass('shipment_item');
				updateCounts();
			},
			prioritize: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.card').addClass('bg-primary');
				$(card).addClass('priority');
				updateFilter();
			},
			normalize: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.card').removeClass('bg-primary');
				$(card).removeClass('priority');
				updateFilter();
			},
			reset: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.fa-clipboard-list').removeClass('^=text').addClass('text-muted');
				$(card).find('.fa-pallet').removeClass('^=text').addClass('text-muted');
				$(card).find('.fa-truck-loading').removeClass('^=text').addClass('text-muted');
				$(card).find('.fa-clipboard-check').removeClass('^=text').addClass('text-muted');
				$(card).find('.fa-truck').removeClass('^=text').addClass('text-muted');
				$(card).attr('data-stage','waiting');
				$(card).find('.card-subtitle').html('Not Started').removeClass('^=text').css('color','white');
				updateCounts();
			},
			changelog: function(){
				$('a[href="#change_log"]').click();
			}
	};

	$(document).ready(function(){
		app_name = '<?= $method = $this->router->fetch_method(); ?>';

		$.contextMenu({
        	selector: '.sment',
        	build: function($triggerElement,e){
   				shipment = $($triggerElement[0]).data('shipment');
        		return {
        			callback: function(key, options,e){
		                switch(key){
		                	case 'prioritize':
		                		socket.emit('command','/do-argus-prioritize-'+shipment);
		                		break;
		                	case 'normalize':
		                		socket.emit('command','/do-argus-normalize-'+shipment);
		                		break;
		                	case 'reset':
		                		socket.emit('command','/do-argus-reset-'+shipment);
		                		break;
		                	case 'lock':
		                		socket.emit('command','/do-argus-lock-'+shipment);
		                		break;
		                	case 'unlock':
		                		socket.emit('command','/do-argus-unlock-'+shipment);
		                		break;
		                	case 'details':
		                		$('#details').modal('show');
		                		break;
		                }		

        			},
        			items: {
        				details: {name:"Details",icon:"fas fa-info-circle"},
        				prioritize: {name:"Prioritize",icon:"fas fa-star"},
        				normalize: {name:"Normalize",icon:"far fa-star"},
        				"sep1": "---------",
        				reset: {name:"Reset Shipment",icon:"fas fa-undo"},
        				lock: {name:"Lock Shipment",icon:"fas fa-lock"},
        				unlock: {name:"Unlock Shipment",icon:"fas fa-lock-open"}
        				
        			}
        		}
        	}
        });

		updateCounts();
	});

	$(document).on('click','.shipment_item',function(){
		stage = $(this).attr('data-stage');
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

	$(document).on('click','.cancel',function(){
		socket.emit('command','/do-argus-unlock-'+shipment);
	});

	$('#return_to_argus').click(function(){
		$('a[href="#shipment_list"').click();
	});

	$('.filter').click(function(){
		filter = [];
		state = $(this).hasClass('on');
		
		$('.sment').removeClass('d-none');

		if(!state){
			$(this).removeClass('off').addClass('on');
			$(this).addClass('btn-success');
		}else{
			$(this).removeClass('on').addClass('off');
			$(this).removeClass('btn-success');

		}

		$('.filter.on').each(function(k,v){
			filter.push($(v).attr('data-filter'));			
		});

		updateFilter();
	});

	function updateFilter()
	{
		if($(filter).length){
			$('.sment').addClass('d-none');
			classes = filter.join('.');
			$('.'+classes).removeClass('d-none');
		}
	}

	function updateCounts()
	{
		var stages = {
					'waiting' : 0,
					'verification' : 0,
					'verification_pass2' : 0,
					'verified' : 0,
					'loading' : 0,
					'signed' : 0,
					'ship_complete' : 0
			};

		shipments = $('.sment');
		counters = $('.counters');

		$(shipments).each(function(k,v){
			stage = $(v).attr('data-stage');
			++stages[stage];
		});

		$(counters).each(function(k,v){
			stage = $(v).attr('data-stage');
			$(v).html(stages[stage]);
		});		
	}

	function updateShipment(data)
	{
		url = '<?= site_url(); ?>';
	}
</script>