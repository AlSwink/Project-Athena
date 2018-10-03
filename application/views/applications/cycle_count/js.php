<script>
	<?php if(!$this->standalone){ ?>
		loadDependencies(<?= json_encode($dependencies);?>);
	<?php } ?>
	var loc_acc = $("#loc_acc");
	var	dataset = $('#dataset').val();
	var abs_percentage = $("#abspercentage");
	var net_percentage = $("#netpercentage");

	var abs_perc = new Chart(abs_percentage,{
				type : 'doughnut',
				data : {
					labels : ['Adj','Correct'],
					datasets : [{
						data : [
							<?= $totals['today']['units']['abs_adj']; ?>,
							<?= $totals['today']['units']['all']; ?>
						],
						backgroundColor : [
							'rgba(50, 50,50, 1)',
							'rgba(40,167,69,1)'
						]
	                }]
				},
				options: {
					title : {
						display: true,
						text: 'Absolute Percentage'
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

	var net_perc = new Chart(net_percentage,{
				type : 'doughnut',
				data : {
					labels : ['Adj','Correct'],
					datasets : [{
						data : [
							Math.abs(<?= $totals['today']['units']['net_adj']; ?>),
							<?= $totals['today']['units']['all']; ?>
						],
						backgroundColor : [
							'rgba(50, 50,50, 1)',
							'rgba(40,167,69,1)'
						]
	                }]
				},
				options: {
					title : {
						display: true,
						text: 'Net Percentage'
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
	    var fontSize = (height / 175).toFixed(2);
	    ctx.font = fontSize + "em sans-serif";
	    ctx.textBaseline = "middle";
	    dividend = chart.data.datasets[0].data[0];
	    divisor = chart.data.datasets[0].data[1];

	    if(dividend && divisor){
	    	chart_text = (100 - (dividend / divisor * 100)).toFixed(2)+'%';
	    }else{
	    	chart_text = '100%';
	    }

	    var text = chart_text;
	        textX = Math.round((width - ctx.measureText(text).width) / 2),
	        textY = height / 2;

	    ctx.fillText(text, textX, textY);
	    ctx.save();
	  }
	});

	var cttable = $('#cyc_today_table').DataTable({
			dom : '<"row"<"col"t>><"row"<"col"iBp>>',
			pagingType : 'numbers',
			info : true,
			responsive: true,
			buttons: [
		        {
		            text: 'Excel',
		            extend: 'excel',
		            className: 'tr_excel d-none'
		        },
		        {
		            text: 'Print Blind',
		            extend: 'print',
		            className: 'trb_print d-none',
		            exportOptions: {
	                    columns: [ 2 ]
	                }
		        },
		        {
		            text: 'Print All',
		            extend: 'print',
		            className: 'tr_print d-none'
		        }
	        ],
			ajax: {
				url: '<?= site_url("api/getCycToday"); ?>/'+dataset,
        		dataSrc: ''
			},
			columns : [
				{ data: "entry_id" },
				{ data: "mark" },
				{ data: "loc" },
		        { data: "act_qty" },
		        { data: "qty" },
		        { data: "r1_qty",
		        	render: function(data,type,row,meta){
		        		if(row.act_qty != row.qty){
		        			sum = parseInt(row.act_qty) + parseInt(row.r1_qty);
		        			return (sum ? sum : null);
		        		}else{
		        			return null;
		        		}
		        	}
		        },
		        { data: "r2_qty" },
		        { data: "final",
		        	render: function(data,type,row,meta){
		        		sum = parseInt(row.act_qty) + parseInt(row.r2_qty);
		        		return (sum ? sum : null);
		        	}
		        }
			],
		    scrollY: '45vh',
		    order : [0,'asc'],
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'multi+shift'
		    },
		     "createdRow" : function(row,data,index){
        		$(row).addClass('trmenu');

        		if(!data.qty){
        			$(row).addClass('table-warning');
        		}
		    }
		});

	var gltable = $('#location_generated').DataTable({
			dom : '<"row"<"col"t>><"row"<"col"ip>>',
			pagingType : 'numbers',
			info : true,
			responsive: true,
			columns : [
				{ data: "loc" },
		        { data: "qty" }
			],
		    scrollY:'40vh',
		    order : [0,'asc'],
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'multi+shift'
		    }
		});

	var crtable = $('#custom_detail_table').DataTable({
			dom : '<"row"<"col"Bt>><"row"<"col"ip>>',
			pagingType : 'numbers',
			info : true,
			responsive: true,
			buttons: [
		        {
		            text: 'Excel',
		            extend: 'excel',
		            className: 'cr_excel d-none'
		        },
		        {
		            text: 'Print All',
		            extend: 'print',
		            className: 'cr_print d-none'
		        }
	        ],
			columns : [
				{ data: "entry_id" },
				{ data: "loc" },
		        { data: "act_qty" },
		        { data: "qty" },
		        { data: "r1_qty",
		        	render: function(data,type,row,meta){
		        		if(row.act_qty != row.qty){
		        			sum = parseInt(row.act_qty) + parseInt(row.r1_qty);
		        			return (sum ? sum : null);
		        		}else{
		        			return null;
		        		}
		        	}
		        },
		        { data: "r2_qty" },
		        { data: "final",
		        	render: function(data,type,row,meta){
		        		sum = parseInt(row.act_qty) + parseInt(row.r2_qty);
		        		return (sum ? sum : null);
		        	}
		        }
			],
		    scrollY: '35vh',
		    order : [0,'asc'],
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'multi+shift'
		    },
		     "createdRow" : function(row,data,index){
        		$(row).addClass('trmenu');
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
				url: '<?= site_url("api/getLogs/cyc_logs"); ?>',
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


	gltable.on('select deselect',function(e,dt,type,indexes){
		if(gltable.rows({selected:true}).data().length){
			$('.start_cycle_count').prop('disabled',false);
		}else{
			$('#generate_cycle_count').prop('disabled',true);
		}
	});

	cttable.on('select deselect',function(e,dt,type,indexes){
		if(cttable.rows({selected:true}).data().length){
			$('.delete_locations,.regenerate_locations').prop('disabled',false);
		}else{
			$('.delete_locations,.regenerate_locations').prop('disabled',true);
		}
	});

	function updateData(data)
	{
		$('.total_created').html(data.today.created);
		$('.total_counted').html(data.today.counted);
		$('.total_remainder').html(data.today.remainder);
		$('.total_adj_loc').html(data.today.adjusted);
		$('.total_qty').html(data.today.units.all);
		$('.total_net_adj').html(data.today.units.net_adj);
		$('.total_abs_adj').html(data.today.units.abs_adj);

		$('.master_all').html(data.master.all);
		$('.master_pending').html(data.master.pending);
		$('.master_counted').html(data.master.counted);
		$('.master_progress').css('height',data.master.progress);

		$('.r1_counted').html(data.today.r1.counted);
		$('.r1_assigned').html(data.today.r1.assigned);
		$('.r1_progress').css('width',data.today.r1.progress);
		$('.r1_progress').html(data.today.r1.progress);

		$('.r2_counted').html(data.today.r2.counted);
		$('.r2_assigned').html(data.today.r2.assigned);
		$('.r2_progress').css('width',data.today.r2.progress);
		$('.r2_progress').html(data.today.r2.progress);

		cttable.ajax.reload();
	}

	function updateCustom(data)
	{
		$('.custom_counted').html(data.today.counted);
		$('.custom_error').html(data.today.adjusted);
		$('.custom_units').html(data.today.units.all);
		$('.custom_net').html(data.today.units.net_adj);
		$('.custom_adj').html(data.today.units.abs_adj);
	}

	function setLocList(ids,locations,target)
	{
		locs = '';

		$(locations).each(function(k,v){
			locs += '<div class="col-3 border p-2 text-center bg-secondary text-white">'+v+'</div>';
		});

		$('input[name="ids"]').val(ids.join('-'));
		$('input[name="locations"]').val(locations.join(';'));
		$(target).html(locs);
	}

	$(document).ready(function(){
		app_name = '<?= $method = $this->router->fetch_method(); ?>';
		page_type = 'app';
		version = $('#app_version').html();

		start = moment().subtract(29, 'days');
	    end = moment();

	    $.contextMenu({
        	selector: '.trmenu',
        	build: function($triggerElement,e){
   				entry = $($triggerElement[0]).find('td')[1];
   				loc = $($triggerElement[0]).find('td')[2];
   				entry_id = $(entry).html();
   				
        		return {
        			callback: function(key, options,e){
		                switch(key){
		                	case 'regenerate':
		                		$('.regenerate_locations').click();
		                		break;
		                	case 'delete':
		                		$('.delete_locations').click();
		                		break;
		                }
        			},
        			items: {
        				regenerate: {name:"Regenerate Command",icon:"fas fa-redo-alt"},
        				"sep1": "---------",
        				delete: {name:"Delete Record",icon:"fas fa-trash-alt text-danger"}
        			}
        		}
        	}
        });

	    function setRange(start, end) {
	        $('input[name="report_from"]').val(start.format('YYYY-MM-DD'));
	        $('input[name="report_to"]').val(end.format('YYYY-MM-DD'));
	    }

	    $('.report_range').daterangepicker({
	        startDate: start,
	        endDate: end,
	        maxDate: moment(),
	        showDropdowns: true,
	        ranges: {
	           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
	           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	           'This Month': [moment().startOf('month'), moment().endOf('month')],
	           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	        }
	    }, setRange);

	    setRange(start, end);
	});

	$('a[data-toggle="tab"],a[data-toggle="pill"]').on('shown.bs.tab', function (e) {		
		$.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
	})

	$('a[href="#cyc_reports"]').on('shown.bs.tab', function (e) {		
		//$.fn.dataTable.tables({visible: true, api: true}).ajax.reload();
		cttable.ajax.reload();
	})

	$('a[href="#cyc_logs"]').on('shown.bs.tab', function (e) {		
		$.fn.dataTable.tables({visible: true, api: true}).ajax.reload();
	})

	$('#tr_excel').click(function(){
		$('.tr_excel').click();
	});

	$('#tr_print').click(function(){
		$('.tr_print').click();
	});

	$('#trb_print').click(function(){
		$('.trb_print').click();
	});

	$('#log_excel').click(function(){
		$('.log_excel').click();
	});

	$('#log_print').click(function(){
		$('.log_print').click();
	});

	$('#cr_excel').click(function(){
		$('.cr_excel').click();
	});

	$('#cr_print').click(function(){
		$('.cr_print').click();
	});

	$('#search_loc').keyup(function(){
		cttable.columns(2).search(this.value).draw();
	})

	$('.check_progress').click(function(){
		$.ajax({
			type : 'GET',
			url : '<?= site_url('cycle_count/checkProgress/'); ?>'+dataset,
			dataType : 'json',
			beforeSend : function(){
				startSubmit('.check_progress');
			},
			success : function(res){
				updateData(res);
			},
			complete : function(){
				endSubmit('.check_progress');
			}
		});
	});

	$('#prep_from_filter').click(function(){
		form = $('#generate_location_form');
		url = $(form).attr('action');
		post = $(form).serialize();
		
		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'json',
			data: { post : post },
			beforeSend: function(){
				$(form).find('input').val('');
				startSubmit('#prep_from_filter');
			},
			success: function(res){
				gltable.clear();
				gltable.rows.add(res);
				gltable.draw();
			},
			complete: function(){
				endSubmit('#prep_from_filter');
				gltable.rows().select();
			}
		});
	});

	$('#nike_cycle_count').click(function(){
		count_type = $('select[name="count_type"]').val();
		loc_type = $('select[name="loc_type"]').val();
		dataset = $('select[name="dataset"]').val();
		url = '<?= site_url("cycle_count/insert_locations"); ?>';
		selected = [];
		selected_locs = gltable.rows({selected:true}).data();
		$(selected_locs).each(function(k,v){
			selected.push(v);
		})

		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'json',
			data: { 
					post : selected, 
					dataset : dataset, 
					type : 'nike', 
					count_type : count_type, 
					loc_type : loc_type 
			},
			beforeSend: function(){
				startSubmit('#nike_cycle_count');
			},
			success: function(res){
				gltable.clear();
				updateData(res);
			},
			complete: function(){
				endSubmit('#nike_cycle_count');
				gltable.draw();
			}
		});
	});

	$('#generate').click(function(){
		start = $('input[name="report_from"]').val();
		end = $('input[name="report_to"]').val();
		url = '<?= site_url("api/getCycCustom"); ?>'+'/KNK/'+start+'/'+end;

		$.ajax({
			type: 'GET',
			url: url,
			dataType: 'json',
			beforeSend: function(){
				startSubmit('#generate');
			},
			success: function(result){
				updateCustom(result);

				crtable.ajax.url(url);
				crtable.ajax.json(result.cyc_all);
				crtable.clear().rows.add(result.cyc_all).draw();
			},
			complete: function(){
				endSubmit('#generate');
			}
		});
	});

	$('#delete_loc').click(function(){
		form = $('#delete_loc_form');
		url = $(form).attr('action');
		post = $(form).serialize();
		reason = $('textarea[name="reason"]').val();

		if(reason.length){
			$.ajax({
				type: 'POST',
				url: url,
				dataType: 'json',
				data: { post : post },
				beforeSend: function(){
					startSubmit('#delete_loc');
				},
				success: function(result){
					updateData(result);
				},
				complete: function(){
					endSubmit('#delete_loc');
				}
			});
		}else{
			$('textarea[name="reason"]').notify('Reason is required','error');
		}
	});

	$('#regen_loc').click(function(){
		form = $('#regen_loc_form');
		url = $(form).attr('action');
		post = $(form).serialize();
		reason = $('textarea[name="reason"]:visible').val();

		if(reason.length){
			$.ajax({
				type: 'POST',
				url: url,
				dataType: 'json',
				data: { post : post },
				beforeSend: function(){
					startSubmit('#regen_loc');
				},
				success: function(result){
					updateData(result);
				},
				complete: function(){
					endSubmit('#regen_loc');
				}
			});
		}else{
			$('textarea[name="reason"]').notify('Reason is required','error');
		}
	});


	$('.ajaxForms').on('keyup keypress', function(e) {
	  var keyCode = e.keyCode || e.which;
	  if (keyCode === 13) { 
	    e.preventDefault();
	    return false;
	  }
	});

	$('.delete_locations').click(function(){
		to_delete = [];
		locations = [];
		$(cttable.rows({selected:true}).data()).each(function(k,v,){
			to_delete.push(v.entry_id);
			locations.push(v.loc);
		});

		setLocList(to_delete,locations,'.loc_list');
		$('#delete_location').modal('show');
	});

	$('.regenerate_locations').click(function(){
		to_regen = [];
		locations = [];

		$(cttable.rows({selected:true}).data()).each(function(k,v,){
			to_regen.push(v.entry_id);
			locations.push(v.loc);
		});

		setLocList(to_regen,locations,'.loc_list_2');
		$('#regenerate_command').modal('show');
	});

	$('select[name="dataset"]').change(function(){
		selected = $(this).val();
		//console.log(selected);
		if(selected == 'KNT'){
			$('#'+selected+'_fields').removeClass('d-none');
		}else{
			$('.fields').addClass('d-none');
		}
	});
</script>
