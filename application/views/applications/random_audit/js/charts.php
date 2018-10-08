<script>
	var	accuracy = $('#error');
	var	mod_acc = $('#mod_accuracy');
	var	crs_acc = $('#crs_accuracy');
	var	sb_acc = $('#sb_accuracy');
	var	monthly = $('#monthly_progress');

	var total_accuracy = new Chart(accuracy,{
				type : 'doughnut',
				data : {
					labels : ['Error','Correct'],
					datasets : [{
						data : [ 3, 60 ],
						backgroundColor : [
							'rgba(50, 50,50, 1)',
							'rgba(40,167,69,1)'
						]
	                }]
				},
				options: {
					title : {
						display: true,
						text: 'Total Accuracy'
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
	var mod_accuracy = new Chart(mod_acc,{
				type : 'doughnut',
				data : {
					labels : ['Error','Correct'],
					datasets : [{
						data : [ 1, 60 ],
						backgroundColor : [
							'rgba(50, 50,50, 1)',
							'rgba(40,167,69,1)'
						]
	                }]
				},
				options: {
					title : {
						display: true,
						text: 'MOD Accuracy'
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
	var crs_accuracy = new Chart(crs_acc,{
				type : 'doughnut',
				data : {
					labels : ['Error','Correct'],
					datasets : [{
						data : [ 5, 60 ],
						backgroundColor : [
							'rgba(50, 50,50, 1)',
							'rgba(40,167,69,1)'
						]
	                }]
				},
				options: {
					title : {
						display: true,
						text: 'Cresting Accuracy'
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
	var sb_accuracy = new Chart(sb_acc,{
				type : 'doughnut',
				data : {
					labels : ['Error','Correct'],
					datasets : [{
						data : [ 2, 60 ],
						backgroundColor : [
							'rgba(50, 50,50, 1)',
							'rgba(40,167,69,1)'
						]
	                }]
				},
				options: {
					title : {
						display: true,
						text: 'Sportsball Accuracy'
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
</script>