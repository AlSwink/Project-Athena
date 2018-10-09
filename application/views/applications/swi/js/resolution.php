<script>
	var rtable = $('#reported_table').DataTable({
			dom : '<"row"<"col"t>><"row"<"col"iBp>>',
			pagingType : 'numbers',
			info : true,
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
				url: '<?= site_url("api/getSWIReported/pending"); ?>',
        		dataSrc: ''
			},
			columns : [
				{ data: "doc_name" },
				{ data: "process" },
				{ data: "completed_on",
					render: function(data,type,row,meta){
						return moment(data).format('MM/DD/YY');
					}
				}
			],
		    scrollY: '60vh',
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'single'
		    }
		});

	rtable.on('select',function(e,dt,type,indexes){
		selected_data = rtable.rows(indexes).data()[0];
		
		$('.doc_num').html(selected_data.doc_number);
		$('.doc_name').html(selected_data.doc_name);
		$('.e_audited').html(selected_data.audited);
		$('.e_auditor').html(selected_data.auditor);
		$('.doc_reported').html(moment(selected_data.completed_on).format('MM/DD/YYYY'));
		$('.a_id').html(selected_data.assignment_id);
		$('.rprocess').html(selected_data.process);
		$('.comments').html(selected_data.comments);
		$('input[name="adj_id"]').val(selected_data.adj_id);
		$('#info_card').removeClass('d-none');

	});

	$('#resolution_submit').click(function(){
		form = $('#resolution_form');
		url = $(form).attr('action');
		data = $(form).serialize();

		if($('textarea[name="resolution"]').val().length){
			$.ajax({
				type : 'POST',
				url : url,
				dataType : 'json',
				data : { post : data },
				beforeSend:function(){
					startSubmit('#resolution_submit');
				},success:function(res){
					rtable.ajax.reload();
					$('#info_card').addClass('d-none');
				},complete:function(){
					endSubmit('#resolution_submit');
					socket.emit('command','/do-swi-update');
				}
			});
		}else{
			$('textarea[name="resolution"]').notify('Please provide a countermeasure','error')
		}

	});

	$('#search_reported_doc').keyup(function(){
		rtable.search( this.value ).draw();
	})

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {		
		$.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
	})
</script>