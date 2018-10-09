<script>
	var swi = {
				update: function(){
					window.location.reload();
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
				};

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
						display: false
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
						display: false
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
						display: false
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
	        textY = height / 1.66;

	    ctx.fillText(text, textX, textY);
	    ctx.save();
	  }
	});

	var rrtable = $('#reported_report').DataTable({
			dom : '<"row"<"col"t>><"row"<"col"p>>',
			pagingType : 'numbers',
			ordering : false,
			ajax: {
				url: '<?= site_url("api/getSWIReported/resolved"); ?>',
        		dataSrc: ''
			},
			columns : [
				{ data: "doc_number" },
				{ data: "doc_name" },
		        { data: "process" },
		        { data: "comments" },
		        { data: "correction_made" }
		        
			],
		    scrollY: '55vh'
		});

</script>