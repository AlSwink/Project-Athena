<script>
	$(document).on('click','.changeStatus', function(){
		var id = $(this).data('id');
		var progress = $(this).data('progress');
		var status = $(this).data('status');
		var title = $(this).children('.card-body').html();
		console.log(title);
		$("input[name='id']").val(id);
		$(".modal-title").html(title);
		$("input[name='progress']").val(progress);
		$("select[name='status']").find('option:selected').prop('selected',false);
		$("select[name='status']").find('option[value="'+status+'"]').prop('selected',true);
		$('#statusControl').modal('show');
	});
	$('#submit').click(function(){
		console.log('start');
		var form = $('#statusForm');
		var url = $(form).attr('action');
		
		var post = $(form).serialize();
		
		$.ajax({
			type: 'post',
			url: url,
			dataType: 'json',
			data: {post:post},
			beforeSend: function(){
				startSubmit('#submit');
			},
			success: function(result){
				updateScreen(result);
			},
			complete: function(){
				endSubmit('#submit');
				
			}
		});
		console.log('stop');
	});
	function updateScreen(result){
		console.log(result.incomplete);
		$("#incompleteList").html(result.incomplete);
		$("#completeList").html(result.complete);
		$("#percentComplete").html(Math.ceil(result.percent*100));
		$("#percentIncomplete").html(Math.ceil((1-result.percent)*100));
	}
</script>