<script>
	var dept_prog = $("#dept_prog");
	var c_dept_prog = new Chart(dept_prog,{
				type : 'doughnut',
				data : {
					labels : [],
					datasets : [{
						data : [30,20],
						backgroundColor : [
							'rgba(4, 173, 41,1)',
							'rgba(50, 50,50, 1)'
						]
	                }]
				},
				options: {
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
	    var fontSize = (height / 100).toFixed(2);
	    ctx.font = fontSize + "em sans-serif";
	    ctx.textBaseline = "middle";

	   	doughnut_text = '100%';

	    var text = doughnut_text,
	        textX = Math.round((width - ctx.measureText(text).width) / 2),
	        textY = height / 2.15;

	    ctx.fillText(text, textX, textY);
	    ctx.save();
	  }
	});
</script>