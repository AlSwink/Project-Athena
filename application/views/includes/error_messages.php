<?php if($this->session->flashdata('errors')){ ?>
<script>
	var errors = <?php echo json_encode($this->session->flashdata()); ?>;
	$(document).ready(function(){
		$.each(errors,function(k,v){
			console.log(v);
			$('[name='+v.field+']').addClass('is-invalid');
			$('[name='+v.field+']').after('<div class="invalid-feedback">'+v.error+'</div>');
		});
	});
</script>
<?php } ?>