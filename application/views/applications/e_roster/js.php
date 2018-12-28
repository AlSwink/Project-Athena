<script>
	
	var last_emp = '';
	
	var position_data = <?php echo json_encode($position_data); ?>;
	
	var pstn_bar = $('#pstn_bar');
	
	var position_chart = new Chart(pstn_bar,{
		type : 'bar',
		data : {
			labels : Object.keys(position_data),
			datasets : [{
				data : Object.values(position_data)
			}]
		},
		options : {
			title : {
				display : true,
				text : 'Employees in positions'
			},
			legend:{
				position: 'bottom',
				labels:{
					boxWidth:11
				}
			}
		}
	});
		

	var emp_table = $('.emp_table').DataTable({
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
				url: '<?= site_url("api/eroster_get_employees");?>',
				dataSrc:''
			},
			columns : [
				{data: "id" },
				{data: "emp_id" },
				{data: "name",
					render: function(data,type,row,meta){
		        		return row.emp_fname+' '+row.emp_lname;
		        	}
				},
				{data: "temp_name"},
				{data: "department_zone",
					render: function(data,type,row,meta){
						return row.dept_name+' - '+row.zone;
					}
				},
				{data: "position"},
				{data: "shift"},
				{data: "supervisor"}
			],
			scrollY: '60vh',
			scroller: {
				loadingIndicator: true
			},
			select: {
		    	style : 'multi+shift'
		    }
		});
		
	var dept_rep_table = $('#report_dept_table').DataTable({
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
				url: '<?= site_url("api/getDeptReport"); ?>',
				dataSrc: ''
			},
			columns : [ 
				{ data: "dept_name"},
				{ data: "cnt"}
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
	var wms_rep_table = $('#report_wms_table').DataTable({
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
				url: '<?= site_url("api/getWmsMissingReport"); ?>',
				dataSrc: ''
			},
			columns : [
				{data: "id" },
				{data: "name",
					render: function(data,type,row,meta){
		        		return row.emp_fname+' '+row.emp_lname;
		        	}
				},
				{data: "temp_name"},
				{data: "department_zone",
					render: function(data,type,row,meta){
						return row.dept_name+' - '+row.zone;
					}
				},
				{data: "position"},
				{data: "shift"},
				{data: "supervisor"}
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
		
	var bday_rep_table = $('#report_bday_table').DataTable({
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
				url: '<?= site_url("api/getBirthdayReport"); ?>',
				dataSrc: ''
			},
			columns : [
				{data: "name",
					render: function(data,type,row,meta){
		        		return row.emp_fname+' '+row.emp_lname;
		        	}
				},
				{data: "dob",
					render: function(data,type,row,meta){
						return row.dob;
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

	var pos_table = $('#pos_table').DataTable({
		dom : '<"row"<"col"t>><"row"<"col"iBp>>',
			info : true,
			colReorder: true,
			ajax: {
				url: '<?= site_url("api/getSetting/positions"); ?>',
				dataSrc: ''
			},
			columns : [
				{ data: 'position' }
			],
			order : [0,'asc'],
		    scrollY: '55vh',
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'multi+shift'
		    }
		});
	
	var zone_table = $('#zone_table').DataTable({
		dom : '<"row"<"col"t>><"row"<"col"iBp>>',
			info : true,
			colReorder: true,
			ajax: {
				url: '<?= site_url("api/getSetting/zones"); ?>',
				dataSrc: ''
			},
			columns : [
				{ data: 'zone' }
			],
			order : [0,'asc'],
		    scrollY: '55vh',
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'multi+shift'
		    }
		});
		
	var dept_table = $('#dept_table').DataTable({
		dom : '<"row"<"col"t>><"row"<"col"iBp>>',
			info : true,
			colReorder: true,
			ajax: {
				url: '<?= site_url("api/getSetting/departments"); ?>',
				dataSrc: ''
			},
			columns : [
				{ data: 'dept_name' }
			],
			order : [0,'asc'],
		    scrollY: '55vh',
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'multi+shift'
		    }
		});
		
	var shift_table = $('#shift_table').DataTable({
		dom : '<"row"<"col"t>><"row"<"col"iBp>>',
		info : true,
		colReorder: true,
		ajax: {
			url: '<?= site_url("api/getSetting/shifts")?>',
			dataSrc: ''
		},
		columns : [
			{ data: 'shift' }
		],
		order : [0, 'asc'],
		scrollY: '55vh',
		scroller: {
			loadingIndicator : true
		},
		select: {
			style : 'multi+shift'
		}
	});
	
	var staffing_table = $('#staffing_table').DataTable({
		dom : '<"row"<"col"t>><"row"<"col"iBp>>',
		info : true,
		colReorder: true,
		ajax: {
			url: '<?= site_url("api/getSetting/agency")?>',
			dataSrc: ''
		},
		columns : [
			{ data: 'temp_name' }
		],
		order : [0, 'asc'],
		scrollY: '55vh',
		scroller: {
			loadingIndicator : true
		},
		select: {
			style : 'multi+shift'
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
				url: '<?= site_url("api/getLogs/eroster_logs"); ?>',
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
	
	emp_table.on('select deselect',function(e,dt,type,indexes){
		if(emp_table.rows({selected:true}).data().length){
			$('#delete,#edit').prop('disabled',false);
		}else{
			$('#delete,#edit').prop('disabled',true);
		}
		if(emp_table.rows({selected:true}).data().length > 1){
			$('#edit').prop('disabled',true);	
		}
	});

	emp_table.on('deselect',function(e,dt,type,indexes){	
		last_emp = emp_table.rows(indexes).data();
	});
	
	emp_table.column(0).visible(false);
	
	//events
	$('#dl_excel').click(function(){
		$('.dl_excel').click();
	})

	$('#print').click(function(){
		$('.tprint').click();
	})
	
	$('a[href="#eroster_logs]').click(function(){
		log_table.ajax.reload();
	});
	$('a[data-toggle="tab"],a[data-toggle="pill"]').on('shown.bs.tab', function(){
        $.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
    });
	
	$('.setting_submit').click(function(){
		clear_validation();
		
		form = $(this).parent().find('form');
		form_id = '#'+$(form)[0].id;
		
		setting_submit(form_id);
	});
	
	$('.employee_submit').click(function(){
		clear_validation();
		
		submit_ready = true;
		//is_edit = false;
		form = $(this).parent().siblings('.modal-body').find('form');
		form_id = '#'+$(form)[0].id;
		
		//check duplicate wms id (add later)
		if(submit_ready){
			employee_submit(form_id);
		}
		
	});
	
	$(document).on('dblclick','.emp_table table tbody td',function(){
		console.log('Doubleclick stage 1');
		if(emp_table.rows({selected:true}).data().length < 2){
			$('#edit').prop('disabled',false);
			console.log('Doubleclick stage 2');
			$('#edit').click();
			$('#edit').prop('disabled',true);	
		}
	})
	
	$('#delete_emps').click(function(){
		to_delete = [];
		$(emp_table.rows({selected:true}).data()).each(function(k,v,){
			to_delete.push(v.id);
		});
		console.log(to_delete);
		$.ajax({
			type : 'POST',
			url : '<?= site_url('e_roster/delete_employees'); ?>',
			dataType : 'json',
			data : {emps : to_delete},
			success : function(res){
				console.log(res);
				$('.emp_table').DataTable().ajax.reload();
			}
		}) 
	})
	
	$('#edit').click(function(){
		form = '#edit_existing_employee';
		employee = ($(emp_table.rows({selected:true}).data()[0]).length ? emp_table.rows({selected:true}).data()[0] : last_emp[0]);
		id = employee.id;
		$(form+' input[name="tbl_id"]').val(employee.id);
		$(form+' input[name="emp_id"]').val(employee.emp_id);
		$(form+' select[name="temp_agency"] options[value="'+employee.temp_name+'"]').attr('selected','selected');
		
		if(id){
			$.ajax({
				type : 'GET',
				url  : '<?= site_url('e_roster/get_employee/'); ?>/'+id,
				dataType : 'json',
				asyc : false,
				success : function(res){
					$(form+' input[name="emp_email"]').val(res.emp_email);
					$(form+' select[name="wms_usrgrp"] options[value="'+res.wms_usrgrp+'"]').attr('selected','selected');
					$(form+' input[name="park_tag"]').val(res.park_tag);
					$(form+' input[name="emp_fname"]').val(res.emp_fname);
					$(form+' input[name="emp_lname"]').val(res.emp_lname);
					$(form+' input[name="emp_dob"]').val(res.emp_dob);
					$(form+' input[name="wms"]').val(res.wms);
					$(form+' input[name="sb"]').val(res.sb);
					$(form+' input[name="ssn"]').val(res.ssn);
					$(form+' input[name="temp_start"]').val(res.temp_start);
					$(form+' select[name="department"] options[value="'+res.dept_id+'"]').attr('selected','selected');
					$(form+' select[name="zone"] options[value="'+res.zone_id+'"]').attr('selected','selected');
					$(form+' select[name="shift"] options[value="'+res.shift_id+'"]').attr('selected','selected');
					$(form+' select[name="pri_rol"] options[value="'+res.primary+'"]').attr('selected','selected');
					$(form+' select[name="sec_rol"] options[value="'+res.secondary+'"]').attr('selected','selected');
					$(form+' select[name="supervisor"] options[value="'+res.supervisor+'"]').attr('selected','selected');
					console.log(res);
				}
			});
		}
		
	});
	
	
	
	//functions
	
	function setting_submit(target){
		url = $(target).attr('action');
		post = $(target).serialize();
		
		$.ajax({
			type : 'POST',
			url : url,
			dataType : 'json',
			data : post,
			beforeSend : function(){
				startSubmit('.setting_submit');
			},
			error: function(jqXHR, textStatus){
				endSubmit('.setting_submit');
				alert('Failed from '+textStatus);  
			},
			success : function(res){
				endSubmit('.setting_submit');
				$('.settings_table').DataTable().ajax.reload();
				
			}
		});
	}
	
	function employee_submit(target){
		url = $(target).attr('action');
		post = $(target).serialize();
		
		$.ajax({
			type : 'POST',
			url : url,
			//dataType : 'json',
			data : post,
			beforeSend : function(){
				
				startSubmit('.employee_submit');
			},
			error: function(jqXHR, textStatus){
				endSubmit('.employee_submit');
				alert('Failed from '+textStatus);  
			},
			success : function(res){
				endSubmit('.employee_submit');
				//console.log('RESULTS: '+res);
				
				$('.emp_table').DataTable().ajax.reload();
				
			},
			timeout: 6000
		});
		
		clear_validation();
	}
		
</script>