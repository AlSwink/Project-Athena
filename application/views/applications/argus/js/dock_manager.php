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
				{ data: "category" },
		        { data: "bldg_name" },
		        { data: "expecting",
		        	render: function(data,type,row,neta){
		        		return 'Y';
		        	}
		        },
		        { data: "status",
		        	render: function(data,type,row,meta){
		        		return (row.status == 1 ? 'Occupied' : 'Vacant');
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
		    select: {
		    	style : 'multi+shift'
		    },
		    "createdRow":function(row,data,index){
		    	$(row).addClass('dock_menu');
		    }
		});

	$(document).ready(function(){
		$.contextMenu({
        	selector: '.dock_menu',
        	build: function($triggerElement,e){
   				dock_id = $($triggerElement[0]).find('td')[0];
        		return {
        			callback: function(key, options,e){
		                switch(key){
		                	case 'reprint':
		                		if($(assigned_on).html()){
		                			search_assignment(assignment_id);
		                		}
		                		break;
		                	case 'see_assignment':
		                		$('#assignment_id').val(assignment_id);
		                		$('#search_assignment').trigger('click');
		                		$('a[href="#swi_input"]').trigger('click');
		                		break;
		                	case 'reassign':
		                		$('input[name="doc_search"]').val(doc_number);
		                		$('input[name="doc_search"]').trigger('keyup');
		                		$('#assign_doc_table').DataTable().row(':eq(0)',{ page: 'current' }).select();
		                		$('input[name="reassignment_id"]').val(assignment_id);
		                		$('input[name="assoc_search"]').val('');
		                		aetable.search('').draw();
		                		$('#assign_swi_document').modal('show');
		                		break;
		                	case 'reset':
		                		$('input[name="confirm_assignment_id"]').val(assignment_id);
		                		$('#confirm_action').find('form').attr('action','<?= site_url('swi/reset_assignment'); ?>');
		                		$('#confirm_action_label').html('<b>Reset</b>');
		                		$('#confirm_action').modal('show');
		                		break;
		                	case 'unassign':
		                		$('#confirm_action').find('form').attr('action','<?= site_url('swi/unassign'); ?>/'+assignment_id);
		                		$('#confirm_action_label').html('<b>Unassign</b>');
		                		$('#confirm_action').modal('show');
		                		break;
		                	case 'delete':
		                		$('#confirm_action').find('form').attr('action','<?= site_url('swi/delete_assignment'); ?>/'+assignment_id);
		                		$('#confirm_action_label').html('<b>Delete</b>');
		                		$('#confirm_action').modal('show');
		                		break;
		                	case 'override':
		                		override_assignment(assignment_id);
		                		$('#override_assignment').modal('show');
		                		break;
		                }		

        			},
        			items: {
        				assignment: {name:doc_number,icon:"fas fa-info",disabled:true},
        				reprint: {name:"Reprint Assignment",icon:"fas fa-print"},
        				reassign: {name:"Reassign Document",icon:"fas fa-random"},
        				reset: {name:"Reset Assignment",icon:"fas fa-undo"},
        				see_assignment: {name:"See Assignment",icon:"fas fa-clipboard-list"},
        				"sep1": "---------",
        				override: {name:"Override Assignment",icon:"fas fa-edit text-warning"},
        				unassign: {name:"Unassign",icon:"fas fa-eraser"},
        				delete: {name:"Delete Assignment",icon:"fas fa-trash-alt text-danger"}
        			}
        		}
        	}
        });
	});
</script>