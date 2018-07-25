<div class="container-fluid p-3 shadow bg-white rounded">
	<?php $this->load->view('tools/container_control'); ?>
	<div class="row">
		<div class="col-lg-3">
			<div class="form-group">
				<label>Containers</label>
				<textarea rows="10" class="form-control" name="containers"></textarea>
			</div>
			<div id="cont-error" class="alert alert-danger d-none"></div>
			<button id="submit_containers" type="button" class="btn btn-secondary btn-block">Start <i class="fas fa-play"></i></button>
			<button id="reset" type="button" class="btn btn-warning btn-block">Reset <i class="fas fa-undo"></i></button>
		</div>
		<div class="col-lg-9">
			<div class="row">
				<div id="process_list" class="col-6"></div>
				<div id="status" class="col-6">
					<label>Status</label>
					<div class="card">
						<div class="card-body">
							Downloading Labels
							<div class="progress">
							  <div class="dl_progress progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 0%"></div>
							</div>
							<br>
							Convert and Cropping
							<div class="progress">
							  <div class="cc_progress progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 0%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<br>
							Generating NF Printable page  
							<div class="progress">
							  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<button type="button" class="btn btn-block btn-success mt-5">Ready to Print <i class="fas fa-print"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#submit_containers').click(function(){
		err = false;
		cont_exp = new RegExp('NG\\d+[0-9]');
		cont_error = 'Please input valid container numbers. It usually starts with <b>NG</b>*******';
		cont_miss = 'Please input at least <b>1</b> container number';

		if($('textarea[name="containers"]').val().trim().length > 0){
			$('#cont-error').addClass('d-none');
			conts = $('textarea[name="containers"]').val().trim().split("\n");
			$.each(conts,function(k,v){
				if(!cont_exp.test(v)){
					container_error(cont_error);
					err = true;
				}
			});
		}else{
			container_error(cont_miss);
		}

		if(!err){
			$(this).prop('disabled',true);
			$('textarea[name="containers"]').prop('disabled',true);
			check_if_804(conts);
		}
	});

	$('#reset').click(function(){
		$('textarea[name="containers"]').prop('disabled',false);
		$('#submit_containers').prop('disabled',false);
		$('textarea[name="containers"]').val('');
		$('#process_list').html('');
		$('#process_list').addClass('d-none');
		$('#status').addClass('d-none');
	})

	function container_error(msg)
	{
		$('#cont-error').html(msg);
		$('#cont-error').removeClass('d-none');
	}

	function check_if_804(conts)
	{
		$('#process_list').removeClass('d-none');

		$.ajax({
			type : 'POST',
			url : site_url+'tools/check_804',
			dataType : 'json',
			data : { conts : conts },
			beforeSend : function(){
				$('#process_list').html(loading);
			},
			success : function(res){
				$('#process_list').html(res);
			},
			complete : function(){
				$('#status').removeClass('d-none');
				start_download();
			}
		});
	}

	function start_download()
	{
		post_cont = [];
		conts = $('.containers');
		/*conts_count = conts.length;
		progress_width = $('.dl_progress').parent().width();
		percentage_increment = Math.ceil(progress_width/conts_count);*/
		
		$.each(conts,function(k,v){
			curr_cont = $(v).val();

			/*curr_width = $('.dl_progress').width();
			new_width = curr_width + percentage_increment;*/
					
			$.ajax({
				async : false,
				type : 'POST',
				url : site_url+'tools/download_label/',
				dataType : 'json',
				data : { cont : curr_cont },
				success : function(res){
					post_cont.push(res);
				}
			});			
		});

		$('.dl_progress').attr('style','width : 100%');
		convert_n_crop(post_cont);

	}

	function convert_n_crop(conts)
	{		
		$.each(conts,function(k,v){
			curr_cont = v;

			$.ajax({
				async : false,
				type : 'POST',
				url : site_url+'tools/crop_nf_label/',
				dataType : 'json',
				data : { cont : curr_cont },
				success : function(){

				}
			});			
		});

		setTimeout(function(){
			$('.cc_progress').attr('style','width : 100%')
		},1000);

		generate_print(conts);
	}

	function generate_print(conts)
	{
		
	}
</script>