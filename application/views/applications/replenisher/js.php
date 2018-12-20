<script>
	var notif = new Audio('<?= base_url('assets/audio/argus-notify-default.mp3'); ?>');
	var urls = {
				'wave_check' : '<?= site_url("replenisher/check_wave"); ?>',
				'wave_lines' : '<?= site_url("replenisher/wave_lines"); ?>',
				'build_submit' : '<?= site_url("replenisher/build_replenishment"); ?>'
			};

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
				url: '<?= site_url("api/getLogs/replenishment_logs"); ?>',
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

	$(document).ready(function(){
		app_name = '<?= $method = $this->router->fetch_method(); ?>';
		
		$.notify.addStyle('globalnotif', {
		  html: 
		    "<div>" +
		      "<div class='clearfix alert alert-info shadow mb-0'>" +
		        "<h6 class='mb-0' data-notify-text/>" +
		        "<center><small><i>Replenisher Alert</i></small></center>"+
		      "</div>" +
		    "</div>"
		});

		$.notify.defaults({
			autoHideDelay: 5000,
			globalPosition: 'bottom right',
			style: 'globalnotif'
		});
	});

	$('#build').click(function(){
		var wave = $('#wave').val();

		if(wave.length){
			$('#wave').removeClass('is-invalid');
			$.ajax({
				type: 'POST',
				url: urls.wave_check,
				dataType: 'json',
				data: { wave : wave },
				success: function(res){
					if(res.length){
						rows = '<tr>';
						$(res).each(function(k,v){
							rows += '<td>'+v.wave+'</td><td>'+v.e_fname+'</td><td>'+v.e_lname+'</td><td>'+v.replenished_on+'</td>';
						});
						rows += '</tr>';
						$('#rb_table').html(rows);
						$('#confirm_rebuild').modal('show');
					}else{
						buildWave();
					}
				}
			});
		}else{
			$('#wave').addClass('is-invalid');
			$('#replen_summary').empty();
		}
	});

	$('#rebuild_yes').click(function(){
		buildWave();
		$('#confirm_rebuild').modal('hide');
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		$.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
	});

	$('a[href="#replen_logs"]').click(function(){
		logtable.ajax.reload();
	});

	$('.wave_list').click(function(){
		waves = [];
		curr_waves = $('#wave').val();
		if(curr_waves){
			waves = curr_waves.split(',');
		}

		wave = $(this).find('td:first').html();
		exist = waves.indexOf(wave);
		
		if(exist < 0){
			waves.push(wave);
		}else{
			waves.splice(exist,1);
		}

		new_waves = waves.join(',');
		$('#wave').val(new_waves);
	});

	function buildWave(){
		var wave = $('#wave').val();

		$.ajax({
			type: 'POST',
			url: urls.wave_lines,
			dataType: 'json',
			data: { wave : wave },
			beforeSend: function(){
				$('.btn_submit ').addClass('d-none')
				$('#replen_summary').html(loading);
			},
			success: function(res){
				if(res){
					$('.btn_submit').removeClass('d-none');
				}else{
					res = createAlert('danger','Wave not found');
				}

				$('#replen_summary').html(res);
				$('input[name="wave"]').val(wave);
			},
			error: function(xhr,status,error){
				if(xhr.status == 500){
					error = createAlert('danger','Oops! Table was locked. Please try again');
					$('#replen_summary').html(error);
					$('.btn_submit').addClass('d-none');
				}
			}
		});
	}

	$(document).on('click','.btn_submit',function(){
		form_data = $('#replen_summary_form').serialize();
		wave = $('input[name="wave"]').val();
		$.ajax({
			type: 'POST',
			url: urls.build_submit,
			dataType: 'json',
			data: { post : form_data, wave : wave },
			beforeSend: function(){
				startSubmit('.btn_submit');
			},
			success: function(res){
				console.log(res);
			},
			complete: function(){
				endSubmit('.btn_submit');
				resetSummary();
				msg = 'Wave '+wave+' replenishment has been built please trigger on WMS';
				socket.emit('notify','replenisher-'+msg);
			}
		});
	});

	function resetSummary()
	{
		$('#wave').val('');
		$('#replen_summary').html('');
		$('.btn_submit').addClass('d-none');
	}

	socket.on('notify',function(app,msg){
		if(app == app_name){
			notif.play();
			$.notify(msg);
		}
	});
</script>