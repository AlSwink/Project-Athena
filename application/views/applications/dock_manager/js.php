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
				{ data: "dock" },
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
		        		if(row.modified_by){
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
   				dock_id = $(dock).html();
        		return {
        			callback: function(key, options,e){
		                switch(key){
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

        $('.queue_range').daterangepicker({
		    timePicker: true,
		    startDate: moment().startOf('hour'),
		    endDate: moment().startOf('hour').add(1, 'hour'),
		    opens: 'center',
		    locale: {
		      format: 'M/DD/2018 hh:mm:ss A'
		    }
		},setRange);
	});

	function getDockQueue(dock_id){
		$('#set_queue').modal('show');		                		
		$('input[name="dock_id_queue"]').val(dock_id);

		
	}

	function setRange(start, end) {
        $('input[name="from"]').val(start.format('YYYY-MM-DD H:mm:ss'));
        $('input[name="to"]').val(end.format('YYYY-MM-DD H:mm:ss'));
    }
</script>