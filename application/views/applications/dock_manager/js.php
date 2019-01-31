<script>
	var dtable = $('#dock_table').DataTable({
			dom : '<"row"<"col"t>><"row"<"col"iBp>>',
			pagingType : 'numbers',
			info : true,
			colReorder: true,
			responsive: true,
			buttons: [
		        {
		            text: 'Excel',
		            extend: 'excel',
		            className: 'dl_excel d-none'
		        },
		        {
		            text: 'Print',
		            extend: 'print',
		            className: 'tprint d-none'
		        }
	        ],
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
				{ data: "category" },
		        { data: "bldg_name" },
		        { data: "expecting",
		        	render: function(data,type,row,neta){
		        		return ($(row.detail).length ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>');
		        	}
		        },
		        { data: "note" },
		        { data: "last_modify",
		        	render: function(data,type,row,meta){
		        		if($(row.detail).length){
		        			return row.e_fname+' '+row.e_lname;
		        		}else{
		        			return null;
		        		}
		        	}
		        }
			],
		    scrollY: '80vh',
		    order : [4,'asc'],
		    scroller: {
		    	loadingIndicator : true
		    },
		    "createdRow":function(row,data,index){
		    	$(row).addClass('dock_menu');
		    	if(data.status == 1){
		    		$(row).addClass('table-danger');
		    	}
		    	
		    	if(data.note){
		    		$(row).addClass('table-warning');	
		    	}
		    }
		});

	$(document).ready(function(){
		$.contextMenu({
        	selector: '.dock_menu',
        	build: function($triggerElement,e){
   				dock = $($triggerElement[0]).find('td')[0];
   				dock_id = $(dock).find('input').val();
   				
        		return {
        			callback: function(key, options,e){
		                switch(key){
		                	case 'edit':
		                		getDockInfo(dock_id);
		                		break;
		                	case 'queue':
		                		getDockQueue(dock_id);
		                		break;
		                }
        			},
        			items: {
        				details: {name:"Details",icon:"fas fa-info"},
        				edit: {name:"Edit Dock",icon:"fas fa-edit text-warning"},
        				queue: {name:"Set a queue",icon:"fas fa-stream"}
        			}
        		}
        	}
        });

        start = moment().startOf('hour');
	    end = moment().startOf('hour').add(1, 'hour');

        $('.queue_range').daterangepicker({
		    timePicker: true,
		    startDate: moment().startOf('hour'),
		    endDate: moment().startOf('hour').add(1, 'hour'),
		    opens: 'center',
		    locale: {
		      format: 'M/DD/YYYY hh:mm:ss A'
		    }
		},setRange(start,end));

		$.notify.addStyle('globalnotif', {
		  html: 
		    "<div>" +
		      "<div class='clearfix alert alert-info shadow mb-0'>" +
		        "<h6 class='mb-0' data-notify-text/>" +
		        "<center><small><i>Dock Manager Alert</i></small></center>"+
		      "</div>" +
		    "</div>"
		});

		$.notify.addStyle('globalerror', {
		  html: 
		    "<div class='w-100'>" +
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
	});

	$('#add_queue').click(function(){
		addDockQueue();
	});

	$('#save_edit_dock').click(function(){
		saveDockInfo();
	});

	$('#add_dock_btn').click(function(){
		addDock();
	});	

	function getDockQueue(dock_id){
		url = "<?= site_url('dock_manager/getDockQueue/'); ?>"+dock_id;
		$('#set_queue').modal('show');		                		
		$('input[name="dock_id_queue"]').val(dock_id);

		$.ajax({
			type : 'GET',
			url : url,
			success : function(res){
				$('#current_queue').html(res);
			}
		})
	}

	function getDockInfo(dock_id){
		url = "<?= site_url('dock_manager/getDockInfo/'); ?>"+dock_id;

		$.ajax({
			type : 'GET',
			url : url,
			dataType : 'json',
			success : function(res){
				$('input[name="dock_id"]').val(res.dock_id);
				$('input[name="note"]').val(res.note);

				$('select[name="building_id"] option').prop('selected',false);
				$('select[name="status"] option').prop('selected',false);

				$('select[name="building_id"] option[value="'+res.bldg_id+'"]').prop('selected',true);
				$('select[name="status"] option[value="'+res.status+'"]').prop('selected',true);
				
			},
			complete: function(){
				$('#edit_dock').modal('show');
			}
		})
	}

	function setRange(start, end) {
        $('input[name="from"]').val(start.format('YYYY-MM-DD H:mm:ss'));
        $('input[name="to"]').val(end.format('YYYY-MM-DD H:mm:ss'));
    }

    function addDockQueue()
    {
    	dock_id = $('input[name="dock_id_queue"]').val();
    	url = '<?= site_url('dock_manager/add_dock_queue'); ?>';
    	post = $('#add_queue_form').serialize();
    	
    	$.ajax({
    		type: 'POST',
    		url: url,
    		dataType: 'json',
    		data: { post : post },
    		beforeSend: function(){
    			startSubmit('#add_queue');
    		},
    		success: function(res){
    			updateDocks();
    			msg = 'New Carrier Queue has been added';
    			socket.emit('notify','global-'+msg);
    			socket.emit('command','/do-yard_manager-update');
    		},
    		complete: function(){
    			endSubmit('#add_queue');
    			getDockQueue(dock_id,false);
    		}
    	});
    }

    function saveDockInfo()
    {
    	url = '<?= site_url('dock_manager/save_dock_info'); ?>';
    	post = $('#edit_dock_form').serialize();

    	$.ajax({
    		type: 'POST',
    		url: url,
    		dataType: 'json',
    		data: { post : post },
    		beforeSend: function(){
    			startSubmit('#save_edit_dock');
    		},
    		success: function(res){
    			updateDocks();
    			status = (res.status == 1 ? 'Occupied' : 'Vacant');
    			msg = 'Dock #'+res.dock+' is now '+status+'';
    			socket.emit('notify','global-'+msg);
    			socket.emit('command','/do-yard_manager-update');
    		},
    		complete: function(){
    			endSubmit('#save_edit_dock');
    		}
    	})
    }

    function updateDocks()
    {
    	dtable.ajax.reload();
    }

    function addDock()
    {
    	url = '<?= site_url('dock_manager/add_dock'); ?>';
    	post = $('#add_dock_form').serialize();
    	type = $('select[name="add_dock_type"]').val();
    	num = $('input[name="add_dock_number"]').val();

    	if($('input[name="add_dock_number"]').val()){

    		check = checkDockNumber(type,num);
    		console.log(check);
    		if(check){
		    	$.ajax({
		    		type: 'POST',
		    		url: url,
		    		dataType: 'json',
		    		data: { post : post },
		    		beforeSend: function(){
		    			startSubmit('#add_dock_btn');
		    		},
		    		success: function(res){
		    			updateDocks();
		    			socket.emit('command','/do-yard_manager-update');
		    		},
		    		complete: function(){
		    			endSubmit('#add_dock_btn');
		    		}
		    	});
		    }
	    }else{
	    	$('input[name="add_dock_number"]').notify('Required',{style:'globalerror'});
	    }
    }

    function checkDockNumber(type,num)
    {
    	url = "<?= site_url('dock_manager/checkDoorExist/'); ?>"+num;

    	if(type == 'Placeholder' && !isNaN(num)){
    		$.notify('Please use non-numeric for placeholder docks',{style:'globalerror',position:'top-center'});
    		return false;
    	}else{
    		$.ajax({
    			type: 'GET',
    			url: url,
    			dataType: 'json',
    			success: function(res){
    				if(res.length > 0){
    					$.notify('Duplicate Door Number',{style:'globalerror',position:'top-center'});
    					return false;
    				}else{
    					return true;
    				}
    			}
    		})
    	}
    }

    socket.on('notify',function(app,msg){
		if(app == app_name || app == 'global'){
			notif.play();
			$.notify(msg);
		}
	});
</script>