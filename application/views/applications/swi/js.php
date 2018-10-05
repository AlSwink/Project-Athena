<script>
	<?php if(!$this->standalone){ ?>
		loadDependencies(<?= json_encode($dependencies);?>);
	<?php } ?>
	var swi = {
				update: function(){
					update_dashboard(true);
				}
			}

	var totals = {
					'completed' : <?= $totals['completed']; ?>,
					'pending'	: <?= $totals['pending']; ?>,
					'standard_met' : <?= $totals['standard_met']; ?>,
					'deprecation' : <?= $totals['deprecation']; ?>,
					'reported'	: <?= $totals['reported']; ?>,
					'pending'	: <?= $totals['pending']; ?>,
					'documents'	: <?= $totals['documents']; ?>
				}; //chart initial data
	var month_dataset = '<?= date('m'); ?>';
	var year_dataset = '<?= date('Y'); ?>';
	var last_doc = '';
	var new_process_line = '';
	var edit_process_line = '';
	var tooltip = '';
	var autocomplete_field = 'input.process';
	var autocomplete_options = {
		classes : { "ui-autocomplete": "highlight" },
		source: <?= create_autocomplete_source($processes,'principle_id','process'); ?>
	}

	var days_prog = $("#days_prog");
	var doc_prog = $("#doc_prog");
	var in_standard = $("#standard_acc");

	//charts
	var c_days_prog = new Chart(days_prog,{
				type : 'doughnut',
				data : {
					labels : ['Days passed','Days left'],
					datasets : [{
						data : [
							<?= (int)date('j'); ?>,
							<?= (int)date('t') - (int)date('j'); ?>
						],
						backgroundColor : [
							'rgba(50, 50,50, 1)',
							'rgba(196,159,78,1)'
						]
	                }]
				},
				options: {
					title : {
						display: true,
						text: 'Days to go'
					},
					cutoutPercentage : 60,
					legend:{
						position: 'bottom',
						labels: {
							boxWidth: 11
						}
					}
				}
		});

	var c_doc_prog = new Chart(doc_prog,{
				type : 'doughnut',
				data : {
					labels : ['Completed','Pending'],
					datasets : [{
						data : [
							totals.completed,
							totals.pending
						],
						backgroundColor : [
							'rgba(4, 173, 41,1)',
							'rgba(50, 50,50, 1)'
						]
	                }]
				},
				options: {
					title : {
						display: true,
						text: 'Document Progress'
					},
					cutoutPercentage : 60,
					legend:{
						position: 'bottom',
						labels: {
							boxWidth: 11
						}
					}
				}
		});

	var c_in_standard = new Chart(in_standard,{
				type : 'doughnut',
				data : {
					labels : ['Met','Deprecation','Reported','Pending'],
					datasets : [{
						data : [
							totals.standard_met,
							totals.deprecation,
							totals.reported,
							totals.pending
						],
						backgroundColor : [
							'rgba(4, 173, 41,1)',
							'rgba(222, 226, 230,1)',
							'rgba(123,21,36,1)',
							'rgba(50, 50,50, 1)'
						]
	                }]
				},
				options: {
					title : {
						display: true,
						text: 'Standard Met Rate'
					},
					cutoutPercentage : 60,
					legend:{
						position: 'bottom',
						labels: {
							boxWidth: 11
						}
					}
				}
		});

	Chart.pluginService.register({
	  beforeDraw: function(chart) {
	    var width = chart.chart.width,
	        height = chart.chart.height,
	        ctx = chart.chart.ctx,
	        cid = $(chart.chart.canvas).attr('id');

	    ctx.restore();
	    var fontSize = (height / 114).toFixed(2);
	    ctx.font = fontSize + "em sans-serif";
	    ctx.textBaseline = "middle";

	    if(cid == 'doc_prog'){
	    	total = chart.data.datasets[0].data[0] + chart.data.datasets[0].data[1];
	    	doughnut_text = Math.ceil(chart.data.datasets[0].data[0] / total * 100) + '%';
	   	}else if(cid == 'standard_acc'){
	   		standard_met = (chart.data.datasets[0].data[0] ? chart.data.datasets[0].data[0] : 0);
	   		deprecation = (chart.data.datasets[0].data[1] ? chart.data.datasets[0].data[1] : 0);
	   		reported = (chart.data.datasets[0].data[2] ? chart.data.datasets[0].data[2] : 0);
	   		pending = (chart.data.datasets[0].data[3] ? chart.data.datasets[0].data[3] : 0);
	   		total = standard_met + deprecation + reported + pending;
	   		if(standard_met){
	   			doughnut_text = Math.ceil(standard_met / total * 100) + '%';
	   		}else{
	   			doughnut_text = '0%';
	   		}
	   	}else if(cid == 'days_prog'){
	   		doughnut_text = chart.data.datasets[0].data[1];
	   	}

	    var text = doughnut_text,
	        textX = Math.round((width - ctx.measureText(text).width) / 2),
	        textY = height / 2;

	    ctx.fillText(text, textX, textY);
	    ctx.save();
	  }
	});

	//data tables
	var astable = $('#assign_doc_table').DataTable({
			dom : '<"row"<"col"t>>',
			ordering: true,
			pagingType : 'numbers',
			responsive: false,
			ajax: {
				url: '<?= site_url("api/swi_get_document"); ?>',
				dataSrc: ''
			},
			columns : [
				{ data: "doc_number" },
		        { data: "doc_name" },
		        { data: "department" }
			],
		    scrollY:        '40vh',
		    deferRender:    false,
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'single'
		    }
		});

	var aetable = $('.assign_emp_table').DataTable({
			dom : '<"row"<"col"t>>',
			ordering: true,
			pagingType : 'numbers',
			responsive: false,
			ajax: {
				url: '<?= site_url("api/get_swi_employees"); ?>',
				dataSrc: ''
			},
			columns : [
				{ data: "name" },
				{ data: "department" }
			],
		    scrollY:        '40vh',
		    deferRender:    false,
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'single'
		    }
		});

	var dtable = $('.dtable').DataTable({
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
				url: '<?= site_url("api/swi_get_document"); ?>',
        		dataSrc: ''
			},
			columns : [
				{ data: "doc_number" },
		        { data: "doc_name" },
		        { data: "department" },
		        { data: "processes" }
			],
		    scrollY:        '60vh',
		    order : [3,'asc'],
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'multi+shift'
		    }
		});

	var etable = $('.etable').DataTable({
			dom : '<"row"<"col"t>><"row"<"col"iBp>>',
			pagingType : 'numbers',
			info : true,
			colReorder: true,
			responsive: true,
			buttons: [
		        {
		            text: 'Excel',
		            extend: 'excel',
		            className: 'dle_excel d-none'
		        },
		        {
		            text: 'Print',
		            extend: 'print',
		            className: 'teprint d-none'
		        }
	        ],
			ajax: {
				url: '<?= site_url("api/get_swi_employees"); ?>',
        		dataSrc: ''
			},
			columns : [
				{ data: "name" },
		        { data: "assigned" },
		        { data: "department" },
		        { data: "status" }
			],
		    scrollY:        '60vh',
		    deferRender:    true,
		    scroller: {
		    	loadingIndicator : true
		    },
		    order : [3,'desc'],
		    "createdRow" : function(row,data,index){
		    	if(data['status'] == 'In-Progress'){
		    		$(row).addClass('table-warning');
		    	}
		    }
		});

	var rdtable = $('#report_document_table').DataTable({
			dom : '<"row"<"col"t>><"row"<"col"iBp>>',
			info : true,
			colReorder: true,
			buttons: [
		        {
		            text: 'Excel',
		            extend: 'excel',
		            className: 'rdexcel d-none'
		        },
		        {
		            text: 'Print',
		            extend: 'print',
		            className: 'rdprint d-none'
		        }
	        ],
			ajax: {
				url: '<?= site_url("api/get_document_report"); ?>',
				dataSrc: ''
			},
			columns : [
				{ data: "assignment_id" },
				{ data: "doc_number" },
		        { data: "doc_name" },
		        { data: "department" },
		        { data: "result",
		        	render: function(data,type,row,meta){
		        		switch(row.result){
		        			case '1':
		        				return 'Reported';
		        				break;
		        			case '0':
		        				return 'Standard Met';
		        				break;
		        			case '2':
		        				return 'Unassigned';
		        				break;
		        			case '3':
		        				return 'Deprecation';
		        				break;
		        			default:
		        				return 'Pending';
		        				break;
		        		}
		        	} 
		        },
		        { data: "name",
		        	render: function(data,type,row,meta){
		        		if(data){
		        			html = "<span class='rdempdetails' data-empid='"+row.user_id+"'>"+data+"</span>";
		        		}else{
		        			html = data;
		        		}
		        		return html;
		        	}
		        },
		        { data: "assigned_on",
		        	render: function(data,type,row,meta){
		        		if(data){
		        			return moment(data).format('MM/DD/YY');
		        		}else{
		        			return data;
		        		}
		        	}
		        },
		        { data: "completed_on",
		        	render: function(data,type,row,meta){
		        		if(data){
		        			return moment(data).format('MM/DD/YY hh:mma');
		        		}else{
		        			return data;
		        		}
		        	}
		        }
			],
			responsive: true,
		    scrollY:        '50vh',
		    deferRender:    false,
		    scroller: {
		    	loadingIndicator : true
		    },
		    order : [4,'desc'],
		    "createdRow" : function(row,data,index){
		    	switch(data['result']){
        			case '1':
        				$(row).addClass('table-danger');
        				break;
        			case '0':
        				$(row).addClass('table-success');
        				break;
        			case '2':
        				$(row).addClass('table-info');
        				break;
        			case '3':
        				$(row).addClass('table-secondary');
        				break;
        			default:
        				$(row).addClass('table-warning');
        				break;
        		}

        		$(row).addClass('rdtablemenu');
		    }
		});

	var logtable = $('#log_table').DataTable({
			dom : '<"row"<"col"t>><"row"<"col"iBp>>',
			pagingType : 'numbers',
			info : true,
			responsive: true,
			buttons: [
		        {
		            text: 'Excel',
		            extend: 'excel',
		            className: 'log_excel d-none'
		        },
		        {
		            text: 'Print All',
		            extend: 'print',
		            className: 'log_print d-none'
		        }
	        ],
			ajax: {
				url: '<?= site_url("api/getLogs/swi_logs"); ?>',
        		dataSrc: ''
			},
			columns : [
				{ data: "log_id" },
				{ data: "action" },
				{ data: "for" },
		        { data: "reason" },
		        { data: "triggered_by",
		        	render: function(data,type,row,meta){
		        		return row.e_fname+' '+row.e_lname;
		        	}
		        },
		        { data: "executed_on",
		        	render: function(data,type,row,meta){
		        		return moment(data).format('MM/DD/YY hh:mma');
		        	}
		        }
			],
			order : [0,'desc'],
		    scrollY: '55vh',
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'multi+shift'
		    }
		});

	var rrtable = $('#reported_report').DataTable({
			dom : '<"row"<"col"t>><"row"<"col"iBp>>',
			pagingType : 'numbers',
			info : true,
			responsive: true,
			buttons: [
		        {
		            text: 'Excel',
		            extend: 'excel',
		            className: 'log_excel d-none'
		        },
		        {
		            text: 'Print All',
		            extend: 'print',
		            className: 'log_print d-none'
		        }
	        ],
			ajax: {
				url: '<?= site_url("api/getSWIReported"); ?>',
        		dataSrc: ''
			},
			columns : [
				{ data: "doc_number" },
				{ data: "doc_name" },
		        { data: "process" },
		        { data: "comments" },
		        { data: "correction_made" },
		        { data: "resolver" },
		        { data: "corrected_on",
		        	render: function(data,type,row,meta){
		        		if(data){
		        			return moment(data).format('MM/DD/YY hh:mma');
		        		}else{
		        			return null;
		        		}
		        	}
		        }
			],
		    scrollY: '55vh',
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'multi+shift'
		    },
		    "createdRow": function(row,data,index){
		    	if(data['status'] == 'resolved'){
		    		$(row).addClass('table-success');
		    	}else{
		    		$(row).addClass('table-danger');
		    	}
		    },
		    "drawCallback": function( settings ) {
		    	resolved = $('#reported_report').find('.table-success').length;
				$('.resolved_docs').html(resolved);
		    },
		    "initComplete":function(settings,json){
				resolved = $('#reported_report').find('.table-success').length;
				$('.resolved_docs').html(resolved);
		    }
		});

	dtable.on('select deselect',function(e,dt,type,indexes){
		if(dtable.rows({selected:true}).data().length){
			$('#delete,#edit').prop('disabled',false);
		}else{
			$('#delete,#edit').prop('disabled',true);
		}

		if(dtable.rows({selected:true}).data().length > 1){
			$('#edit').prop('disabled',true);	
		}
	});

	dtable.on('deselect',function(e,dt,type,indexes){	
		last_doc = dtable.rows(indexes).data();
	});

	aetable.on('select',function(e,dt,type,indexes){
		reassignto = aetable.rows(':visible',{selected:true}).data().pluck('user_id')[0];
		console.log(reassignto);
		$('input[name="reassign_to_emp_id"]').val(reassignto);
	});

	astable.on('select',function(e,dt,type,indexes){
		doc_id = astable.rows(indexes).data().pluck('doc_id')[0];
		$('input[name="assign_doc_id"]').val(doc_id);
	});

	//functions
	function form_submit(target,is_edit=false){
		url = $(target).attr('action');
		post = $(target).serialize();

		$.ajax({
			type : 'POST',
			url : url,
			dataType : 'json',
			data : post,
			beforeSend : function(){
				startSubmit('.form_submit');
			},
			success : function(res){
				autocomplete_options.source = res;
				$(target+' input[name="doc_num"]').val('');
				$(target+' input[name="doc_name"]').val('');
				endSubmit('.form_submit');
				$('.dtable').DataTable().ajax.reload();
			}
		});

		clear_validation();
	}

	function update_dashboard(from_socket=false)
	{
		doc_report_url = '<?= site_url("api/get_document_report"); ?>/'+year_dataset+'/'+month_dataset;
		rdtable.ajax.url(doc_report_url).load();

		$.ajax({
			type : 'POST',
			url : '<?= site_url('api/get_dashboard_chart'); ?>',
			dataType : 'json',
			data : { year : year_dataset, month : month_dataset },
			success : function(res){
				// chart update
				c_days_prog.data.datasets[0].data[0] = res.days_total - res.days_left;
				c_days_prog.data.datasets[0].data[1] = res.days_left;

				c_doc_prog.data.datasets[0].data[0] = res.completed;
				c_doc_prog.data.datasets[0].data[1] = res.pending;
				
				c_in_standard.data.datasets[0].data[0] = res.standard_met;
				c_in_standard.data.datasets[0].data[1] = res.deprecation;
				c_in_standard.data.datasets[0].data[2] = res.reported;
				c_in_standard.data.datasets[0].data[3] = res.pending;
				
				$('.my-display').html(res.month+ ' '+res.year);
				$('#rd_completed').html(res.completed);
				$('#rd_pending').html(res.pending);
				$('#rd_standard').html(res.standard_met);
				$('#rd_deprecation').html(res.deprecation);
				$('.rd_reported').html(res.reported);
				$('#rd_unassigned').html(res.unassigned);
				$('.u_limit').html(' /'+res.documents);

				
				$('.dashrow').each(function(k,v){
					dept = $(v).data('dept');
					dept_data = res.departments[dept];
					progress_bar = $(this).find('.progress-bar');
					if(dept_data){
						$(progress_bar).css('width',dept_data.progress);
						$(progress_bar).removeClass();
						$(progress_bar).addClass('progress-bar bg-'+dept_data.color);
						$(progress_bar).html(dept_data.progress);
					}else{
						$(progress_bar).css('width','0%');
					}
				});

				recents_row = '';

				$(res.recents).each(function(a,b){
					recents_row += '<tr class="table-'+b.color+' rdtablemenu">';
					recents_row += '<td class="d-none">'+b.assignment_id+'</td>';
					recents_row += '<td>'+b.doc_id+'</td>';
					recents_row += '<td>'+b.doc_name+'</td>';
					recents_row += '<td>'+b.department+'</td>';
					recents_row += '<td>'+b.status+'</td>';
					recents_row += '<td class="rdempdetails" data-empid="'+b.emp_id+'">'+b.completed_by+'</td>';
					recents_row += '<td>'+b.completed_on+'</td>';
					recents_row += '</tr>';
				});

				$('#recently_audited_table').html(recents_row);
			},
			complete : function(){
				c_days_prog.update();
				c_in_standard.update();
				c_doc_prog.update();
				//rdtable.ajax.reload();
				rrtable.ajax.reload();
			}
		});
		console.log(from_socket);
		if(!from_socket){
			socket.emit('command','/do-swi-update');
		}
	}

	function getEmployeeTooltip()
	{
		emp_id = $(this).data('empid');
		$.ajax({
			type: 'GET',
			url: '<?= site_url('swi/getEmployeeInfo'); ?>/'+emp_id,
			dataType: 'HTML',
			success: function(res){
				tooltip = res;
			}
		});
		return tooltip;
	}

	function override_assignment(assignment_id)
	{
		$.ajax({
			type: 'GET',
			url: '<?= site_url('api/get_swi_assignment'); ?>/'+assignment_id,
			dataType: 'json',
			success: function(res){
				assigned = (res.assigned_on ? moment(res.assigned_on).format('MM/DD/YYYY') : null);
				completed = (res.completed_on ? moment(res.completed_on).format('MM/DD/YYYY') : null);
				name = res.e_fname+' '+res.e_lname;
				$('input[name="doc_num"]').val(res.doc_number);
				$('input[name="doc_name"]').val(res.doc_name);
				$('input[name="assigned_on"]').val(assigned);
				$('input[name="completed_on"]').val(completed);
				$('input[name="assignment_id').val(assignment_id);

				$('input[name="assoc_search"]').val(name);
				$('input[name="assoc_search"]').trigger('keyup');
				aetable.rows(':visible').select();
			}
		});
	}

	//events

	$(document).ready(function(){
		app_name = '<?= $method = $this->router->fetch_method(); ?>';
		page_type = 'app';
		version = $('#app_version').html();

		$.contextMenu({
        	selector: '.rdtablemenu',
        	build: function($triggerElement,e){
   				assignment_field = $($triggerElement[0]).find('td')[0];
   				doc_number_field = $($triggerElement[0]).find('td')[1];
   				assigned_on = $($triggerElement[0]).find('td')[5];
   				assignment_id = $(assignment_field).html();
   				doc_number = $(doc_number_field).html();
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

        $.contextMenu({
        	selector: '.dept_progress',
        	build: function($triggerElement,e){
   				department = $($triggerElement);
   				dept_id = $(department).data('deptid');
        		return {
        			callback: function(key, options,e){
		                switch(key){
		                	case 'progress_board':
		                		pboardurl = "<?= site_url('swi/progress_board'); ?>/"+dept_id;
		                		window.open(pboardurl, 'Progress board');
		                		break;
		                }		
        			},
        			items: {
        				progress_board: {name:"Show progress board",icon:"fas fa-info"},
        			}
        		}
        	}
        });

		$('#report_document_table,#recently_audited_table').tooltip({
			selector: '.rdempdetails',
			title: getEmployeeTooltip,
			html: true,
			placement: 'left'
		});	

		new_process_line = $('#new_process').html();
		edit_process_line = $('#edit_process').html();
	});

	$(document).on('click','.add_process',function(){
		btn = $(this).parent().parent().html();
		$(this).parent().parent().remove();
		$('#process_table').append('<tr>'+new_process_line+'</tr><tr>'+btn+'</tr>');
		clear_validation();
	});

	$(document).on('click','.add_eprocess',function(){
		btn = $(this).parent().parent().html();
		
		$('#eprocess_table').append('<tr>'+edit_process_line+'</tr>');
		clear_validation();
	});

	$(document).on('click','.remove_process',function(){
		$(this).parent().parent().remove();
	});	

	$(document).on('keydown.autocomplete',autocomplete_field,function(){
		$(this).autocomplete(autocomplete_options);
	});

	$(document).on("autocompletefocus autocompleteselect",'.process',function( event, ui ) {
		event.preventDefault();
		principle_id = ui.item.value;

		$(this).val(ui.item.label);
		$(this).parent().siblings('td').find('select option:selected').prop('selected',false);
		$(this).parent().siblings('td').find('select option[value="'+principle_id+'"]').prop('selected',true);

	});

	$(document).on('dblclick','.dtable tbody td',function(){
		if(dtable.rows({selected:true}).data().length < 2){
			$('#edit').prop('disabled',false);
			$('#edit').click();
			$('#edit').prop('disabled',true);	
		}
	})

	$(document).on('keyup','.remove_process:last',function(e){
		var keyCode = e.keyCode || e.which;
		if (keyCode == 9) { 
			e.preventDefault(); 
		} 
	});

	$(document).on('click','.standard_select',function(){
		standard_value = $(this).data('value');
		
		var color = {
				'ok' : 'table-success',
				'bad' : 'table-danger',
				'na' : 'table-secondary'
				};

		$(this).parent().parent().parent().removeClass();
		$(this).parent().parent().parent().addClass(color[standard_value]);
		$(this).parent().children('.standard_select').removeClass('active');
		$(this).addClass('active');
		$(this).parent().siblings('input[name="standard[]"]').val(standard_value);


		if(standard_value != 'ok'){
			$(this).parent().parent().siblings('.comments').children('input').prop('required',true);
			$(this).parent().parent().siblings('.comments').children('input').prop('disabled',false);
		}else{
			$(this).parent().parent().siblings('.comments').children('input').val('');
			$(this).parent().parent().siblings('.comments').children('input').prop('required',false);
			$(this).parent().parent().siblings('.comments').children('input').prop('disabled',true);
		}
	});

	$(document).on('click','.raidlink',function(){
		assignment_id = $(this).data('id');
		$('#assignment_id').val(assignment_id);
		$('#search_assignment').trigger('click');
		$('a[href="#swi_input"]').trigger('click');
	});

	$('a[href="#swi_reports"],a[href="#swi_dash"]').click(function(){
		update_dashboard();
	})

	$('#assign_swi_document,#override_assignment').on('shown.bs.modal', function (e) {
		$.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
	});

	$('a[href="#assign_swi_document"]').click(function(){
		$('input[name="doc_search"]').val('');
		$('input[name="assoc_search"]').val('');
		aetable.rows().deselect();
		astable.rows().deselect();
		astable.search('').draw();
		aetable.search('').draw();
	});

	$('a[href="#report_document_reported"],a[href="#swi_resolution"]').click(function(){
		rrtable.ajax.reload();
		rtable.ajax.reload();
	});

	$('.document_report_filters').change(function(){
		var department = $('#department_filter option:selected').text();
		var status = $('#status_filter').val();
		department = (department == 'Show all' ? '' : department);
		
		rdtable.column([3]).search(department).draw();
		rdtable.column([4]).search(status).draw();
	});

	$('.reassign_submit').click(function(){
		submit_ready = true;
		post = $('#assign_doc').serialize();
		doc_selected = astable.rows({selected:true}).data().length;
		emp_selected = aetable.rows({selected:true}).data().length;
		if(!doc_selected || !emp_selected){
			submit_ready = false;
			$('#assign_doc_alert').html(createAlert('danger','Please select 1 from each column'));
		}

		if(submit_ready){
			url = $('#assign_doc').attr('action');
			$.ajax({
				type : 'POST',
				url : url,
				dataType : 'json',
				data : { post : post },
				beforeSend : function(){
					startSubmit('.reassign_submit');
				},
				success : function(res){
					console.log(res);
				},
				complete : function(){
					endSubmit('.reassign_submit');
					clear_validation();
					update_dashboard();
				}
			})
		}
	})

	$('.create_assignment').click(function(){
		$('input[name="assignment_type"]').val('create');
		$('.reassign_submit').trigger('click');
	});

	$('a[data-toggle="tab"],a[data-toggle="pill"]').on('shown.bs.tab', function(){
        $.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
    });

	$('#dl_excel').click(function(){
		$('.dl_excel').click();
	})

	$('#print').click(function(){
		$('.tprint').click();
	})

	$('#rdl_excel').click(function(){
		$('.rdexcel').click();
	});

	$('#rdl_table_reload').click(function(){
		rdtable.ajax.reload();
	});

	$('#rprint').click(function(){
		$('.rdprint').click();
	})

	$('#search_swi').keyup(function(){
		dtable.search( this.value ).draw();
	})

	$('#search_report_assignment').keyup(function(){
		rdtable.search( this.value ).draw();
	})

	$('input[name="doc_search"]').keyup(function(){
		astable.search(this.value).draw();
	})

	$('input[name="assoc_search"]').keyup(function(){
		aetable.search(this.value).draw();
	})

	$('#delete_docs').click(function(){
		to_delete = [];
		$(dtable.rows({selected:true}).data()).each(function(k,v,){
			to_delete.push(v.doc_id);
		});

		$.ajax({
			type : 'POST',
			url : '<?= site_url('swi/delete_document'); ?>',
			dataType : 'json',
			data : {docs : to_delete},
			success : function(res){
				$('.dtable').DataTable().ajax.reload();
				$('#search_swi').val('').trigger('keyup');
			}
		})
	})

	$('#edit').click(function(){
		form = '#edit_doc';
		doc = ($(dtable.rows({selected:true}).data()[0]).length ? dtable.rows({selected:true}).data()[0] : last_doc[0]);
		doc_id = doc.doc_id;
		$(form+' input[name="doc_id"]').val(doc_id);
		$(form+' input[name="doc_num"]').val(doc.doc_number);
		$(form+' input[name="doc_name"]').val(doc.doc_name);
		$(form+' select[name="dept"] option:contains("'+doc.department+'")').attr('selected','selected');

		if(doc_id){
			$.ajax({
				type : 'GET',
				url	: '<?= site_url('swi/get_document_process/'); ?>/'+doc_id,
				dataType : 'json',
				asyc : false,
				success : function(res){
					$('#eprocess_table').empty();
					$(res).each(function(k,v){
						
						$('#eprocess_table').prepend(function(){
								eline = $.parseHTML('<tr>'+edit_process_line+'</tr>');
								
								$(eline)
								.find('input[name="process[]"]')
								.val(v.process);

								$(eline)
								.find('input[name="process_id[]"]')
								.val(v.process_id);

								$(eline)
								.find('select option[value="'+v.principle_id+'"]')
								.attr('selected','selected');

								return (eline);							
							});
					});
				}
			})
		}
	});

	$('.form_submit').click(function(){
		clear_validation();

		submit_ready = true;
		is_edit = $(this).parent().siblings('.modal-body').find('form').find('input[name="doc_id"]').length;
		form = $(this).parent().siblings('.modal-body').find('form');
		form_id = '#'+$(form)[0].id;
		doc_num = $(form).find('input[name="doc_num"]').val().trim();
		doc_num_field = $(form).find('input[name="doc_num"]');
		process_list = $(form).find('.process');
		process_table = $(form).find('.process_table');

		//check required
		$(form_id+' .form-control').map(function(i,v){
			if(!$(v).val().length){
				$(this).addClass('is-invalid');
				$(this).parent().append(createInvalid('This field is required'));
				submit_ready = false;
			}
		});

		//check duplicate doc_number
		if(doc_num.length && !is_edit){
			$.ajax({
				type : 'GET',
				url	: '<?= site_url('swi/get_document/'); ?>doc_number/'+doc_num,
				dataType : 'json',
				success : function(res){
					if(res.length){
						submit_ready = false;
						$(doc_num_field).addClass('is-invalid');
						$(doc_num_field).parent().append(createInvalid('Document number already exist'));
					}
				}
			})
		}

		//check process
		if(!$(process_list).length){
			submit_ready = false;
			$(process_table).parent().parent().append(createAlert('danger','Please add at least 1 process for this document'));
		}

		if(submit_ready){
			form_submit(form_id,is_edit);
		}
	});

	$('#confirm_action_submit').click(function(){
		form =  $(this).parent().siblings('.modal-body').find('form');
		url = $(form).attr('action');
		id = $(form).find('input[name="confirm_assignment_id"]').val();
		
		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'json',
			data: { confirm_assignment_id : id },
			beforeSend: function(){
				startSubmit('#confirm_action_submit');
			},
			success: function(res){
				
			},
			complete: function(){
				endSubmit('#confirm_action_submit');
				$('#confirm_action').modal('hide');		
				update_dashboard();
			}
		});
	});

	$('#print_type').change(function(){
		selected = $(this).val();
		$('.subselection').addClass('d-none');
		switch(selected){
			case 'assignment_id':
				$('input[name="assignment_id"]').parent().removeClass('d-none');
				break;
			case 'dept_id':
				$('select[name="dept_id"]').parent().removeClass('d-none');
				break;
			case 'employee':
				$('select[name="user_id"]').parent().removeClass('d-none');
				break;
		}
	});

	$('#print_assignment').click(function(){
		form = $('#print_assignment_form');
		url = $(form).attr('action');
		post = $(form).find(':visible').serialize();
		
		$.ajax({
			type: 'POST',
			url: '<?= site_url('api/get_assigned_document'); ?>',
			dataType: 'json',
			data: { post : post },
			beforeSend : function(){
				$('.modal').modal('hide');
				$('body').append(<?php echo getFullLoading('Generating SWI Worksheets<br>Please wait'); ?>);
			},
			success : function(res){
				$('#assign_print').html(res);
			},
			complete : function(){
				$('#full-loader').remove();
				window.print();
				$('#assign_print').html('');
			}
		})
	})

	$('#assignment_printer').keydown(function(e){
		e.preventDefault();
		$('#print_assignment').trigger('click');
	})

	$('#assignment_printer').on('show.bs.modal',function(){
		$('#print_type').prop('selectedIndex',0);
		$('#print_type').trigger('change');
	})

	$('#load_dataset_btn').click(function(){
		year_dataset = $('#dataset_year').val();
		month_dataset = $('#dataset_month').val();
		update_dashboard();
		$('.modal').modal('hide');
	});

	$('#override_submit').click(function(){
		form = $('#override');
		url = $(form).attr('action');
		assigned = aetable.rows(':visible',{selected:true}).data().pluck('user_id')[0];
		post = {
				'assignment_id':$('input[name="assignment_id"]').val(),
				'assigned_on':$('input[name="assigned_on"]').val(),
				'completed_on':$('input[name="completed_on"]').val(),
				'status':$('select[name="status"]').val(),
				'reason':$('textarea[name="reason"]').val(),
				'assigned':assigned
			};

		if($('textarea[name="reason"]').val().trim().length){
			$.ajax({
				type : 'POST',
				url : url,
				dataType : 'json',
				data : post,
				beforeSend:function(){
					startSubmit('#override_submit');
				},
				success:function(res){
					update_dashboard();
				},
				complete:function(){
					endSubmit('#override_submit');
				}
			})
		}else{
			$('textarea[name="reason"]').notify('Reason is required','error');
		}
	});

	$('#nullcomplete').click(function(){
		$('input[name="completed_on"]').val('');
	});

	$('.dtp').daterangepicker({
	    singleDatePicker: true,
	    showDropdowns: true
	});
</script>