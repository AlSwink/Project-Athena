<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        	<div id="production_carousel" class="carousel slide" data-ride="carousel" data-interval="20000">
        		<div class="carousel-inner p-3">
                    <div class="carousel-item active">
        				<?= loadSubTemplate('display_slide_1',$data); ?>
        			</div>
        			<div class="carousel-item">
        				<?= loadSubTemplate('display_slide_2',$data); ?>
        			</div>
        			<div class="carousel-item ">
        				<?= loadSubTemplate('display_slide_3',$data); ?>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
    <div style="position: absolute; bottom: 0;">
        <div class="row">
            <div class="col">
                <canvas id="prod_board" class="charts" width="1200px" height="150px"></canvas> 
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="text-muted">Last Updated on : <?= date('F d Y h:i A'); ?></p>
            </div>
        </div>
    </div>
</div>

<style>
	.text-input{
		border: none !important;
		
		border-radius: 0 !important;
	}

	.text-input:focus{
		border: none !important;
		box-shadow: none !important;
		border-bottom: 1.5px solid #62d4e0 !important;
	}	

	.form-control::-webkit-input-placeholder{
		color: #dddddd !important;
		font-size: 15px !important;
		font-style: oblique !important;
	}

	tr{
	    background-color: white;
	    transition: background-color 1s;
	}

	.stylish {
	    background-color: #c3e6cb !important;
	    transition: background-color 1s;
	}

	.modal-xlg{
		max-width: 1500px !important;
	}

	.individual_hours{
		font-size: 11px !important;
	}

	.mins_worked{
		font-size: 45px !important;
	}

	.target{
        color: #e68100;
        font-weight: bold;
    }

    .totals th{
        font-size: 10px !important;
    }
</style>

<script>

    var	config = {
    	type: 'line',
    	data: {
    		labels: <?= json_encode($time_range); ?>,
    		datasets: <?= json_encode($graph); ?>
    	},
    	options: {
    		legend: {
    			fullWidth: true,
    			fontSize: 5,
	            labels: {
	                defaultFontSize: 5,
	                fontColor: 'black',
	                boxWidth: 12
	            }
	        },
	        scales: {
		        xAxes: [{
		            ticks: {
		                fontSize: 8
		            }
		        }]
		    }
    	}
    }

    var ctx = document.getElementById("prod_board");
    var daily1 = new Chart(ctx,config);
</script>