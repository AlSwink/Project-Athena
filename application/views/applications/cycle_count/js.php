<script>
	var netvsabs = $("#netvsabs");
	var abs_percentage = $("#abspercentage");
	var net_percentage = $("#netpercentage");

	var abs_perc = new Chart(abs_percentage,{
				type : 'doughnut',
				data : {
					labels : ['BAD','OK'],
					datasets : [{
						data : [
							0.22,
							99.88
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
					labels : ['BAD','OK'],
					datasets : [{
						data : [
							0.22,
							99.96
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

	var net_vs_abs = new Chart(netvsabs,{
				type : 'doughnut',
				data : {
					labels : ['Net','Absolute'],
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

	    if(cid == 'netvsabs'){
	    	chart_text = chart.data.datasets[0].data[0]+' - '+chart.data.datasets[0].data[1];
	    }else{
	    	chart_text = chart.data.datasets[0].data[1]+'%';
	    }
	    var text = chart_text;
	        textX = Math.round((width - ctx.measureText(text).width) / 2),
	        textY = height / 2;

	    ctx.fillText(text, textX, textY);
	    ctx.save();
	  }
	});
</script>