<script>
	var carrier;
	var trailer;
	var dock;
	var pickup;
	var carrier_logo_dir = '<?= base_url('assets/img/carrier_logos/'); ?>';

	$('select[name="outbound_carrier"]').change(function(){
		file = $(this).children('option:selected').data('img');
		logo = carrier_logo_dir+file;
		$('#carrier_logo').attr('src',logo);
	});

	$('#save_carrier').click(function(){
		dock_select_url = "<?= site_url('argus/getDockDoors'); ?>";
		carrier = $('select[name="outbound_carrier"]').val();
		trailer = $('input[name="trailer_number"]').val();

		$.ajax({
			type : 'POST',
			url : dock_select_url,
			dataType : 'json',
			data : { carrier : carrier, trailer : trailer },
			beforeSend : function(){
				startSubmit('#save_carrier');
			},
			success : function(res){
				console.log(res);
			},
			complete : function(){
				endSubmit('#save_carrier');
			}
		});

		console.log(carrier);
	});

	function clear_vars()
	{
		carrier = '';
		trailer  = '';
		dock  = '';
		pickup  = '';
	}
</script>