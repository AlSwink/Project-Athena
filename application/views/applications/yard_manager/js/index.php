<script>
	var carrier;
	var trailer;
	var dock;
	var pickup;
	var carrier_logo_dir = '<?= base_url('assets/img/carrier_logos/'); ?>';
	var yard_manager = {
				update : function(){
							docks.ajax.reload();
						}
			}

	var docks = $('#dock_select_table').DataTable({
			dom : '<"row"<"col"t>><"row"<"col"ip>>',
			pagingType : 'numbers',
			info : true,
			colReorder: true,
			responsive: true,
			ajax: {
				url: '<?= site_url("api/getDockDoors"); ?>',
        		dataSrc: ''
			},
			columns : [
				{ data: "dock", 
					render: function(data,type,row,meta){
						return row.dock+'<input type="hidden" name="dock_id[]" value="'+row.dock_id+'"/>';
					}
				},
		        { data: "status",
		        	render: function(data,type,row,meta){
		        		return (row.status == 1 ? 'Occupied' : 'Vacant');
		        	}
		        },
		        { data: "note" }
			],
		    scrollY: '60vh',
		    order : [1,'desc'],
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'single'
		    },
		    "createdRow":function(row,data,index){
		    	if(data.status == 1){
		    		$(row).addClass('table-danger');
		    	}
		    }
		});

	$(document).ready(function(){
		$.notify.defaults({
			autoHideDelay: 5000,
			globalPosition: 'top center'
		});
	});

	$('select[name="carrier"]').change(function(){
		file = $(this).children('option:selected').data('img');
		logo = carrier_logo_dir+file;
		$('#carrier_logo').attr('src',logo);
	});

	$('#step1_submit').click(function(){
		url = "<?= site_url('argus/getMatchingDocks');?>";
		post = $('#step1_form').serialize();
		trailer = $('input[name="trailer_number"]').val();

		if(trailer.length){
			$.ajax({
				type: 'POST',
				url: url,
				dataType: 'json',
				data: { post : post },
				success: function(res){
					$('#suggestions').html(res);
				},
				complete: function(){
					$('a[href="#tab2"]').click();
					docks.ajax.reload();
					docks.columns.adjust();
				}	
			});
		}else{
			$('input[name="trailer_number"]').notify('Trailer number is required');
		}
	});

	$('.start_over').click(function(){
		window.location.reload();
	});

	$('.complete_transaction').click(function(){
		url = "<?= site_url('yard_manager/transaction_save');?>";
		selected = docks.rows({selected:true}).data().pluck('dock_id')[0];
		$('input[name="update_dock_id"]').val(selected);
		post = $('#step1_form').serialize();
		
		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'json',
			data: { post : post },
			beforeSend: function(){
				startSubmit('.complete_transaction');
			},
			success: function(res){
				$('.start_over').click();

			},
			complete: function(){
				endSubmit('.complete_transaction');
			}
		})

	});

	docks.on('select deselect',function(e,dt,type,indexes){
		if(docks.rows({selected:true}).data().length){
			$('.complete_transaction').prop('disabled',false);
		}else{
			$('.complete_transaction').prop('disabled',true);
		}
	});

	function clear_vars()
	{
		carrier = '';
		trailer  = '';
		dock  = '';
		pickup  = '';
	}

	socket.on('notify',function(app,msg){
		if(app == app_name || app == 'global'){
			notif.play();
			$.notify(msg);
		}
	});
</script>