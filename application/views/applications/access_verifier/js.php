<script>
	$(window).focus(function(){
		$('#scan_status').removeClass('bg-danger').addClass('bg-success');
		$('.scan_text').html('Ready to Scan');
		$('#id').focus();
	});

	$(window).blur(function(){
		$('#scan_status').removeClass('bg-success').addClass('bg-danger');
		$('.scan_text').html('Focus to Ready');
	});

	$(document).keypress(function(e){
		id = $('#id').val();
		id += $(this).val();
		console.log(id);
		//$('#id').val(id);
	});


	$(window).keyup(function(e){
		id = $('#id').val();
		keyCode = e.keyCode || e.which;
		if(keyCode === 13) { 
			console.log(id);
		}
	});
</script>