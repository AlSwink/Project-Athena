<script>
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
	
	$('a[href="#eroster_logs]').click(function(){
		log_table.ajax.reload();
	});
</script>