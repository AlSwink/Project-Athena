<script>
	var sCheck;
	var	curr_user = <?= json_encode($this->session->userdata('user_info')); ?>;
	var notif = new Audio('<?= base_url('assets/audio/argus-notify-default.mp3'); ?>');
	var notif_announce = new Audio('<?= base_url('assets/audio/argus-notify-announcement.mp3'); ?>');
	var filter = [];
	var filter2 = [];

	var argus = {
			started: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).addClass('verification');
				$(card).find('.fa-clipboard-list').removeClass('text-muted');
				$(card).find('.fa-clipboard-list').addClass('text-success');
				$(card).attr('data-stage','verification');
				$(card).find('.card-subtitle').html('Under Verification');
			},
			ready_qa: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).addClass('verification_pass2');
				$(card).find('.fa-boxes').removeClass('text-muted');
				$(card).find('.fa-boxes').addClass('text-success');
				$(card).attr('data-stage','verification_pass2');
				$(card).find('.card-subtitle').html('Waiting for QA');
				notifyAll(shipment,'verified by the loader');
			},
			verified: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).addClass('verified');
				$(card).find('.fa-pallet').removeClass('text-muted');
				$(card).find('.fa-pallet').addClass('text-success');
				$(card).attr('data-stage','verified');
				$(card).find('.card-subtitle').html('Waiting for Door/Pickup number');
				notifyAll(shipment,'verified by the QA');
			},
			loading: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).addClass('loading');
				$(card).find('.fa-truck-loading').removeClass('text-muted');
				$(card).find('.fa-truck-loading').addClass('text-success');
				$(card).attr('data-stage','loading');
				$(card).find('.card-subtitle').html('Waiting for BOL signature');
				notifyAll(shipment,'sent for loading');
			},
			loaded: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).addClass('signed');
				$(card).find('.fa-clipboard-check').removeClass('text-muted');
				$(card).find('.fa-clipboard-check').addClass('text-success');
				$(card).find('.card-subtitle').html('Signed and being released');
				$(card).attr('data-stage','signed');
				notifyAll(shipment,'signed for release');
			},
			release: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).addClass('ship_complete');
				$(card).find('.fa-truck').removeClass('text-muted');
				$(card).find('.fa-truck').addClass('text-success');
				$(card).find('.card-subtitle').html('Released');
				$(card).attr('data-stage','ship_complete');
				notifyAll(shipment,'released by security');
			},
			ship_complete: function(shipment){
				notifyAll(shipment,'805d');
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).remove();
				updateCounts();
			},
			carrier_change: function(carrier){
				params = carrier.split('%');
				card = $('#shipment_list').find("div[data-shipment="+params[0]+"]");
				$(card).find('td.carrier').html(params[1]);
				notifyAll(shipment,'changed carrier to');
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
				$('.cancel[data-shipment="'+shipment+'"]:visible').click();
				updateCounts();
			},
			prioritize: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.card').addClass('bg-primary');
				$(card).addClass('priority');
				updateFilter();
				notifyAll(shipment,'prioritized');
			},
			normalize: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).find('.card').removeClass('bg-primary');
				$(card).removeClass('priority');
				updateFilter();
			},
			reset: function(shipment){
				card = $('#shipment_list').find("div[data-shipment="+shipment+"]");
				$(card).removeClass('.verification,.verification_pass2,.verified,.loading,.signed,.ship_complete');
				$(card).find('.fa-clipboard-list').removeClass('^=text').addClass('text-muted');
				$(card).find('.fa-pallet').removeClass('^=text').addClass('text-muted');
				$(card).find('.fa-truck-loading').removeClass('^=text').addClass('text-muted');
				$(card).find('.fa-clipboard-check').removeClass('^=text').addClass('text-muted');
				$(card).find('.fa-truck').removeClass('^=text').addClass('text-muted');
				$(card).attr('data-stage','waiting');
				$(card).find('.card-subtitle').html('Not Started');
				updateCounts();
			},
			user_reset: function(user_id){
				if(app_user == user_id){
					window.location.reload();
				}
			},
			changelog: function(){
				$('a[href="#change_log"]').click();
			},
			announce: function(msg){
				$('#announce').html(msg);
				notif_announce.play();
				responsiveVoice.speak(msg);
				$('#announcement').fadeIn('slower');
				setTimeout(function(){
					$('#announcement').fadeOut('slower');
				},10000);
			}
	};

	$(document).ready(function(){
		app_name = '<?= $method = $this->router->fetch_method(); ?>';
		app_user = '<?= $this->session->userdata('user_id'); ?>';

		//$('.sync').click();

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
			                	data = {
										'shipment' : shipment,
										'stage' : 1,
										'type' : 'start'
									}
								notifyAll(shipment,'reset');
								updateShipment(data);
		                		socket.emit('command','/do-argus-reset-'+shipment);
		                		break;
		                	case 'lock':
		                		shipLock(shipment,1);
		                		socket.emit('command','/do-argus-lock-'+shipment);
		                		break;
		                	case 'unlock':
		                		shipLock(shipment,0);
		                		socket.emit('command','/do-argus-unlock-'+shipment);
		                		break;
		                	case 'details':
		                		showShipmentDetails(shipment);
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

		$.notify.addStyle('globalnotif', {
		  html: 
		    "<div>" +
		      "<div class='clearfix alert alert-info shadow mb-0'>" +
		        "<h6 class='mb-0' data-notify-text/>" +
		        "<center><small><i>Argus Alert</i></small></center>"+
		      "</div>" +
		    "</div>"
		});

		$.notify.addStyle('globalerror', {
		  html: 
		    "<div>" +
		      "<div class='clearfix alert alert-danger shadow mb-0'>" +
		        "<span class='w-100' data-notify-text/>" +
		      "</div>" +
		    "</div>"
		});

		$.notify.defaults({
			autoHideDelay: 5000,
			globalPosition: 'top left',
			style: 'globalnotif'
		});

		updateCounts();
	});

	$(document).on('click','.shipment_item',function(){
		stage = $(this).attr('data-stage');
		shipment = $(this).data('shipment').toString();
		shipment_type = shipment.substr(0,2);
		$('.shipment').html(shipment);
		$('.shipment_val').val(shipment);
		$('.cancel').attr('data-shipment',shipment);

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
		shipLock(shipment,0);
	});

	$(document).on('click','.filter',function(){
		filter = [];
		filter2 = [];
		state = $(this).hasClass('on');
		e_class = ($(this).is('button') ? 'btn-success' : 'text-success');

		$('.sment').removeClass('d-none');

		if(!state){
			$(this).removeClass('off').addClass('on');
			$(this).addClass(e_class);
		}else{
			$(this).removeClass('on').addClass('off');
			$(this).removeClass(e_class);
		}

		$('.filter.on').each(function(k,v){
			is_button = $(v).is('button');
			if(is_button){
				filter.push($(v).attr('data-filter'));
			}else{
				filter2.push($(v).attr('data-filter'));	
			}
		});
		
		updateFilter($(this).is('button'));
	});

	$(document).on('click','#search_shipment',function(){
		$(this).quicksearch('div.shipment_cards div[data-shipment]');
	});

	$('#return_to_argus').click(function(){
		$('a[href="#shipment_list"').click();
	});

	$('.sync').click(function(){
		templater('syncShipments','.shipment_cards',null,true,true);
		sCheck = setInterval(shipmentCheck,1000);
	});

	$('.refresh').click(function(){
		//announce('Argus is refreshing. Please wait');
		socket.emit('command','/refresh-argus');
	});

	$('.changelog').click(function(){
		$('a[href="#change_log"]').click();
	});

	$('.send_announcement').click(function(){
		announcement = $('textarea[name="announcement_text"]').val();

		if(announcement.length){
			announce(announcement);
			$('#announcement_modal').modal('hide');
		}else{
			$('textarea[name="announcement_text"]').notify('Required',{style:'globalerror'});
		}
	});

	socket.on('notify',function(app,msg){
		if(app == app_name){
			notif.play();
			$.notify(msg);
		}
	});

	function shipmentCheck()
	{
		var shipment = $('.shipment_cards').find('.sment');

		if(shipment.length){
			updateCounts();
			clearInterval(sCheck);
		};
	}

	function updateFilter(multi=false)
	{
		if($(filter2).length){
			$('.sment').addClass('d-none');

			if(filter2.length > 1){
				$(filter2).each(function(a,b){
					$('.sment.'+b).removeClass('d-none');
				});
			}else{
				$('.sment.'+filter2[0]).removeClass('d-none');
			}
		}

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
		//shipments = document.getElementByClassName("sment");
		//counters = document.getElementByClassName("counters");
		//counters = $('.counters');

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
		url = '<?= site_url('argus/updateShipment'); ?>';
		shipment = data.shipment;
		stage = data.stage;
		type = data.type;
		button_id = '#'+data.button_id;
		
		$.ajax({
			type : 'POST',
			url : url,
			dataType : 'json',
			data : { shipment : shipment, stage : stage, type : type },
			beforeSend : function(){
				startSubmit(button_id);
			},
			success : function(res){
				//console.log(res);
			},
			complete : function(){
				endSubmit(button_id);	
			},
			error: function(){
				endSubmit(button_id);	
			}
		});
	}

	function shipLock(shipment,lock)
	{
		url = '<?= site_url('argus/updateShipmentLock'); ?>';
		
		$.ajax({
			type : 'POST',
			url : url,
			dataType : 'json',
			data : { shipment : shipment, lock : lock},
			success : function(res){
				//console.log(res);
			}
		});
	}

	function showShipmentDetails(shipment)
	{
		url = '<?= site_url('argus/getDetails'); ?>';
		post = shipment;

		$.ajax({
			type : 'POST',
			url : url,
			dataType : 'json',
			data : { post : post },
			beforeSend : function(){
				$('#ship_details').html(loading);
			},
			success : function(view){
				if(view == false){
					$('#ship_details').html('Shipment have been 805');
					force805(shipment);
				}else{
					$('#ship_details').html(view);
				}
			},
			complete : function(){
				$('#details').modal('show');		
			}
		})
	}

	function notifyAll(shipment,stage)
	{
		var msg = 'Shipment '+shipment+' has been '+stage+' by '+curr_user.fname+' '+curr_user.lname;
		socket.emit('notify','argus-'+msg);
	}

	function announce(msg)
	{

		socket.emit('command','/do-argus-announce-'+msg);
	}

	function force805(shipment)
	{
		url = '<?= site_url('argus/check805/'); ?>'+shipment;

		$.ajax({
			type : 'GET',
			url : url,
			complete : function(){
				socket.emit('command','/do-argus-ship_complete-'+shipment);
			}
		});
	}
</script>