<script>
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
							<?= $totals['abs_adj']; ?>,
							<?= $totals['qty']; ?>
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
							Math.abs(<?= $totals['net_adj']; ?>),
							<?= $totals['qty']; ?>
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

	var loc_accuracy = new Chart(loc_acc,{
				type : 'doughnut',
				data : {
					labels : ['Adjusted','Counted'],
					datasets : [{
						data : [
							13,
							43
						],
						backgroundColor : [
							'rgba(50, 50,50, 1)',
							'#41958a'
						]
	                }]
				},
				options: {
					title : {
						display: true,
						text: 'Net vs Absolute Adjustment'
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
	    	chart_text = '0%';
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
		            text: 'Print',
		            extend: 'print',
		            className: 'tr_print d-none',
		            exportOptions: {
	                    columns: [ 0 ]
	                }
		        }
	        ],
			ajax: {
				url: '<?= site_url("api/getCycToday"); ?>/'+dataset,
        		dataSrc: ''
			},
			columns : [
				{ data: "loc" },
		        { data: "sku" },
		        { data: "pkg" },
		        { data: "act_qty" },
		        { data: "qty",
		        	render: function(data,type,row,meta){
		        		if(row.act_qty != row.r1_qty){
		        			sum = parseInt(row.act_qty) + parseInt(row.r1_qty);
		        			return (sum ? sum : null);
		        		}else{
		        			return row.act_qty;
		        		}
		        	}
		        },
		        { data: "r1_qty" },
		        { data: "r2_qty" },
		        { data: "final",
		        	render: function(data,type,row,meta){
		        		sum = parseInt(row.act_qty) + parseInt(row.r2_qty);
		        		return (sum ? sum : null);
		        	}
		        }
			],
		    scrollY:        '60vh',
		    order : [0,'asc'],
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'multi+shift'
		    },
		     "createdRow" : function(row,data,index){

		    	/*switch(data['type']){
		    		case 'Counted':
		    			$(row).addClass('table-success');
		    			break;
		    		case 'Adjusted':
		    			$(row).addClass('table-danger');
		    			break;
		    		default:
		    			$(row).addClass('table-warning');
		    			break;
        		}*/

        		$(row).addClass('trmenu');
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

	gltable.on('select deselect',function(e,dt,type,indexes){
		if(gltable.rows({selected:true}).data().length){
			$('#generate_cycle_count').prop('disabled',false);
		}else{
			$('#generate_cycle_count').prop('disabled',true);
		}
	});

	function updateData(data)
	{
		$('.r1_counted').html(data.r1_today.counted);
		$('.r1_assigned').html(data.r1_today.assigned);
		$('.r1_progress').css('width',data.r1_today.progress);
		$('.r1_progress').html(data.r1_today.progress);

		$('.r2_counted').html(data.r2_today.counted);
		$('.r2_assigned').html(data.r2_today.assigned);
		$('.r2_progress').css('width',data.r2_today.progress);
		$('.r2_progress').html(data.r2_today.progress);
	}

	$(document).ready(function(){
		app_name = '<?= $method = $this->router->fetch_method(); ?>';
		page_type = 'app';
		version = $('#app_version').html();
	});


	$('a[data-toggle="tab"],a[data-toggle="pill"]').on('shown.bs.tab', function (e) {		
		$.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
	})

	$('a[href="#cyc_reports"]').on('shown.bs.tab', function (e) {		
		$.fn.dataTable.tables({visible: true, api: true}).ajax.reload();
	})

	$('#tr_excel').click(function(){
		$('.tr_excel').click();
	});

	$('#tr_print').click(function(){
		$('.tr_print').click();
	});

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

	$('#generate_cycle_count').click(function(){
		url = '<?= site_url("cycle_count/insert_locations"); ?>/'+dataset;
		selected = [];
		selected_locs = gltable.rows({selected:true}).data();
		$(selected_locs).each(function(k,v){
			selected.push(v);
		})

		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'json',
			data: { post : selected },
			beforeSend: function(){
				startSubmit('#generate_cycle_count');
			},
			success: function(res){
				gltable.clear();
			},
			complete: function(){
				endSubmit('#generate_cycle_count');
				gltable.draw();
			}
		});
	});


	$('.ajaxForms').on('keyup keypress', function(e) {
	  var keyCode = e.keyCode || e.which;
	  if (keyCode === 13) { 
	    e.preventDefault();
	    return false;
	  }
	});
</script>
