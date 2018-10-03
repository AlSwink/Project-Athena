<script>
	$(window).focus(function(){
		$('#scan_status').removeClass('bg-danger').addClass('bg-success');
		$('.scan_text').html('Ready to Scan');
		$('#id').focus();
		reset();
	});

	$(window).blur(function(){
		$('#scan_status').removeClass('bg-success').addClass('bg-danger');
		$('.scan_text').html('Focus to Ready');
		reset();
	});

	$(document).keypress(function(e){
		char = String.fromCharCode(e.which);
		id = $('#id').val();
		id += char;
		$('#id').val(id);		
	});


	$(window).keyup(function(e){
		emp = {
				name : '',
				staffing : '',
				supervisor : '',
				department : ''	
		};
		id = $('#id').val();
		keyCode = e.keyCode || e.which;
		if(keyCode === 13) { 
			$('#id').val('');
			$.ajax({
				type : 'GET',
				url : '<?= site_url("api/checkAccess"); ?>/'+id,
				dataType : 'json',
				success : function(res){
					if(res.length){
						emp.name = res[0].e_fname+' '+res[0].e_lname;
						emp.staffing = res[0].staffing_name;
						emp.supervisor = res[0].supervisor;
						emp.department = res[0].department_name;
						emp.status = 'Active';
						emp.bg = 'success';
						updateInfo(emp);
					}else{
						emp.status = 'Inactive';
						emp.bg = 'danger';
						updateInfo(emp);
					}
				}
			});
		}
	});

	function updateInfo(data)
	{
		$('.emp_name').html(data.name);
		$('.staffing').html(data.staffing);
		$('.supervisor').html(data.supervisor);
		$('.department').html(data.department);

		$('#status').removeClass('bg-success bg-secondary bg-danger');
		$('#status').addClass('bg-'+data.bg);
		$('#status_text').html(data.status);
	}

	function reset()
	{
		$('.info').html('');

		$('#status').removeClass('bg-success bg-secondary bg-danger');
		$('#status').addClass('bg-secondary');
		$('#status_text').html('Waiting for Input');
	}
</script>